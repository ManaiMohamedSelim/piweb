<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UtilisateurBundle\Entity\Document;
use DocumentBundle\Form\DocumentAdminType;

class AdminController extends Controller
{
    public function listeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $docs = $em->getRepository("UtilisateurBundle:Document")->findAll();

        return $this->render("DocumentBundle:Admin:index.html.twig",
            array(
                "docs" => $docs
            )
        );
    }


    public function validationAction(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository("UtilisateurBundle:Document")->find($id);
        $form = $this->createForm(DocumentAdminType::class, $doc);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($doc);
            $em->flush();
            return $this->redirectToRoute("liste_documentAdmin");
        }

        return $this->render("DocumentBundle:Admin:DetailDocument.html.twig",
            array(
                "Form" => $form->createView(),
                "doc" => $doc
            ));
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Document = $em->getRepository("UtilisateurBundle:Document")
            ->find($id);
        $em->remove($Document);
        $em->flush();
        return $this->redirectToRoute("liste_documentAdmin");
    }

}