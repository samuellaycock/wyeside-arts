<?php

namespace Frontend\Controller;


/**
 * @author james.dobb@gmail.com
 */
class MailchimpController extends FrontendController
{

    CONST API_KEY = "25aeed6156f9e24991b9138c6fe5c4a2";
    CONST LIST_ID = "610218d82b";


    /**
     * @throws \Exception
     */
    public function subscribeAction()
    {
        /*$data = [];

        $data['email'] = $this->app->post('email');

        if (!empty($this->app->request->post('firstName', ''))) {
            $data['firstName'] = $this->app->request->post('firstName');
        }

        if (!empty($this->app->request->post('lastName', ''))) {
            $data['lastName'] = $this->app->request->post('lastName');
        }

        try {
            $mailChimp = new \Mailchimp(self::API_KEY);
            $mailChimp->lists->subscribe(self::LIST_ID, $data);
            $view = 1;
        } catch (\Exception $e) {
            $view = 0;
        }*/

        $response = $this->app->response();
        $response->body(1);
    }

}
