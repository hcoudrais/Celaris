<?php

namespace Celaris\Site\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Celaris\Site\Entity\User;

class AbstractTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    protected $client = null;

    public function getDoctrine()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        return $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }
    
    public function login()
    {
        // L'utilisateur est celui en base de données
        // L'utilisateur kiki à comme unique choix de serveur Gamma
        $this->client->setServerParameters(array(
            'PHP_AUTH_USER' => 'kiki', 
            'PHP_AUTH_PW' => 'kiki'
        ));
    }

    protected function getUser()
    {
        return new User;
    }
}
