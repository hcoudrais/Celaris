<?php

namespace Celaris\Site\Controller\Security;

use Celaris\Game\Controller\GeneralController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LoginController extends GeneralController
{
    /**
     * @Route ("/", name="home_page")
     * @Template("CelarisSiteBundle::accueil.html.twig")
     */
    public function loginAction(Request $request)
    {
        $session = $request->getSession();

        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        // On récupère la liste de tout les serveurs disponible
        $allServers = $this
            ->getDoctrine()
            ->getRepository('CelarisSiteBundle:Server', 'auth')
            ->findAll()
        ;

        // Si l'utilisateur est déjà identifié, on récupère les serveurs sur 
        // le(s)quel(s) il a déjà joué pour faire la bonne redirection
        $serversUse = array();
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $servers = $this->getUser()->getServers();
            foreach($servers as $server) {
                $serversUse[] = $server->getName();
            }
        }

        return array(
            // Valeur du précédent nom d'utilisateur entré par l'internaute
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
            'servers'       => $allServers,
            'serversUse'    => $serversUse
        );
    }
}