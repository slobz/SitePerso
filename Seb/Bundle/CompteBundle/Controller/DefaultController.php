<?php

namespace Seb\Bundle\CompteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Seb\Bundle\CompteBundle\Entity\Compte\Operation;

class DefaultController extends Controller
{
    public function indexAction()
    {
         // On recupère les opérations
        $repo = $this->getDoctrine()->getRepository('SebCompteBundle:Compte\Operation');
        $items = $repo->findAll();
        
        return $this->render('SebCompteBundle:Default:index.html.twig',array('operations' => $items));
    }
}
