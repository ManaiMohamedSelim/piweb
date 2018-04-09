<?php

namespace ForumBundle\Controller;

use UtilisateurBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\User;

/**
 * Reclamation controller.
 *
 * @Route("Forum")
 */
class ReclamationController extends Controller
{

    public function newAction(Request $request)
    {
        $us = $this->getUser();
        $em=$this->getDoctrine()->getManager();
        $reclamation = new Reclamation();
        $form = $this->createForm('ForumBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);
        $c=$this->getUser()->getReclamations()->count();
        dump($c);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           if($c==1){
                return $this->redirectToRoute('ajouter_reclamation');
            }
            else
                $reclamation->setIdUser($us);
            $reclamation->setDate(new \DateTime('now'));

            $em->persist($reclamation);
            $em->flush();
            return $this->redirectToRoute('consulter_reclamation');
            }

        return $this->render('ForumBundle:Reclamation:new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    public function afficherAction(){

        $em=$this->getDoctrine()->getManager();
        $reclamation = $em->getRepository(Reclamation::class)->findOneByIdUser($this->getUser());
        $c=$this->getUser()->getReclamations()->count();
        dump($c);

        return $this->render('ForumBundle:Reclamation:reclamation.html.twig', array(
            'reclamation' => $reclamation));

    }

}
