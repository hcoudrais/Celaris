<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class BuildingController extends GeneralController
{
    /**
     * @Route ("/building", name="menu_building", options={"expose"=true})
     * @Template("CelarisGameBundle:ContentMenu:building.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('home_page'));
        
        $allBuildings = $this
            ->getRepository('CelarisGameBundle:Building')
            ->getAllBuildings()
        ;

        return array('allBuilding' => $allBuildings);
    }
}
