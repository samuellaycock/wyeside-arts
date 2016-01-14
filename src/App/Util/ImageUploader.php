<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Util;


use Intervention\Image\ImageManager;
use Intervention\Image\Image;


class ImageUploader
{

    /** @var Image */
    protected $image;

    /** @var string */
    protected $extension;


    /**
     * ImageUploader constructor.
     * @param $tmpImageSrc
     * @param $origName
     */
    public function __construct($tmpImageSrc, $origName)
    {
        $mgr = new ImageManager();
        $this->image = $mgr->make($tmpImageSrc);
        $this->extension = StringUtil::getExtension($origName);
    }

    /**
     * @param $x
     * @param $y
     */
    public function fit($x, $y)
    {
        $this->image->fit($x, $y);
    }


    /**
     * @param $filename
     * @param bool $standardize
     * @return string
     */
    public function save($dir, $filename, $standardize = true)
    {
        if($standardize){
            $filename = $this->standardizeFilename($filename) . '.' . $this->extension;
        }
        $this->image->save($dir . $filename);
        return $filename;
    }


    /**
     * @param $filename
     * @return string
     */
    protected function standardizeFilename($filename)
    {
        $filename = preg_replace('/\s\s+/', ' ', $filename);
        $filename = trim($filename, ' ');
        $filename = str_replace(' ', '-', $filename);
        return strtolower(preg_replace("/[^a-zA-Z0-9_-]+/", "", $filename));
    }

}