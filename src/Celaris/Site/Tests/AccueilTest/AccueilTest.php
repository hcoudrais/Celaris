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
     * @group testServerChoiceFirstTime
     */
    public function testServerChoiceFirstTime($server)
    {
        $this->loginAs('userTest', 'userTest');

        $crawler = $this->client->request('GET', '/');

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Servers available")')->count());

        // Récupère l'id du bouton submit du formulaire que je veux tester (#submitServer)
        $form = $crawler->selectButton('submitServer')->form();

        $crawler = $this->client->submit($form, array(
            'name' => $server
        ));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
