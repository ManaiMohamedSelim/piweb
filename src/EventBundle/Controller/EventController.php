<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 28/03/2018
 * Time: 13:37
 */

namespace EventBundle\Controller;


use EventBundle\Form\EventForm;
use EventBundle\Form\ReservationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\Evenement;
use Symfony\Component\HttpFoundation\Response;
use UtilisateurBundle\Entity\Reservation;

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
            return $this->render('EventBundle:Event:ajoutevent.html.twig', ['events' => null,'form' => $form->createView(), 'tag' => 'Ajouter un événement']);
        }
        else{
            return $this->redirectToRoute('fos_user_registration_register');
            }
        }



    public function modifierAction(Request $request)
    {

    }

    public function listerAction(Request $request){
        return $this->render('EventBundle:Event:listevents.html.twig',['events'=>null,
            'tag'=> 'Liste des événements', 'select'=> null]);



    }


    public function myEventsAction()
    {
        return $this->render('EventBundle:Event:listevents.html.twig');
    }

    public function detailsAction(Request $request){
        $id = $request->get('id');
        $user = $this->getUser();
        $reservation = new Reservation();
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('UtilisateurBundle:Evenement')->find($id);
        $form = $this->createForm(ReservationForm::class, $reservation);
        $form->handleRequest($request);
        if($user !== null) {
            if ($form->isValid()) {
                $numTicket = count($em->getRepository('UtilisateurBundle:Reservation')->findBy(["idEvenement" => $event, "etat" => "Confirmé"]));
                $reservation->setIdParticipant($user);
                $reservation->setIdEvenement($event);
                $reservation->setTypeReservation($event->getTypeReservation());
                if ($event->getTypeReservation() == "Payante") {
                    $reservation->setTarif($event->getPrix());
                }
                if ($numTicket) {
                    $reservation->setNumeroTicket($numTicket + 1);
                } else {
                    $reservation->setNumeroTicket(1);
                }
                $reservation->setEtat("Confirmé");

                $event->addReservation($reservation);
                $em->persist($reservation);
                $em->flush();
            }
        }

        return $this->render('EventBundle:Event:details.html.twig', ['event' => $event, 'events' => null, 'tag' => 'Détails',
                                 'form' => $form->createView()
            ]);
    }

    public function dataAction(Request $request)
    {
        $length = $request->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $request->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $request->get('search');
        $filters = [
            'query' => @$search['value'],
        ];

        $events = $this->getDoctrine()->getRepository('UtilisateurBundle:Evenement')->search(
            $filters, $start, $length
        );

        $output = array(
            'data' => array(),
            'recordsFiltered' => count($this->getDoctrine()->getRepository('UtilisateurBundle:Evenement')->search($filters, 0, false)),
            'recordsTotal' => count($this->getDoctrine()->getRepository('UtilisateurBundle:Evenement')->search(array(), 0, false))
        );
        foreach ($events as $event) {
            if ($event->getTypeReservation() == "Gratuite" ){
                $output['data'][] = [
                    'nom' => "<span class=\"glyphicon glyphicon-plus\"></span>".$event->getNom(),
                    'type' => $event->getType(),
                    'typeRes' => $event->getTypeReservation(),
                    'prix' => "Entrée gratuite",
                    'DateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                    'duree' => $event->getDuree(),
                    'lieu' => $event->getLieu(),
                    'nombre' => $event->getNombre(),
                    'Description' => $event->getDescription(),
                    'Affiche' => '<img class="aff" src="/affiches/'.$event->getAffiche().'"/>',
                    'Details' => "<a href=".$this->generateUrl('details_event',['id' => $event->getID()])." target=\"_blank\"><span class=\"glyphicon glyphicon-plus\"></span></a>"
                ];
            }
            else{
                $output['data'][] = [
                    'nom' => "<span class=\"glyphicon glyphicon-plus\"></span>".$event->getNom(),
                    'type' => $event->getType(),
                    'typeRes' => $event->getTypeReservation(),
                    'prix' => $event->getPrix().' DT',
                    'DateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                    'duree' => $event->getDuree(),
                    'lieu' => $event->getLieu(),
                    'nombre' => $event->getNombre(),
                    'Description' => $event->getDescription(),
                    'Affiche' => '<img class="aff" src="/affiches/'.$event->getAffiche().'"/>',
                    'Details' => "<a href=".$this->generateUrl('details_event',['id' => $event->getID()])." target=\"_blank\"><span class=\"glyphicon glyphicon-plus\"></span></a>"
                ];

            }

        }

        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);

    }

    public function lister1Action(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT e FROM UtilisateurBundle:Evenement e";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );

        // parameters to template
        return $this->render('EventBundle:Event:listevents.html.twig', ['events' => null,'pagination' => $pagination, 'tag' => 'Liste des événements']);
    }

    public function reserverAction(Request $request,$id){
        if ($request->isMethod('POST')) {
            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository('UtilisateurBundle:Evenement')->findOneBy(["id" => $id]);
            $numTicket = count($em->getRepository('UtilisateurBundle:Reservation')->findBy(["IdEvenement" => $event, "Etat" => "Confirmé"]));
            $user = $this->getUser();
            $reservation = new Reservation();
            $reservation->setIdEvenement($user);
            $reservation->setIdEvenement($event);
            $reservation->setTypeReservation($event->getTypeReservation());
            if ($event->getTypeReservation() == "Payante") {
                $reservation->setTarif($event->getPrix());
            }
            if ($numTicket) {
                $reservation->setNumeroTicket($numTicket + 1);
            } else {
                $reservation->setNumeroTicket(1);
            }
            $reservation->setEtat("Confirmé");

            $event->getReservations()->addReservation($reservation);
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('event_homepage');
        }

    }

    public function commenterAction($id){

    }





}