<?php

//namespace Kyklos\Site\Controller;
//
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//
//use \Symfony\Component\HttpFoundation\Request as Request;
//
//use Kyklos\Game\Entity\Server;
//
//class HomeController extends Controller
//{
//    /**
//     * @Route ("/", name="home_page")
//     * @Template("KyklosSiteBundle::accueil.html.twig")
//     */
//    public function indexAction(Request $request)
//    {
//        return array('name' => $request->get('name'));
//    }                                       
//
//    /**
//     * @Route ("/{name}", name="test_route_js", options={"expose"=true})
//           * @Template("KyklosSiteBundle:test:js.html.twig")
//     */
//    public function testJsRouteAction(Request $request)
//    {
//        if(!$request->isXmlHttpRequest())
//            return false;
//
//        $em = $this
//            ->getDoctrine()
//            ->getManager()
//        ;
//
//        $server = new Server;
//        $server->setName('ServerName');
//
//        $em->persist($server);
//        $em->flush();
//        
//        return array('name' => 'kinou');
//    }
//}
