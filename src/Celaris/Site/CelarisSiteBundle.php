<?php

namespace Celaris\Site;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CelarisSiteBundle extends Bundle
{
    public function getParent()
    {
      return 'FOSUserBundle';
    }
}
