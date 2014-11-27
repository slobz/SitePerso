<?php

namespace Seb\Bundle\AlbumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SebAlbumBundle:Default:index.html.twig');
    }
}
