<?php

namespace Kyklos\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// I won't use it
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Template("KyklosGameBundle:Default:accueil.html.twig")
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
}
