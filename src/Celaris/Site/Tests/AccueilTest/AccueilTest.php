<?php

namespace Celaris\Game\Tests\AccueilTest;

use Celaris\Site\Tests\AbstractTest;

class AccueilTest extends AbstractTest
{
    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testLogin()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Login")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Password")')->count());

        // Récupère l'id du bouton submit du formulaire que je veux tester (#submitLogin)
        $form = $crawler->selectButton('submitLogin')->form();

        // Remplir le formulaire par des valeurs par défaut en précisant les chammps 
        // par leur "name" et l'executé
        $crawler = $this->client->submit($form, array(
            '_username' => 'kiki',
            '_password' => 'kiki'
        ));

        // Lorsqu'il y a une redirection, le code http est 302
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testRegister()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Pas encore inscrit ?")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Adresse e-mail")')->count());

        // Récupère l'id du bouton submit du formulaire que je veux tester (#submitRegister)
        $form = $crawler->selectButton('submitRegister')->form();

        $crawler = $this->client->submit($form, array(
            'fos_user_registration_form[email]' => 'kiki',
            'fos_user_registration_form[username]' => 'kiki',
            'fos_user_registration_form[plainPassword][first]' => 'kiki',
            'fos_user_registration_form[plainPassword][second]' => 'kiki'
        ));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function serversData()
    {
        return array(
            array('Gamma')
        );
    }

    /**
     * @dataProvider serversData
     */
    public function testServerChoice($server)
    {
        $this->login();

        $crawler = $this->client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Servers")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Servers available")')->count());

        // Récupère l'id du bouton submit du formulaire que je veux tester (#submitServer)
        $form = $crawler->selectButton('submitServer')->form();

        $crawler = $this->client->submit($form, array(
            'name' => $server
        ));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    public function serversAvailableData()
    {
        return array(
            array('Alpha'),
            array('Beta')
        );
    }

    /**
     * @dataProvider serversAvailableData
     */
    public function testServerAvailableChoice($server)
    {
        $this->login();

        $crawler = $this->client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Servers")')->count());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Servers available")')->count());

        // Récupère l'id du bouton submit du formulaire que je veux tester (#submitServer)
        $form = $crawler->selectButton('submitServerAvailable')->form();

        $crawler = $this->client->submit($form, array(
            'name' => $server
        ));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessageRegExp /Input "name" cannot take "WrongServer"/
     */
    public function testWrongServerChoice()
    {
        $this->login();

        $crawler = $this->client->request('GET', '/');

        $form = $crawler->selectButton('submitServer')->form();

        $crawler = $this->client->submit($form, array(
            'name' => 'WrongServer'
        ));
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessageRegExp /Input "name" cannot take "WrongServer"/
     */
    public function testWrongServerAvailableChoice()
    {
        $this->login();

        $crawler = $this->client->request('GET', '/');

        $form = $crawler->selectButton('submitServerAvailable')->form();

        $crawler = $this->client->submit($form, array(
            'name' => 'WrongServer'
        ));
    }
}
