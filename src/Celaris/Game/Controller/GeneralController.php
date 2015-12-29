<?php

namespace Celaris\Game\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Form\Form;

use \Symfony\Component\HttpFoundation\Request as Request;

class GeneralController extends Controller
{
    protected function getErrorMessages(Form $form) 
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

    protected function getAllRaces()
    {
        return $this
            ->getRepository('CelarisGameBundle:Race')
            ->getAllRaces()
        ;
    }
    
    protected function getAllFactions()
    {
        return $this
            ->getRepository('CelarisGameBundle:Faction')
            ->getAllFactions()
        ;
    }
    
    protected function getAllServersName()
    {
        $servers = $this
            ->getRepository('CelarisSiteBundle:Server', 'auth')
            ->getAllServers()
        ;

        $names = array();
        foreach ($servers as $server)
            $names[] = $server['name'];
        
        return $names;
    }

    protected function setServerUsed($serverName)
    {
        if (!in_array($serverName, $this->getAllServersName()))
            throw new \Exception("This server name $serverName is invalid");

        $session = $this->get('session');

        $session->set('serverName', $serverName);
    }

    protected function getServerUsed()
    {
        $session = $this->get('session');

        if (is_null($session->get('serverName')))
            $this->redirect($this->generateUrl('home_page'));

        return $session->get('serverName');
    }

    protected function getRepository($entity, $serverName = null)
    {
        if (is_null($serverName))
            $serverName = $this->getServerUsed();

        return $this->getDoctrine()->getRepository($entity, $serverName);
    }

    protected function getManager($serverName = null)
    {
        if (is_null($serverName))
            $serverName = $this->getServerUsed();

        return $this->getDoctrine()->getManager($serverName);
    }
}
