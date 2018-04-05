<?php

namespace EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $events = $em->getRepository('UtilisateurBundle:Evenement')->findWeek();
        return $this->render('EventBundle:Event:events.html.twig', ['events' => $events, 'tag' => 'Evénement de la semaine']);
    }
}
