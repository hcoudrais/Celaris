<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Celaris\Game\Views\PlayerView;
use Celaris\Game\Entity\Celaris;

use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\Building; // Dossier Building

use \Symfony\Component\HttpFoundation\Request as Request;

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

    /**
     * @Route ("/create_celaris", name="create_celaris")
     */
    public function createCelarisAction(Request $request)
    {
        // Set le server name dans la sesion pour le manager et les repos
        $serverName = $request->get('serverName');
        $this->setServerUsed($serverName);
        $em = $this->getManager();
        
        if (is_null($serverName))
            return 'Server name non renseigné';

        // For test
//        $em = $this->getDoctrine()->getManager();
        $galaxies = array(1,2,3,4);

        foreach ($galaxies as $galaxy) {
            $currentGalaxy = "G0$galaxy";

            $system = 1;
            while ($system <= 250) {
                switch(strlen($system)) {
                    case 1:
                        $currentSystem = "S00$system";
                        break;
                    case 2:
                        $currentSystem = "S0$system";
                        break;
                    default:
                        $currentSystem = "S$system";
                        break;
                }

                $numberOfPlanetToCreate = rand(6, 12);
                $planetCreate = 0;
                 // 25 - 9 planète et 16 lunes => 100 - 36 planètes et 64 lunes
//                $planets = array(10, 11, 20, 21, 30, 31, 32, 40, 41, 42, 43, 50, 51, 52, 53, 60, 61, 62, 63, 70, 71, 80, 81, 90, 91);
                 // 23 - 9 planète et 14 lunes => 100 - 39.13 planètes et 60.86 lunes
                $planets = array(10, 20, 21, 30, 31, 32, 40, 41, 42, 43, 50, 51, 52, 53, 60, 61, 62, 63, 70, 71, 80, 81, 90);

                while ($planetCreate < $numberOfPlanetToCreate) {
                    $planetIndex = rand(0, count($planets) - 1);
                    $currentPlanet = 'P' . $planets[$planetIndex];
                    unset($planets[$planetIndex]);
                    $planets = array_values($planets);

                    // Coordonnées entière de la planète
                    $map = $currentGalaxy . $currentSystem . $currentPlanet;

                    $celaris = new Celaris();
                    $celaris->setMapping($map);
                    
                    // Persist and flush to get celarisId
                    $em->persist($celaris);
                    $em->flush($celaris);

                    $buildings = $this->getRepository('CelarisGameBundle:Building')->findAll();
                    // For test
//                    $buildings = $this->getDoctrine()->getRepository('CelarisGameBundle:Building')->findAll();

                    // Create all building by celaris
                    foreach ($buildings as $building) {
                        $currentBuilding = $building->getSpecificClass();

                        $buildingCelaris = new BuildingCelaris($building, $celaris);
                        // Set BuildingCelaris through specific class
                        $currentBuildingCelaris = new $currentBuilding($buildingCelaris);

                        // Précise 0 pour le niveau du centre de commandement
                        // Précise true pour dire que c'est une initialisation
                        // Le niveau du bâtiment restera donc à 0
                        $currentBuildingCelaris->levelUp(0, true);
                        $em->persist($buildingCelaris);
                    }

                    $planetCreate++;
                }

                $system++;
            }
        }

        $em->flush();
        // Petit die pour pas faire de return inutile
        die();
    }
}
