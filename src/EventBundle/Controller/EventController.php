<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 28/03/2018
 * Time: 13:37
 */

namespace EventBundle\Controller;


use EventBundle\Form\CommentaireForm;
use EventBundle\Form\EventEditForm;
use EventBundle\Form\EventForm;
use EventBundle\Form\ReservationForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UtilisateurBundle\Entity\Commentaire;
use UtilisateurBundle\Entity\Evenement;
use Symfony\Component\HttpFoundation\Response;
use UtilisateurBundle\Entity\Reservation;
use UtilisateurBundle\Entity\User;

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
        $user = $this->getUser();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('UtilisateurBundle:Evenement')->find($id);
        $form = $this->createForm(EventEditForm::class,$evenement);
        $form->handleRequest($request);
        if ($user !== null) {
            if ($form->isValid()) {
                $em->persist($evenement);
                $em->flush();
                return $this->redirectToRoute('my_events');
            }
        }else{
            return $this->redirectToRoute('fos_user_registration_register');
        }
        return $this->render('EventBundle:Event:modifevent.html.twig', ['events' => null,'form' => $form->createView(),'tag' => 'Modifier événement']);


    }

    public function supprimerAction(Request $request){
        $user = $this->getUser();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository('UtilisateurBundle:Evenement')->find($id);
        if ($user !== null && $evenement->getIdOrganisateur() == $user ) {
            $em->remove($evenement);
            $em->flush();
            $this->addFlash(
                'success',
                'Supression avec succès!'
            );
        }
        else {
            $this->addFlash(
                'success',
                'Vous n\'êtes éligble pour supprimer cet événement!'
            );
        }
        return $this->render('EventBundle:Event:suppevent.html.twig',['events'=> null,'tag' => 'Supprimer événement']);
    }

    public function listerAction(Request $request){
        return $this->render('EventBundle:Event:listevents.html.twig',['events'=>null,
            'tag'=> 'Liste des événements', 'select'=> null]);

    }


    public function myEventsAction()
    {
        return $this->render('EventBundle:Event:myevents.html.twig', ['tag' => 'Mes événements', 'events'=>null,]);
    }

    public function detailsAction(Request $request){
        $id = $request->get('id');
        $user = $this->getUser();
        $reservation = new Reservation();
        $commentaire = new Commentaire();


        //initialisation des formulaires
        $formRes = $this->createForm(ReservationForm::class, $reservation);
        $formCom = $this->createForm(CommentaireForm::class, $commentaire);
            $formCom->handleRequest($request);
            $formRes->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('UtilisateurBundle:Evenement')->find($id);
        $check = count($em->getRepository('UtilisateurBundle:Reservation')->findBy(['idEvenement' => $event,
                                   'idParticipant' => $user, 'etat' => 'Confirmé']));
        $dispo = $event->getNombre() - count($em->getRepository('UtilisateurBundle:Reservation')->findBy(["idEvenement" => $event, "etat" => "Confirmé"]));
        if ($dispo == 0){
            $dispo = "Complet";
        }
        else {
            if ($user !== null) {
                if ($formRes->isValid() && $request->request->has($formRes->getName())) {
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
                    return $this->redirectToRoute('my_res');
                }
            }
        }

        // Partie commentaires
        if ($formCom->isValid() && $request->request->has($formCom->getName())) {
            $commentaire->setIdEvenement($event);
            $commentaire->setIdUser($user);
            $commentaire->setEtatCommentaire("OK");
            $event->addCommentaire($commentaire);
            $em->persist($commentaire);
            $em->flush();
        }

        //Reporter
        $idreport = $request->request->get('idComm');
        $commentaireRep = new Commentaire();
        if($idreport) {
            $commentaireRep = $em->getRepository('UtilisateurBundle:Commentaire')->find($idreport);
            $commentaireRep->setEtatCommentaire('Reported');
            $em->persist($commentaireRep);
            $em->flush();
            }

        return $this->render('EventBundle:Event:details.html.twig', ['event' => $event, 'events' => null, 'tag' => 'Détails',
                                 'formRes' => $formRes->createView(),'dispo' => $dispo, 'formCom' => $formCom->createView(),
                                  'check' => $check
            ]);
    }

    public function dataAction(Request $request)
    {
        $length = $request->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $request->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $request->get('search');

        $user = new User();
        $user = $this->getUser();
        $filters = [
            'query' => @$search['value'],
            'user' => @$user,
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
                $output['data'][] = [
                    'nom' => "<span class=\"glyphicon glyphicon-plus\"></span>".$event->getNom(),
                    'type' => $event->getType(),
                    'typeRes' => $event->getTypeReservation(),
                    'prix' => ($event->getPrix()) ? $event->getPrix(). ' DT': 'Entrée Gratuite',
                    'DateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                    'duree' => $event->getDuree(),
                    'lieu' => $event->getLieu(),
                    'nombre' => $event->getNombre(),
                    'Description' => $event->getDescription(),
                    'Affiche' => '<img class="aff" src="/affiches/'.$event->getAffiche().'"/>',
                    'Details' => "<a href=".$this->generateUrl('details_event',['id' => $event->getID()])." target=\"_blank\"><span class=\"glyphicon glyphicon-plus\"></span></a>",
                    'Modifier' => "<a href=".$this->generateUrl('modifier_event',['id' => $event->getID()])." target=\"_blank\"><span class=\"glyphicon glyphicon-cog\"></span></a>",
                    'Supprimer' => "<a href=".$this->generateUrl('supprimer_event',['id' => $event->getID()])." target=\"_blank\"><span class=\"glyphicon glyphicon-trash\"></span></a>"
                    ];

        }

        return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);

    }

    public function dataAllAction(Request $request)
    {
        $length = $request->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $request->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $request->get('search');

        $filters = [
            'query' => @$search['value'],
            'user' => null,
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
                $output['data'][] = [
                    'nom' => "<span class=\"glyphicon glyphicon-plus\"></span>".$event->getNom(),
                    'type' => $event->getType(),
                    'typeRes' => $event->getTypeReservation(),
                    'prix' => ($event->getPrix()) ? $event->getPrix(). ' DT': 'Entrée Gratuite',
                    'DateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                    'duree' => $event->getDuree(),
                    'lieu' => $event->getLieu(),
                    'nombre' => $event->getNombre(),
                    'Description' => $event->getDescription(),
                    'Affiche' => '<img class="aff" src="/affiches/'.$event->getAffiche().'"/>',
                    'Details' => "<a href=".$this->generateUrl('details_event',['id' => $event->getID()])." target=\"_blank\"><span class=\"glyphicon glyphicon-plus\"></span></a>"
                ];

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

    public function reporterAction(Request $request){

    }

    public function myResAction(){
        return $this->render('EventBundle:Event:myres.html.twig', ['tag' => 'Mes événements', 'events'=>null,]);
    }

    public function dataResAction(Request $request){

        $length = $request->get('length');
        $length = $length && ($length!=-1)?$length:0;

        $start = $request->get('start');
        $start = $length?($start && ($start!=-1)?$start:0)/$length:0;

        $search = $request->query->get('search');

        $user = new User();
        $user = $this->getUser();
        $filters = [
            'query' => @$search['value'],
            'user' => @$user,
        ];

        $events = $this->getDoctrine()->getRepository('UtilisateurBundle:Evenement')->searchRes(
            $filters, $start, $length
        );

        $output = array(
            'data' => array(),
            'recordsFiltered' => count($this->getDoctrine()->getRepository('UtilisateurBundle:Evenement')->searchRes($filters, 0, false)),
            'recordsTotal' => count($this->getDoctrine()->getRepository('UtilisateurBundle:Evenement')->searchRes(array(), 0, false))
        );
        foreach ($events as $event) {
            $reservations = $event->getReservations();
            foreach ($reservations as $reservation) {
                if ($reservation->getIdParticipant() == $user && $reservation->getEtat() == "Annulé" ) {
                        $output['data'][] = [

                            'nom' => "<span class=\"glyphicon glyphicon-plus\"></span>" . $event->getNom(),
                            'etat' => $reservation->getEtat(),
                            'type' => $event->getType(),
                            'typeRes' => $event->getTypeReservation(),
                            'prix' => ($event->getPrix()) ? $event->getPrix(). ' DT': 'Entrée Gratuite',
                            'DateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                            'duree' => $event->getDuree(),
                            'lieu' => $event->getLieu(),
                            'nombre' => $event->getNombre(),
                            'Description' => $event->getDescription(),
                            'Affiche' => '<img class="aff" src="/affiches/' . $event->getAffiche() . '"/>',
                            'Details' => "<a href=" . $this->generateUrl('details_event', ['id' => $event->getID()]) . " target=\"_blank\"><span class=\"glyphicon glyphicon-plus\"></span></a>",
                            'Action' => "<a href=" . $this->generateUrl('confirmer_res', ['id' => $reservation->getIdReservation()]) . " target=\"_blank\">reconfirmer<span class=\"glyphicon glyphicon-remove\"></span></a>"
                        ];

                    }
                  else if ($reservation->getIdParticipant() == $user && $reservation->getEtat() == "Confirmé"){
                      $output['data'][] = [

                          'nom' => "<span class=\"glyphicon glyphicon-plus\"></span>" . $event->getNom(),
                          'etat' => $reservation->getEtat(),
                          'type' => $event->getType(),
                          'typeRes' => $event->getTypeReservation(),
                          'prix' => ($event->getPrix()) ? $event->getPrix(). ' DT': 'Entrée Gratuite',
                          'DateEvent' => $event->getDateEvent()->format('Y-m-d H:i:s'),
                          'duree' => $event->getDuree(),
                          'lieu' => $event->getLieu(),
                          'nombre' => $event->getNombre(),
                          'Description' => $event->getDescription(),
                          'Affiche' => '<img class="aff" src="/affiches/' . $event->getAffiche() . '"/>',
                          'Details' => "<a href=" . $this->generateUrl('details_event', ['id' => $event->getID()]) . " target=\"_blank\"><span class=\"glyphicon glyphicon-plus\"></span></a>",
                          'Action' => "<a href=" . $this->generateUrl('annuler_res', ['id' => $reservation->getIdReservation()]) . " target=\"_blank\">annuler<span class=\"glyphicon glyphicon-ok\"></span></a>"
                      ];
                  }
                }
            }


            return new Response(json_encode($output), 200, ['Content-Type' => 'application/json']);



    }

    public function annulerResAction(Request $request){
        $user = $this->getUser();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('UtilisateurBundle:Reservation')->find($id);
        if ($user !== null && $reservation->getIdParticipant() == $user ) {
            $reservation->setEtat("Annulé");
            $em->persist($reservation);
            $em->flush();
            $this->addFlash(
                'success',
                'Annulation avec succès!'
            );
        }
        else {
            $this->addFlash(
                'success',
                'Vous n\'êtes éligble pour annuler cette réservation!'
            );
        }
        return $this->render('EventBundle:Event:annulerRes.html.twig',['events'=> null,'tag' => 'Annuler réservation']);
    }

    public function confirmerResAction(Request $request){
        $user = $this->getUser();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $reservation = $em->getRepository('UtilisateurBundle:Reservation')->find($id);
        if ($user !== null && $reservation->getIdParticipant() == $user ) {
            $reservation->setEtat("Confirmé");
            $em->persist($reservation);
            $em->flush();
            $this->addFlash(
                'success',
                'Reconfirmation avec succès!'
            );
        }
        else {
            $this->addFlash(
                'success',
                'Vous n\'êtes éligble pour reconfirmer cette réservation!'
            );
        }
        return $this->render('EventBundle:Event:annulerRes.html.twig',['events'=> null,'tag' => 'Reconfirmer réservation']);
    }






}