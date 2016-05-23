<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Entity;

use App\Model\Repo\TweetRepo;
use Doctrine\ORM\EntityManager;

/**
 * @Entity(repositoryClass="App\Model\Repo\TweetRepo")
 * @Table(name="twitter")
 */
class Tweet
{

    /**
     * @Id
     * @Column(type="integer")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $text;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $time;

    /**
     * @Column(type="datetime")
     * @var \DateTime
     */
    protected $inserted;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return \DateTime
     */
    public function getInserted()
    {
        return $this->inserted;
    }

    /**
     * @param \DateTime $inserted
     */
    public function setInserted($inserted)
    {
        $this->inserted = $inserted;
    }


    /**
     * @param TweetRepo $repo
     * @return Tweet
     */
    public static function getOne(TweetRepo $repo, EntityManager $em)
    {
        try {
            $tweet = $repo->findOneBy([]);
        } catch (\Exception $e) {
            self::update($repo, $em);
            return new Tweet();
        }
        if (!$tweet) {
            self::update($repo, $em);
            return new Tweet();
        }

        $date1 = $tweet->getInserted();
        $date2 = new \DateTime();
        if (abs($date2->diff($date1)->i) > 30) {
            self::update($repo, $em);
        }

        return $tweet;
    }


    /**
     * @param TweetRepo $repo
     * @param EntityManager $em
     */
    public static function update(TweetRepo $repo, EntityManager $em)
    {
        foreach($repo->findAll() as $tweet){
            $em->remove($tweet);
        }
        $em->flush();

        $settings = array(
            'oauth_access_token' => "1164813739-Jr7RAFTZeNmivT2Wnq2vI08CNZWqDi1yGQ0ntpg",
            'oauth_access_token_secret' => "A7WgImz9d8jID5xrXm1FgYpnwfaKAViU6Y9bfDKCs",
            'consumer_key' => "yc2EOlQkQZ8ATIrvTgMkA",
            'consumer_secret' => "KnxL28EMlSwp2nnAF8TQaXBXJnbioJwu1h7PAZP23E"
        );

        $oauth_hash = '';
        $oauth_hash .= 'oauth_consumer_key=' . $settings['consumer_key'] . '&';
        $oauth_hash .= 'oauth_nonce=' . time() . '&';
        $oauth_hash .= 'oauth_signature_method=HMAC-SHA1&';
        $oauth_hash .= 'oauth_timestamp=' . time() . '&';
        $oauth_hash .= 'oauth_token=' . $settings['oauth_access_token'] . '&';
        $oauth_hash .= 'oauth_version=1.0';
        $base = '';
        $base .= 'GET';
        $base .= '&';
        $base .= rawurlencode('https://api.twitter.com/1.1/statuses/home_timeline.json');
        $base .= '&';
        $base .= rawurlencode($oauth_hash);
        $key = '';
        $key .= rawurlencode($settings['consumer_secret']);
        $key .= '&';
        $key .= rawurlencode($settings['oauth_access_token_secret']);
        $signature = base64_encode(hash_hmac('sha1', $base, $key, true));
        $signature = rawurlencode($signature);


        $oauth_header = '';
        $oauth_header .= 'oauth_consumer_key="' . $settings['consumer_key'] . '", ';
        $oauth_header .= 'oauth_nonce="' . time() . '", ';
        $oauth_header .= 'oauth_signature="' . $signature . '", ';
        $oauth_header .= 'oauth_signature_method="HMAC-SHA1", ';
        $oauth_header .= 'oauth_timestamp="' . time() . '", ';
        $oauth_header .= 'oauth_token="' . $settings['oauth_access_token'] . '", ';
        $oauth_header .= 'oauth_version="1.0", ';
        $curl_header = array("Authorization: Oauth {$oauth_header}", 'Expect:');

        $curl_request = curl_init();
        curl_setopt($curl_request, CURLOPT_HTTPHEADER, $curl_header);
        curl_setopt($curl_request, CURLOPT_HEADER, false);
        curl_setopt($curl_request, CURLOPT_URL, 'https://api.twitter.com/1.1/statuses/home_timeline.json');
        curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, false);
        $json = curl_exec($curl_request);
        curl_close($curl_request);

        $count = 0;
        foreach (json_decode($json, TRUE) as $t) {

            $tweetText = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $t['text']);
            $time = $datetime = new \DateTime($t['created_at']);
            $datetime->setTimezone(new \DateTimeZone('Europe/Zurich'));
            $time = date("jS M \@ G:H:s", $datetime->format('U'));


            $tweet = new Tweet();
            $tweet->setText($tweetText);
            $tweet->setTime($time);
            $tweet->setInserted(new \DateTime());
            $em->persist($tweet);
            $em->flush();

            break; // we only want 1 now
        }
    }


}