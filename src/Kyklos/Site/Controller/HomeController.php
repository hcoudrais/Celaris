<?php

namespace Kyklos\Site\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class HomeController extends Controller
{
    /**
     * @Template("KyklosSiteBundle::accueil.html.twig")
     */
    public function indexAction()
    {
        return array();
    }
}
