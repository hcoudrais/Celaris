<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;
use Celaris\Game\Entity\Players;
use Celaris\Game\Form\ServerFormType;
use Celaris\Game\Form\StartGameFormType;
use Celaris\Game\Entity\BuildingCelaris;
use Celaris\Game\Entity\ResearchPlayer;

use Celaris\Site\Entity\Server;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class GameController extends GeneralController
{
    /**
     * @Route ("/start_game", name="start_game")
     * @Method({"POST"})
     */
    public function indexAction(Request $request)
    {
        if(!$this->getUser())
            return $this->redirect($this->generateUrl('logout'));

        $server = new Server;
        $form = $this
            ->createForm(new ServerFormType, $server)
            ->submit($request)
        ;

        if (!$form->isValid())
            return $this->redirect($this->generateUrl('logout'));

        $serverName = $form->getData()->getName();
        $this->setServerUsed($serverName);

        $user = $this->getUser();
        $userId = $user->getId();

        $player = $this
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $userId))
        ;

        // Si il ne s'est jamais connecté, je créé un nouveau player
        if (!$player instanceof Players) {
            $em = $this->getManager();

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
     * @Method({"POST"})
     */
    public function gameAction(Request $request)
    {
        if (!$this->getUser())
            return $this->redirect($this->generateUrl('logout'));

        $server = new Server;
        $form = $this
            ->createForm(new ServerFormType, $server)
            ->submit($request)
        ;
        $data = $form->getData();

        if (!$form->isValid())
            return $this->redirect($this->generateUrl('logout'));

        $this->setServerUsed($data->getName());

        return $this->redirect($this->generateUrl('celaris'));
    }

    /**
     * @Route ("/galaxy", name="menu_galaxy", options={"expose"=true})
     * @Template("CelarisGameBundle:Map:map.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('logout'));

        $allCelaris = $this
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
            return $this->redirect($this->generateUrl('logout'));
        
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

        $user = $this->getUser();
        $userId = $user->getId();

        $serverUsed = $this->getServerUsed();

        $em = $this->getManager();
        $emAuth = $this->getManager('auth');

        $server = $this
            ->getRepository('CelarisSiteBundle:Server', 'auth')
            ->findOneByName($serverUsed)
        ;
        $user->addServer($server);
        $emAuth->persist($user);

        $player = $this
            ->getRepository('CelarisGameBundle:Players')
            ->findOneBy(array('userId' => $userId))
        ;

        $race = $this
            ->getRepository('CelarisGameBundle:Race')
            ->findOneByName($data['race'])
        ;

        $faction = $this
            ->getRepository('CelarisGameBundle:Faction')
            ->findOneByName($data['faction'])
        ;

        $player->setRace($race);
        $player->setFaction($faction);
        $player->setName($data['name']);
        $em->persist($player);

        // Il faudra créer une nouvelle planète de type planète mère
        $celaris = $this
            ->getRepository('CelarisGameBundle:Celaris')
            ->getOneRandomCelaris($data['galaxy'])
        ;
        $celaris->setPlayer($player);
        $em->persist($celaris);

//        $buildings = $this->getRepository('CelarisGameBundle:Building')->findAll();
        $researches = $this->getRepository('CelarisGameBundle:Research')->findAll();

        // Créer tout les bâtiments de la nouvelle Celaris (à faire)
//        foreach ($buildings as $building) {
//            $buildingCelaris = new BuildingCelaris();
//
//            $buildingCelaris
//                ->setBuilding($building)
//                ->setCelaris($celaris)
//            ;
//
//            $em->persist($buildingCelaris);
//        }

        foreach ($researches as $research) {
            $researchPlayer = new ResearchPlayer();
            $researchPlayer
                ->setResearch($research)
                ->setPlayer($player)
            ;

            $em->persist($researchPlayer);
        }

        $emAuth->flush();
        $em->flush();

        return $this->redirect($this->generateUrl('celaris'));
    }
}
