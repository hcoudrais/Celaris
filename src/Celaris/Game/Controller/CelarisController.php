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
    public function celarisAction()
    {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('home_page'));

        $player = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Players', $this->getServerUsed())
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
        $file = __DIR__ . '/insert.txt';
        $query = file_get_contents($file, true);

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
                $planets = array(10, 11, 20, 21, 30, 31, 32, 40, 41, 42, 43, 50, 51, 52, 53, 60, 61, 62, 63, 70, 71, 80, 81, 90, 91);

                while ($planetCreate < $numberOfPlanetToCreate) {
                    $planetIndex = rand(0, count($planets) - 1);
                    $currentPlanet = 'P' . $planets[$planetIndex];
                    unset($planets[$planetIndex]);
                    $planets = array_values($planets);

                    $map = $currentGalaxy . $currentSystem . $currentPlanet;

                    $query .= "INSERT INTO Celaris (Mapping) VALUES ('$map');\n";
                    $planetCreate++;
                }

                $system++;
            }
        }

        file_put_contents($file, $query);
        die();
    }
}
