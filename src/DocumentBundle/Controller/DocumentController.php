<?php

namespace DocumentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use UtilisateurBundle\Entity\Document;
use DocumentBundle\Form\DocumentType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class DocumentController extends Controller
{
    public function ajouterAction(Request $request)
    {
        $doc = new Document();
        $doc->setEtat("en attente");
        $doc->setIdUser($this->getUser());
        $form = $this->createForm(DocumentType::class, $doc);
        $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $doc->upload();
                $em->persist($doc);
                $em->flush();
                return $this->redirectToRoute("liste_document");
            }

        return $this->render("DocumentBundle:Document:ajouterDocument.html.twig",
            array(
                "Form" => $form->createView()
            ));
    }

    public function listeAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $list_documents = $em->getRepository("UtilisateurBundle:Document")->findBy(array('etat'=>'publique'));
/////////////////////////////////////////////////////////////////////

        $docs  = $this->get('knp_paginator')->paginate($list_documents, $request->query->getInt('page', 1), 6);

        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {



                $docs = $em->getRepository("UtilisateurBundle:Document")->findDoc($request->get('filter'));
                $encoder = new JsonEncoder();
                $normalizer = new ObjectNormalizer();
                $normalizer->setCircularReferenceHandler(function($object){
                    return $object->getId();
                });
                $serializer = new Serializer([$normalizer], [$encoder]);
                //print_r($modeles);
                $data = $serializer->normalize($docs);
                return new JsonResponse($data);
            }
        }
////////////////////////////////////////////////////////////////////////

        return $this->render("DocumentBundle:Document:ListDocuments.html.twig",
            array(
                "docs" => $docs
            )
        );
    }

    public function listeAttenteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $list_documents = $em->getRepository("UtilisateurBundle:Document")->findById_user($this->getUser());

        $docs  = $this->get('knp_paginator')->paginate($list_documents, $request->query->getInt('page', 1), 6);

        return $this->render("DocumentBundle:Document:ListAttenteDocuments.html.twig",
            array(
                "docs" => $docs
            )
        );
    }

    public function detailAction(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository("UtilisateurBundle:Document")->find($id);
        $coms = $em->getRepository("UtilisateurBundle:Commentaire")->findByIdDocument($id);

        return $this->render("DocumentBundle:Document:DetailDocument.html.twig",
            array(
                "doc" => $doc,
                "coms"=>$coms
            )
        );
    }

    public function supprimerAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Document = $em->getRepository("UtilisateurBundle:Document")
            ->find($id);
        $em->remove($Document);
        $em->flush();
        return $this->redirectToRoute("liste_attente_document");
    }

    public function modifierAction(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $doc = $em->getRepository("UtilisateurBundle:Document")->find($id);
        $doc->setEtat("en attente");
        $doc->setIdUser($this->getUser());
        $form = $this->createForm(DocumentType::class, $doc);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $doc->upload();
            $em->persist($doc);
            $em->flush();
            return $this->redirectToRoute("liste_attente_document");
        }

        return $this->render("DocumentBundle:Document:modifierDocument.html.twig",
            array(
                "Form" => $form->createView()
            ));
    }

    /*public function rechercheAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod("POST")) {
            $filter = $request->get("filter");
            $list_documents = $em->getRepository("UtilisateurBundle:Document")
                                 ->findBy(array("niveau" => $filter, "etat" => "publique"));

            $docs = $this->get('knp_paginator')->paginate($list_documents, $request->query->getInt('page', 1), 6);
        }
        return $this->render("DocumentBundle:Document:ListDocuments.html.twig",
            array(
                "docs" => $docs
            )
        );
    }*/

}