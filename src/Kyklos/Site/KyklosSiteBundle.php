<?php

namespace Kyklos\Site;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KyklosSiteBundle extends Bundle
{
    public function getParent()
    {
      return 'FOSUserBundle';
    }
}
