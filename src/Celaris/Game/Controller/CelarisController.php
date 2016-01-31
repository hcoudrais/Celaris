<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;

use Celaris\Game\Entity\Building;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CelarisController extends GeneralController
{
    /**
     * @Route ("/celaris", name="celaris")
     * @Template("CelarisGameBundle:Header:header.html.twig")
     */
    public function celarisAction()
    {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('fos_user_security_logout'));

        $player = $this->getPlayer();

        $celaris = $this
            ->getRepository('CelarisGameBundle:Celaris')
            ->findFirstCelaris($player['playerId'])
        ;

        $buildingsCelaris = $this
            ->getRepository('CelarisGameBundle:BuildingCelaris')
            ->findBuildingRessources($celaris['celarisId'])
        ;

        $ressourceBuildings = array();
        foreach ($buildingsCelaris as $buildingCelaris)
            $ressourceBuildings[Building::getSpecificNameById($buildingCelaris['buildingId'])] = $buildingCelaris;

        return array(
            'player' => $player,
            'celaris' => $celaris,
            'buildingCelaris' => $ressourceBuildings
        );
    }
}
