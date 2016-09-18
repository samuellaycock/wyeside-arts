<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


use App\Model\Entity\Config;
use App\Model\Repo\ConfigRepo;

/**
 * Class SettingsController
 * @package Backend\Controller
 */
class SettingsController extends BackendController
{

    /**
     * @return ConfigRepo
     */
    protected function getConfigRepo()
    {
        return $this->em->getRepository('App\Model\Entity\Config');
    }


    public function indexAction()
    {
        $config = $this->getConfigRepo()->findOneByName('brochureUrl');
        if (!$config) {
            $config = new Config();
            $config->setName('brochureUrl');
            $config->setValue('#');
            $this->em->persist($config);
            $this->em->flush();
        }

        if ($this->app->request()->isPost()) {
            $config->setValue($this->app->request->post('brochureUrl'));
            $this->em->persist($config);
            $this->em->flush();
        }

        $this->app->render('backend/settings/index.twig', ['brochureUrl' => $config->getValue()]);
    }

}