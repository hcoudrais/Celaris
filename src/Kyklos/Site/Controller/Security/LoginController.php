<?php

namespace Kyklos\Site\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LoginController extends Controller
{
    /**
     * @Route ("/", name="home_page")
     * @Template("KyklosSiteBundle::accueil.html.twig")
     */
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le déco haha
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirect($this->generateUrl('fos_user_security_logout'));
        }

        $session = $request->getSession();

        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return array(
            // Valeur du précédent nom d'utilisateur entré par l'internaute
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        );
    }
}