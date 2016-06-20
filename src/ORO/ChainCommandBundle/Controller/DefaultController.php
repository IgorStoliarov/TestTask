<?php

namespace ORO\ChainCommandBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OROChainCommandBundle:Default:index.html.twig');
    }
}
