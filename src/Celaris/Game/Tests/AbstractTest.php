<?php

namespace Celaris\Game\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Celaris\Site\Entity\User;

class AbstractTest extends WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    public function getDoctrine()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        return $this->em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    }

    protected function getUser()
    {
        return new User;
    }

//    /**
//     * Get a user from the Security Context
//     *
//     * @return mixed
//     *
//     * @throws \LogicException If SecurityBundle is not available
//     *
//     * @see Symfony\Component\Security\Core\Authentication\Token\TokenInterface::getUser()
//     */
//    public function getUser()
//    {
//        static::$kernel = static::createKernel();
//        static::$kernel->boot();
//        var_dump(static::$kernel->getContainer()->get('security.context'));
//
//        if (null === $token = static::$kernel->getContainer()->get('security.context')) {
//            return;
//        }
//
//        if (!is_object($user = $token->getUser())) {
//            return;
//        }
//
//        return $user;
//    }
}
