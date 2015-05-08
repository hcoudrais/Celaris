<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class GameController extends GeneralController
{
    /**
     * @Route ("/game", name="game")
     * @Template("CelarisGameBundle:Header:header.html.twig")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route ("/galaxy", name="menu_galaxy", options={"expose"=true})
     * @Template("CelarisGameBundle:Map:map.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('home_page'));

        $allCelaris = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Celaris')
            ->findAll()
        ;
        
        return array('allCelaris' => $this->serializer($allCelaris, 'array'));
    }
}
