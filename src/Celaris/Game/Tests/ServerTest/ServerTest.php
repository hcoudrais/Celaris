<?php

namespace Celaris\Game\Tests\ServerTest;

use Celaris\Game\Tests\AbstractTest;

class ServerTest extends AbstractTest
{
    public function testFormServerChoice()
    {
        $user = $this->getUser();

        $allServers = $this
            ->getDoctrine()
            ->getRepository('CelarisSiteBundle:Server')
            ->listServersAvailableAndServersUsed($user)
        ;

        var_dump($allServers);
    }
}
