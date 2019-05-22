<?php

namespace FormBM\BMBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FormBMBMBundle:Default:index.html.twig');
    }
}
