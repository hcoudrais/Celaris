<?php

namespace Celaris\Site\DataFixtures\ORM;

//use Doctrine\Common\Persistence\ObjectManager;
//use Doctrine\Common\DataFixtures\FixtureInterface;
//use Symfony\Component\DependencyInjection\ContainerAwareInterface;
//use Symfony\Component\DependencyInjection\ContainerInterface;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Celaris\Site\Entity\User;

//class LoadUserData implements FixtureInterface, ContainerAwareInterface
class LoadUserData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface , ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
//        $user = new User();
//        $user->setUsername('admin');
//
//        $encoder = $this->container
//            ->get('security.encoder_factory')
//            ->getEncoder($user)
//        ;
//        $user->setPassword($encoder->encodePassword('secret', $user->getSalt()));
//
//        $manager->persist($user);
//        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}