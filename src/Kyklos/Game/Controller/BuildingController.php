<?php

namespace Kyklos\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class BuildingController extends Controller
{
    /**
     * @Route ("/building", name="menu_building", options={"expose"=true})
     * @Template("KyklosGameBundle:ContentMenu:building.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('home_page'));

        $allBuilding = $this
            ->getDoctrine()
            ->getRepository('KyklosGameBundle:Building')
            ->findAll()
        ;
        
        $serializer = $this->get('jms_serializer');
        $building = $serializer->serialize($allBuilding,'json');

        return array('allBuilding' => $building);
    }
}
