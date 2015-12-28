<?php

namespace Celaris\Site\Tests;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;

use Celaris\Site\Entity\User;

require_once("app/AppKernel.php");

class AbstractTest extends \PHPUnit_Framework_TestCase
{
    protected $kernel = null;

    protected $client = null;

    public function setUp()
    {
        parent::setUp();

        $this->kernel = new \AppKernel("test", false);
        $this->kernel->boot();

        $this->client = $this->get('test.client');
        $this->loadFixturesFromDirectory(__DIR__ . '/../DataFixtures');
    }
    
    public function tearDown()
    {
        if ($this->kernel)
            $this->kernel->shutdown();

        unset($this->kernel);
    }

    protected function get($service)
    {
        return $this->kernel->getContainer()->get($service);
    }

    protected function getDoctrine()
    {
        return $this->get('doctrine');
    }

    /**
     * Executes fixtures
     *
     * @param \Doctrine\Common\DataFixtures\Loader $loader
     */
    protected function executeFixtures(Loader $loader)
    {
        $purger = new ORMPurger();
        $executor = new ORMExecutor($this->getDoctrine()->getManager(), $purger);
        $executor->execute($loader->getFixtures());
    }

    /**
     * Load and execute fixtures from a directory
     *
     * @param string $directory
     */
    protected function loadFixturesFromDirectory($directory)
    {
        $loader = new Loader();
        $loader->loadFromDirectory($directory);
        $this->executeFixtures($loader);
    }
    
    public function loginAs($user, $password)
    {
        $this->client->setServerParameters(array(
            'PHP_AUTH_USER' => $user, 
            'PHP_AUTH_PW' => $password
        ));
    }

    public function getCsrfToken($intention)
    {
        return $this->client->getContainer()->get('form.csrf_provider')->generateCsrfToken($intention);
    }

    protected function getUser()
    {
        return new User;
    }
}
