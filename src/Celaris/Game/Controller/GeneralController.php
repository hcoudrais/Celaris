<?php

namespace Celaris\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GeneralController extends Controller
{
    public function serializer($data, $format)
    {
        $serializer = $this->get('jms_serializer');

        if ($format == 'array') {
            $formatData = $serializer->serialize($data, 'json');
            return json_decode($formatData, true);
        }

        return $serializer->serialize($data, $format);
    }
}
