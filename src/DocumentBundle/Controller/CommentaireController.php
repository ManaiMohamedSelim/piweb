<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\Commentaire;
use UtilisateurBundle\Entity\Document;
use DocumentBundle\Form\DocumentType;
use DocumentBundle\Form\CommentaireType;

class CommentaireController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        //$doc = $em->getRepository(Document::class)->find($id);
        if ($request->isMethod("POST")) {

            $commentaire = new Commentaire();
            $commentaire->setIdDocument($id);
            $commentaire->setIdUser($this->getUser());
            $commentaire->setPost(new \DateTime('now'));
            $commentaire->setContenu($request->get("idcomm"));
            $em->persist($commentaire);
            $em->flush();

        }

        return $this->redirectToRoute("liste_document");
    }



}