<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Frontend\Controller;

use App\Controller\AppController;
use Slim\Slim;

/**
 * Class FrontendController
 * @package App\Backend\Controller
 */
class FrontendController extends AppController
{

    /**
     * AppController constructor.
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->setViewGlobals($app);
        parent::__construct($app);
    }


    /**
     * @param Slim $app
     */
    protected function setViewGlobals(Slim $app)
    {

    }

}