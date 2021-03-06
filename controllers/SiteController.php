<?php

namespace app\controllers;

use ramit\phpmvc\Application;
use ramit\phpmvc\Controller;
use ramit\phpmvc\Request;
use ramit\phpmvc\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 * 
 * @package app\controllers
 */

class SiteController extends Controller{

    public function home(){
        $params = [
            "name" => "Rahul"
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response){
        $contact = new ContactForm();
        if($request->isPost()){
            $contact->loadData($request->getBody());
            if($contact->validate() && $contact->send()){
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }

}
