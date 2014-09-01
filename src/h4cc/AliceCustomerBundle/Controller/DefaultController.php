<?php

namespace h4cc\AliceCustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('h4ccAliceCustomerBundle:Default:index.html.twig', array('name' => $name));
    }
}
