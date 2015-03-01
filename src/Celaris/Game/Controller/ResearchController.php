<?php

namespace Celaris\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class ResearchController extends Controller
{
    /**
     * @Route ("/research", name="menu_research", options={"expose"=true})
     * @Template("CelarisGameBundle:ContentMenu:research.html.twig")
     */
    public function researchAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('home_page'));

        $allResearch = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Research')
            ->findAll()
        ;
        
        $serializer = $this->get('jms_serializer');
        $research = $serializer->serialize($allResearch,'json');

        return array('allResearch' => $research);
    }
}
