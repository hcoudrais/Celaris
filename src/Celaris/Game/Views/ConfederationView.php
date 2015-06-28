<?php

namespace Celaris\Game\Views;

use Celaris\Game\Entity\Confederation;

class ConfederationView
{
    public function getConfederationInfo(Confederation $confederation)
    {
        if ($confederation) {
            return array (
                'id' => $confederation->getConfederationId(),
                'name' => $confederation->getName()
            );
        }

        return null;
    }
}
