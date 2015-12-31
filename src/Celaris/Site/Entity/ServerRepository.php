<?php

namespace Celaris\Site\Entity;

use Doctrine\ORM\EntityRepository;

class ServerRepository extends EntityRepository
{
    public function listServersAvailableAndServersUsed($user)
    {
        // On récupère la liste de tout les serveurs disponible
        $allServers = $this->findAll();

        // Si l'utilisateur est déjà identifié, on récupère les serveurs sur 
        // le(s)quel(s) il a déjà joué pour faire la bonne redirection
        $serversUse = array();
        if ($user) {
            foreach($user->getServers() as $server) {
                $serversUse[] = $server->getName();
            }
        }

        $serversAvailable = array();
        foreach($allServers as $server) {
            if (!in_array($server->getName(), $serversUse))
                $serversAvailable[] = $server->getName();
                
        }

        return array(
            'servers'       => $serversAvailable,
            'serversUse'    => $serversUse
        );
    }

    public function getAllServers()
    {
        return $this
            ->createQueryBuilder('s')
            ->getQuery()
            ->getArrayResult()
        ; 
    }
}