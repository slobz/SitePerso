<?php

namespace Seb\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        // Log debug
        $logger = $this->get('logger');

        // Appels AJAX qui vont bien: ajout messages
        if ($request->isXmlHttpRequest()) {
            $logger->info('Appel AJAX.');
            $ajax = $this->container->get('seb_chat.Ajax');
            $logger->info('Var :' . $request->request->get('message'));

            // On récupère l'id du message ajouté
            // @todo Verif
            $id_message = $ajax->processAjax($request->request->get('params'));
            $return = json_encode(array("responseCode" => 200, "id_message" => $id_message));

            return new Response($return, 200, array('Content-Type' => 'application/json'));
        } else {
            return $this->render('SebChatBundle:Default:index.html.twig');
        }
    }

//    public function sendAction() {
//
//        $logger = $this->get('logger');
//        $logger->info("On est dans send message");
//
//        $request = $this->get('Request');
//
//        $return = json_encode("toto"); //jscon encode the array
//        return new Response("toto", 200, array('Content-Type' => 'application/json')); //make sure it has the correct content type
//    }
}
