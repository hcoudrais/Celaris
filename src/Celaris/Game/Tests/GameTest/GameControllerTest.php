<?php

namespace Celaris\Game\Tests\GameTest;

use Celaris\Site\Tests\AbstractTest;

class GameControllerTest extends AbstractTest
{
    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testStartGameFirstTime()
    {
        $this->loginAs('test', 'test');

        $crawler = $this->client->request('POST', '/start_game', array(
            'name' => 'Beta',
            '_token' => $this->getCsrfToken('server')
        ));

        $this->assertGreaterThan(0, $crawler->filter('html:contains("Choose")')->count());

        $form = $crawler->selectButton('submitStartGame')->form();

        $crawler = $this->client->submit($form, array(
            'name' => 'Beta'
        ));

        $this->assertTrue($this->client->getResponse()->isSuccessful());
    }
}
