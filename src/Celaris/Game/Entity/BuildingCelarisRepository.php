<?php

namespace Celaris\Game\Entity;

use Celaris\Game\Entity\Building;

use Doctrine\ORM\EntityRepository;

class BuildingCelarisRepository extends EntityRepository
{
    public function findBuildingCelaris($celarisId)
    {
        return $this
            ->createQueryBuilder('bc')
            ->where('bc.celaris = :celarisId')
            ->setParameter(':celarisId', $celarisId)
            ->getQuery()
            ->getArrayResult()
        ;
    }

    public function findBuildingRessources($celarisId)
    {
        return $this
            ->createQueryBuilder('bc')
            ->where('bc.celaris = :celarisId')
            ->andWhere('bc.building IN (:buildings)')
            ->setParameter(':celarisId', $celarisId)
            ->setParameter(':buildings', array(
                Building::MINERAIS_ID,
                Building::CRISTAL_ID,
                Building::NOBELIUM_ID,
                Building::HYDROGENE_ID,
                Building::ALBINION_ID,
                Building::MINERAIS_STORAGE_ID,
                Building::CRISTAL_STORAGE_ID,
                Building::NOBELIUM_STORAGE_ID,
                Building::HYDROGENE_STORAGE_ID,
                Building::ALBINION_STORAGE_ID
            ))
            ->getQuery()
            ->getArrayResult()
        ;
    }
}

