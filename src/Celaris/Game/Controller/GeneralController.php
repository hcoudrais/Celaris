<?php

namespace Celaris\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Form;

class GeneralController extends Controller
{
    public function getErrorMessages(Form $form) 
    {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }

    public function getAllRaces()
    {
        return $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Race')
            ->getAllRaces()
        ;
    }
    
    public function getAllFactions()
    {
        return$this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Faction')
            ->getAllFactions()
        ;
    }
}
