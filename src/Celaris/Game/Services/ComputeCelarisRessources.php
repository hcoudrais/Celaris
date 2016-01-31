<?php

namespace Celaris\Game\Services;

use Symfony\Component\DependencyInjection\ContainerAware;

use Celaris\Game\Entity\Celaris;
use Celaris\Game\Entity\Building;

use DateTime;

class ComputeCelarisRessources extends ContainerAware
{
    private $serverName;

    private $celaris;

    protected function getDoctrine()
    {
        return $this->container->get('doctrine');
    }

    protected function getManager()
    {
        return $this->getDoctrine()->getManager($this->serverName);
    }

    protected function getRepository($entity)
    {
        return $this->getDoctrine()->getRepository($entity, $this->serverName);
    }

    private function getMinesAndStorages()
    {
        $buildingsCelaris = $this
            ->getRepository('CelarisGameBundle:BuildingCelaris')
            ->findBuildingRessources($this->celaris->getCelarisId())
        ;

        $ressourceBuildings = array();
        foreach ($buildingsCelaris as $buildingCelaris)
            $ressourceBuildings[Building::getSpecificNameById($buildingCelaris['buildingId'])] = $buildingCelaris['stockage'];

        return $ressourceBuildings;
    }

    public function computeCelarisRessources($serverName, Celaris $celaris)
    {
        $this->serverName = $serverName;
        $this->celaris = $celaris;

        $now = new DateTime('now');
        $lastUpdate = $this->celaris->getLastUpdate() ?: $now;
        $diff = $now->getTimestamp() - $lastUpdate->getTimestamp();

        $buildingsCelaris = $this->getMinesAndStorages();
        foreach ($buildingsCelaris as $buildingName => $buildingCelaris) {
            switch ($buildingName) {
                case 'Minerais':
                    $currentRessource = $this->celaris->getMinerais();
                    $limit = $buildingsCelaris['MineraisStorage'];
                    $setter = 'set' . $buildingName;
                    $production = $buildingCelaris;

                    break;
                case 'Cristal':
                    $currentRessource = $this->celaris->getCristaux();
                    $limit = $buildingsCelaris['CristalStorage'];
                    $setter = 'setCristaux';
                    $production = $buildingCelaris;

                    break;
                case 'Nobelium':
                    $currentRessource = $this->celaris->getNobelium();
                    $limit = $buildingsCelaris['NobeliumStorage'];
                    $setter = 'set' . $buildingName;
                    $production = $buildingCelaris;

                    break;
                case 'Hydrogene':
                    $currentRessource = $this->celaris->getHydrogene();
                    $limit = $buildingsCelaris['HydrogeneStorage'];
                    $setter = 'set' . $buildingName;
                    $production = $buildingCelaris;

                    break;
                case 'Albinion':
                    $currentRessource = $this->celaris->getAlbinion();
                    $limit = $buildingsCelaris['AlbinionStorage'];
                    $setter = 'set' . $buildingName;
                    $production = $buildingCelaris;

                    break;
                default:
                    break;
            }

            // Peut être mettre la valeur de la production directement en seconde
            // dans la base. Actuellement en heure.
            $newRessources = $currentRessource + ($diff * ($production / 3600));
            if ($newRessources > $limit)
                $newRessources = $limit;

            $this->celaris->$setter($newRessources);
        }

        // faire le last update en trigger ?
        $this->celaris->setLastUpdate($now);
    }
}
