<?php

namespace Kyklos\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class DefaultController extends Controller
{
    /**
     * @Route ("/accueil", name="accueil")
     * @Template("KyklosGameBundle:Default:accueil.html.twig")
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route ("/galaxy", name="menu_galaxy", options={"expose"=true})
     * @Template("KyklosGameBundle:Map:map.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return false;

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
