<?php

namespace Celaris\Site\Controller\Security;

use Celaris\Game\Controller\GeneralController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

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

        $allServers = $this
            ->getRepository('CelarisSiteBundle:Server', 'auth')
            ->listServersAvailableAndServersUsed($this->getUser())
        ;

        return array(
            // Valeur du précédent nom d'utilisateur entré par l'internaute
            'last_username'   => $session->get(SecurityContext::LAST_USERNAME),
            'error'           => $error,
            'servers'         => $allServers['servers'],
            'serversUse'      => $allServers['serversUse']
        );
    }

    /**
     * @Route ("/register/", name="register")
     * @Template("CelarisSiteBundle::register.html.twig")
     */
    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                // Je redirige vers le menu, comme il est authentifié, il choisira
                // le serveur sur lequel il veut jouer.
                $url = $this->generateUrl('home_page');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }
        
        return array(
            'form' => $form->createView()
        );
    }
}