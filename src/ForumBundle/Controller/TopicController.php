<?php
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 22/03/2018
 * Time: 13:03
 */

namespace ForumBundle\Controller;


use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ForumBundle\Form\TopicType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UtilisateurBundle\Entity\Commentaire;
use UtilisateurBundle\Entity\Topic;
use Ob\HighchartsBundle\Highcharts\Highchart;


class TopicController extends Controller
{
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $topics = $em->getRepository(Topic::class)->findAll();
        $us = $this->getUser();
        $topic = new Topic();
        $form = $this->createForm(TopicType::class, $topic);
        $topic->setIdUser($this->getUser());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $topic->setIdUser($us);
            $topic->setDate(new \DateTime('now'));
            $topic->upload();
            $topic = $form->getData();
            $em->persist($topic);
            $em->flush();
            return $this->redirectToRoute('afficher_topics', array(
                "topics" => $topics
            ));
        }
        return $this->render('ForumBundle:Topic:new.html.twig', array(
            "form" => $form->createView()
        ));
    }

    public function afficherAction(Request $request)
    {


//        $encoders = array(new XmlEncoder(), new JsonEncoder());
//        $normalizer = new ObjectNormalizer();
//        $normalizer->setCircularReferenceLimit(2);
//        $normalizer->setCircularReferenceHandler(function ($object) {
//            return $object->getId();
//        });
//        $normalizers = array($normalizer);
//        $serializer = new Serializer($normalizers, $encoders);
        $em = $this->getDoctrine()->getManager();
        $listetopics = $em->getRepository(Topic::class)->findAll();
        $paginator  = $this->get('knp_paginator');
        dump(get_class($paginator));
        $topics = $paginator->paginate(
            $listetopics,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2));


        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {
                $topics = $em->getRepository(Topic::class)->findTopicAjax($request->request->get('user'));
//                $jsonContent = $serializer->normalize($topics);
//                return new JsonResponse( $jsonContent);
                $encoder = new JsonEncoder();
                $normalizer = new ObjectNormalizer();
                $normalizer->setCircularReferenceHandler(function($object){
                return $object->getId();
                });
                $serializer = new Serializer([$normalizer], [$encoder]);
                $data = $serializer->normalize($topics);
                return new JsonResponse($data);
            }

        }
        return $this->render('ForumBundle:Topic:list.html.twig', array(
            "topics" => $topics,

        ));

    }

    public function mesTopicsAction(Request $request)
    {
        $us = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $listetopics = $em->getRepository(Topic::class)->findByIdUser($us);
        $paginator  = $this->get('knp_paginator');
        dump(get_class($paginator));
        $topic = $paginator->paginate(
            $listetopics,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2));
        return $this->render('ForumBundle:Topic:mesTopics.html.twig', array(
            "topic" => $topic

        ));

    }

    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }


    public function detailsAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $topic = $em->getRepository(Topic::class)->find($request->get("id"));
        $commentaires = $em->getRepository(Commentaire::class)->diffDate($request->get("id"));
        $idus = $this->getUser()->getId();
        dump($idus);
        return $this->render('ForumBundle:Topic:details.html.twig', array(
            "topic" => $topic,
            "comment" => $commentaires,
            "idus"=>$idus
        ));


    }

    public function deleteAction(Request $request)
    {

        $us = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $id = $request->get("id");
        $topic = $em->getRepository(Topic::class)->find($id);
        $em->remove($topic);

        $em->flush();
        $topics = $em->getRepository(Topic::class)->findBy(array('idUser' => $us));
        return $this->render('ForumBundle:Topic:mesTopics.html.twig', array(
          "topic" => $topics));



    }


    public function modifierAction(Request $request)
    {
        $id = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        $topic = $em->getRepository(Topic::class)->find($id);
        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $topic->upload();
            $em->persist($topic);
            $em->flush();
        return $this->redirectToRoute("afficher_topics");

        }
        return $this->render('ForumBundle:Topic:edit.html.twig', array(

            "form" => $form->createView()

        ));


    }

    public function topicAjaxAction(Request $request)
    {



        $em = $this->getDoctrine()->getManager();
        $top = $em->getRepository(Topic::class)->findAll();

        return $this->render('ForumBundle:Topic:list.html.twig',array(

            "topics"=>$top));

    }


    public function chartAction(){
        $em=$this->getDoctrine()->getManager();
        $topics=$em->getRepository(Topic::class)->findAll();
        $ob = new Highchart();
        $ob->chart->renderTo('linechart');
        $ob->title->text('Les publications les plus commentées');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => false),
            'showInLegend'  => true
        ));
//        $c=$topics[0]->getSujet();
//        $comments = $topics[0]->getComments();
//        $yop=$comments->count();
        $data = array();
        foreach ($topics as $topic){
            $comments = $topic->getComments();
            $count = $comments->count();
            dump($count);
            $a=array($topic->getSujet(),$comments->count());
            array_push($data,$a);
        }
        $ob->series(array(array('type' => 'pie','name' => 'Nombre de commentaires', 'data' => $data)));
        return $this->render('ForumBundle:Topic:accueil.html.twig', array('piechart' =>
         $ob,
            "topics"=>$topics
            ));
    }





}



