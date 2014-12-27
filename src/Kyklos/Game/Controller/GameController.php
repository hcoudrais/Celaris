<?php

namespace Kyklos\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class GameController extends Controller
{
    /**
     * @Route ("/game", name="game")
     * @Template("KyklosGameBundle:Header:header.html.twig")
     */
    public function indexAction()
    {
//        $player = $this
//            ->getDoctrine()
//            ->getRepository('KyklosGameBundle:Celaris')
//            ->findAll()
//        ;
//
//        $serializer = $this->get('jms_serializer');
//        $player = $serializer->serialize($player,'json');
//
//        var_dump($player);
        
        return array();
    }

    /**
     * @Route ("/galaxy", name="menu_galaxy", options={"expose"=true})
     * @Template("KyklosGameBundle:Map:map.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('home_page'));

        $allCelaris = $this
            ->getDoctrine()
            ->getRepository('KyklosGameBundle:Celaris')
            ->findAll()
        ;
        
        $serializer = $this->get('jms_serializer');
        $celaris = $serializer->serialize($allCelaris,'json');

        return array('allCelaris' => $celaris);
    }
}
