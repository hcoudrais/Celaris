<?php

namespace Celaris\Game\Controller;

use Celaris\Game\Controller\GeneralController;
use Celaris\Game\Entity\Players;
use Celaris\Game\Form\ServerFormType;

use Celaris\Site\Entity\Server;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use \Symfony\Component\HttpFoundation\Request as Request;

class GameController extends GeneralController
{
    /**
     * @Route ("/game", name="game")
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
            ->getPlayerByUserId($userId)
        ;

        $param = array(
            'player' => $this->serializeToArray($player),
            'serverName' => $serverName
        );
        // Je check la race pour savoir si il à commencer sur ce serveur
        // Peut être utiliser un boolean lorsque qu'il aura passé le premier formulaire du jeu
        if ($player instanceof Player && $player->getRace() !== null)
            return $this->render('CelarisGameBundle:Header:header.html.twig', $param);


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
     * @Route ("/galaxy", name="menu_galaxy", options={"expose"=true})
     * @Template("CelarisGameBundle:Map:map.html.twig")
     */
    public function mapAction(Request $request)
    {
        if(!$request->isXmlHttpRequest())
            return $this->redirect($this->generateUrl('home_page'));

        $allCelaris = $this
            ->getDoctrine()
            ->getRepository('CelarisGameBundle:Celaris')
            ->findAll()
        ;
        
        return array('allCelaris' => $this->serializeToArray($allCelaris));
    }
}
