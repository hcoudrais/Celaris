<?php

namespace Celaris\Site\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Celaris\Site\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userTest = new User();
        $userTest->setUsername('test');
        $userTest->setPassword('test');

        $manager->persist($userTest);
        $manager->flush();

        $this->addReference('user-test', $userTest);
    }

    public function getOrder()
    {
        return 1; // l'ordre dans lequel les fichiers sont chargés
    }
}