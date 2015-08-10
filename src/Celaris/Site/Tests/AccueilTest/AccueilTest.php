<?php

namespace Celaris\Game\Tests\AccueilTest;

use Celaris\Site\Tests\AbstractTest;

class AccueilTest extends AbstractTest
{
    public function serversData()
    {
        return array(
            array('Gamma')
        );
    }

    /**
     * @dataProvider serversData
     */
    public function testServerChoiceFirstTime($server)
    {
        $this->loginAs('test', 'test');

        $crawler = $this->client->request('GET', '/');

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
        $this->loginAs('kiki', 'kiki');

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
        $this->loginAs('kiki', 'kiki');

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
        $this->loginAs('kiki', 'kiki');

        $crawler = $this->client->request('GET', '/');

        $form = $crawler->selectButton('submitServerAvailable')->form();

        $crawler = $this->client->submit($form, array(
            'name' => 'WrongServer'
        ));
    }
}
