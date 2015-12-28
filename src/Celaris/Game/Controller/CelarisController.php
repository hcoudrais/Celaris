<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Celaris\Game\Views\PlayerView;

use \Symfony\Component\HttpFoundation\Request as Request;

class CelarisController extends GeneralController
{
    /**
     * @Route ("/celaris", name="celaris")
     * @Template("CelarisGameBundle:Header:header.html.twig")
     */
    public function celarisAction(Request $request)
    {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('home_page'));

        $player = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $this->getUser()->getId()))
        ;

        $playerView = new PlayerView;

        return array(
            'player' => $playerView->getPlayerInfoView($player)
        );
    }
}
