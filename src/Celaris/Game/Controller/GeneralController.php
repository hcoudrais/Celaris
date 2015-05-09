<?php

namespace Celaris\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GeneralController extends Controller
{
    public function getAllRaces()
    {
        $races = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Race')
            ->findAll()
        ;

        return $this->serializeToArray($races);
    }

    public function getAllFactions()
    {
        $factions = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Faction')
            ->findAll()
        ;

        return $this->serializeToArray($factions);
    }
    
    public function serializeToArray($data)
    {
        $var = (array) $data;
        $result = array();

        foreach($var as $key => &$value) {
            $regex = '/[\W][*][\W]/';
            $key = preg_replace($regex,'', $key);
            
            if(is_object($value))
                $value = $this->serializeToArray($value);

            $result[$key] = $value;
        }

        return $result;
    }
}
