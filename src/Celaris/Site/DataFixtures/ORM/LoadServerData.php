<?php

namespace Celaris\Site\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Celaris\Site\Entity\Server;

class LoadServerData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $server1 = new Server();
        $server1->setName('Alpha');
        $manager->persist($server1);
        $this->addReference('server-alpha', $server1);

        $server2 = new Server();
        $server2->setName('Beta');
        $manager->persist($server2);
        $this->addReference('server-beta', $server2);

        $server3 = new Server();
        $server3->setName('Gamma');
        $manager->persist($server3);
        $this->addReference('server-gamma', $server3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}