<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;
use Celaris\Game\Entity\Players;
use Celaris\Game\Form\ServerFormType;
use Celaris\Game\Form\StartGameFormType;

use Celaris\Game\Views\PlayerView;

use Celaris\Site\Entity\Server;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class GameController extends GeneralController
{
    /**
     * @Route ("/start_game", name="start_game")
     */
    public function indexAction(Request $request)
    {
        $server = new Server;
        $form = $this
            ->createForm(new ServerFormType, $server)
            ->submit($request)
        ;

        if (!$form->isValid())
            return $this->redirect($this->generateUrl('home_page'));

        $serverName = $form->getData()->getName();

        $user = $this->getUser();
        $userId = $user->getId();

        $player = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $userId))
        ;

        $playerView = new PlayerView;
        
        $param = array(
            'player' => $playerView->getPlayerInfoView($player),
            'serverName' => $serverName
        );

        // Vérifie si l'utilisateur est sur ce serveur ($serverName)
        // Si c'est le cas, on le redirige sur le jeu sinon sur le formulaire
        // du choix de la race, faction, pseudo ...
        $servers = $this->getUser()->getServers();
        foreach($servers as $server) {
            if ($server->getName() == $serverName)
                return $this->render('CelarisGameBundle:Header:header.html.twig', $param);
        }

        // Si il ne s'est jamais connecté, je créé un nouveau player
        if (!$player instanceof Players) {
            $em = $this->getDoctrine()->getEntityManager();

            $player = new Players();
            $player->setUserId($userId);
            $player->setName($user->getUserName());
            $player->setPoppulation(0);
            $player->setMilitaryPoint(0);
            $player->setWorkPoint(0);
            $player->setResearchPoint(0);
            $em->persist($player);
            $em->flush();
        }

        $param['races'] = $this->getAllRaces();
        $param['factions'] = $this->getAllFactions();

        return $this->render('CelarisGameBundle:Start:menu-start.html.twig', $param);
    }

    /**
     * @Route ("/game", name="game")
     */
    public function gameAction(Request $request)
    {
        $server = new Server;
        $form = $this
            ->createForm(new ServerFormType, $server)
            ->submit($request)
        ;

        if (!$form->isValid())
            return $this->redirect($this->generateUrl('home_page'));

        $serverName = $form->getData()->getName();

        $player = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $this->getUser()->getId()))
        ;
        
        $playerView = new PlayerView;

        return $this->render('CelarisGameBundle:Header:header.html.twig', array(
            'player' => $playerView->getPlayerInfoView($player),
            'serverName' => $serverName
        ));
    }

    /**
     * @Route ("/galaxy", name="menu_galaxy", options={"expose"=true})
     * @Template("CelarisGameBundle:Map:map.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest() || !$this->getUser())
            return $this->redirect($this->generateUrl('home_page'));

        $allCelaris = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Celaris')
            ->getAllCelaris()
        ;
        
        return array('allCelaris' => $allCelaris);
    }

    /**
     * @Route ("form_start_game", name="form_start_game")
     * @Template("CelarisGameBundle:Header:header.html.twig")
     */
    public function startGameAction(Request $request)
    {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('home_page'));

        $form = $this
            ->createForm(new StartGameFormType(), array())
            ->submit($request)
        ;

        if (!$form->isValid()) {
            return $this->render('CelarisGameBundle:Start:menu-start.html.twig', array(
                'races' => $this->getAllRaces(),
                'factions' => $this->getAllFactions(),
                'serverName' => $form->getData()['serverName'],
                'errors' => $this->getErrorMessages($form)
            ));
        }

        $data = $form->getData();
        $serverName = $data['serverName'];

        $user = $this->getUser();
        $userId = $user->getId();

        $em = $this->getDoctrine()->getEntityManager();
        $emAuth = $this->getDoctrine()->getEntityManager('auth');

        $server = $this
            ->getDoctrine()
            ->getRepository('CelarisSiteBundle:Server', 'auth')
            ->findOneByName($serverName)
        ;
        $user->addServer($server);
        $emAuth->persist($user);

        $player = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $userId))
        ;

        $race = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Race')
            ->findOneByName($data['race'])
        ;

        $faction = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Faction')
            ->findOneByName($data['faction'])
        ;

        $player->setRace($race);
        $player->setFaction($faction);
        $player->setName($data['name']);
        $em->persist($player);

        $celaris = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Celaris')
            ->getOneRandomCelaris($data['galaxy'])
        ;
        $celaris->setPlayer($player);
        $em->persist($celaris);

        $emAuth->flush();
        $em->flush();

        $playerView = new PlayerView;
        return array(
            'player' => $playerView->getPlayerInfoView($player)
        );
    }
}
