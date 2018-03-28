<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 28/03/2018
 * Time: 13:37
 */

namespace EventBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EventController extends Controller
{
    public function ajoutAction()
    {
        return $this->render('EventBundle:Event:ajoutevent.html.twig');
    }

    public function modifierAction()
    {
        return $this->render('EventBundle:Event:modifevent.html.twig');
    }

    public function listerAction()
    {
        return $this->render('EventBundle:Event:listevents.html.twig');
    }

    public function myEventsAction()
    {
        return $this->render('EventBundle:Event:listevents.html.twig');
    }
}