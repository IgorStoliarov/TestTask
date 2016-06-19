<?php

namespace ORO\BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('OROBarBundle:Default:index.html.twig');
    }
}
