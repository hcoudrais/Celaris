<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Celaris\Game\Views\PlayerView;

class CelarisController extends GeneralController
{
    /**
     * @Route ("/celaris", name="celaris")
     * @Template("CelarisGameBundle:Header:header.html.twig")
     */
    public function celarisAction()
    {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('logout'));

        $player = $this
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $this->getUser()->getId()))
        ;

        $playerView = new PlayerView;

        return array(
            'player' => $playerView->getPlayerInfoView($player)
        );
    }
}
