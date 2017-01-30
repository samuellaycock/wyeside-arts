<?php

namespace Frontend\Controller;

use DrewM\MailChimp\MailChimp;


/**
 * @author james.dobb@gmail.com
 */
class MailchimpController extends FrontendController
{

    CONST API_KEY = "25aeed6156f9e24991b9138c6fe5c4a2-us1";
    CONST LIST_ID = "610218d82b";


    /**
     * @throws \Exception
     */
    public function subscribeAction()
    {
        $data = [
            'email_address' => $this->app->request->post('email'),
            'status' => 'subscribed'
        ];

        /* if (!empty($this->app->request->post('firstName', ''))) {
             $data['firstName'] = $this->app->request->post('firstName');
         }

         if (!empty($this->app->request->post('lastName', ''))) {
             $data['lastName'] = $this->app->request->post('lastName');
         }
        */

        try {
            $mailChimp = new MailChimp(self::API_KEY);
            $responseData  = $mailChimp->post('lists/' . self::LIST_ID, json_encode([
                [
                    'email_address' => $this->app->request->post('email'),
                    'status' => 'subscribed'
                ]
            ]));
            if ($mailChimp->success()) {
                $view = 1;
            } else {
                $view = $mailChimp->getLastError();
                $response = $this->app->response();
                $response->body(print_r($responseData,1));
                return;
            }
        } catch (\Exception $e) {
            $view = 0;
        }

        $response = $this->app->response();
        $response->body($view);
    }

}
