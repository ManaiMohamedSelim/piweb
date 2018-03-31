<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 28/03/2018
 * Time: 13:37
 */

namespace EventBundle\Controller;


use EventBundle\Form\EventForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\Evenement;

class EventController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function ajoutAction(Request $request)
    {
        $user = $this->getUser();
        $event = new Evenement();
        $form = $this->createForm(EventForm::class, $event);
        $form->handleRequest($request);
        if($user !== null) {
            if ($form->isValid()) {
                $event->setEtat("Non");
                $event->setIdOrganisateur($user);
                $em = $this->getDoctrine()->getManager();
                $em->persist($event);
                $em->flush();
                return $this->redirectToRoute('event_homepage');
            }
            return $this->render('EventBundle:Event:ajoutevent.html.twig', ['form' => $form->createView(), 'tag' => 'Ajouter un événement']);
        }
        else{
            return $this->redirectToRoute('fos_user_registration_register');
            }
        }



    public function modifierAction(Request $request)
    {

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