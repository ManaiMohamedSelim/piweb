<?php
/**
 * Created by PhpStorm.
 * User: ASUS-PC
 * Date: 23/03/2018
 * Time: 21:14
 */

namespace CovoiturageBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use UtilisateurBundle\Entity\AdressesCov;
use UtilisateurBundle\Entity\Covoiturage;
use UtilisateurBundle\Entity\User;
use UtilisateurBundle\Form\CovoiturageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CovoiturageController extends Controller
{
    public function ListerAction()
    {

        $em=$this->getDoctrine()->getManager();
        $covoiturages=$em->getRepository("UtilisateurBundle:Covoiturage")->findAll();
       $manager = $this->get('mgilet.notification');
         $notif = $manager->createNotification('no !');
        $notif->setMessage('co');
        $notif->setLink('http://symfony.com/');
     //  $manager->addNotification(array($this->getUser()), $notif, true);

      /* $all=$manager->getall();
        foreach ($all as $n) {
        $manager->removeNotification(array($this->getUser()),$n,true);
        }*/

        $notifiableRepo = $this->get('doctrine.orm.entity_manager')->getRepository('MgiletNotificationBundle:NotifiableNotification');



        return $this->render('CovoiturageBundle:Covoiturage:Lister.html.twig',array(
            "covoiturages"=>$covoiturages,
            "notifiableEntity"=>$this->getUser(),
            "nManager"=>$manager
        ));

    }
    public function AfficherAction(Request $request)
    {
        $current_user=$this->getUser();
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("UtilisateurBundle:Covoiturage")->find($id);
        $depart=$em->getRepository("UtilisateurBundle:AdressesCov")->FindByName($covoiturage->getDepart());
        $dest=$em->getRepository("UtilisateurBundle:AdressesCov")->FindByName($covoiturage->getDestination());
        return $this->render('CovoiturageBundle:Covoiturage:Afficher.html.twig',array(
            "c"=>$covoiturage,
            "depart"=>$depart,
            "dest"=>$dest,
            "current_user"=>$current_user
        ));
    }
    public function AjouterAction(Request $request)
    {
        $covoiturage= new Covoiturage();
        $form=$this->createForm(CovoiturageType::class,$covoiturage);
        $em=$this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()){
            $AdrC=new AdressesCov();
            $AdrC->setNom($request->get("depart"));
            if($request->get("test")==0) {
                $AdrC=$em->getRepository("UtilisateurBundle:AdressesCov")->FindByName($AdrC->getNom());
                $serializer= new Serializer(
                  array(
                      new ObjectNormalizer()
                  )
                );
                $data= $serializer->normalize($AdrC);
                return new JsonResponse($data);
            }
           elseif ($request->get("test")>1)
                $AdrC=$em->getRepository("UtilisateurBundle:AdressesCov")->FindByName($AdrC->getNom());
            $AdrC->setLat($request->get("deplat"));
            $AdrC->setLng($request->get("deplng"));
            $em->persist($AdrC);
        $em->flush();
        }
        $form->handleRequest($request);
        if($form->isValid()){
            $covoiturage->setIdU($this->getUser());
            $covoiturage->setEtat(1);
            $covoiturage->setVue(1);
             $em->persist($covoiturage);
             $em->flush();
             return $this->redirectToRoute("covoiturage_Lister");
        }
        $AdressesCov=$em->getRepository("UtilisateurBundle:AdressesCov")->findAll();


        return $this->render("CovoiturageBundle:Covoiturage:Ajouter.html.twig",array(
            "Form"=>$form->createView(),
            "Adresses"=>$AdressesCov
        ));
    }
    public function ModifierAction(Request $request){
        $IdC=$request->get("IdC");
        $depart=$request->get("depart");
        $destination=$request->get("destination");
        $date=$request->get("date");
        $em=$this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("UtilisateurBundle:Covoiturage")->find($IdC);
        $form=$this->createForm(CovoiturageType::class,$covoiturage);
        $em=$this->getDoctrine()->getManager();
        if($request->isXmlHttpRequest()){
            $AdrC=new AdressesCov();
            $AdrC->setNom($request->get("depart"));
            if($request->get("test")==0) {
                $AdrC=$em->getRepository("UtilisateurBundle:AdressesCov")->FindByName($AdrC->getNom());
                $serializer= new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );
                $data= $serializer->normalize($AdrC);
                return new JsonResponse($data);
            }
            elseif ($request->get("test")>1)
                $AdrC=$em->getRepository("UtilisateurBundle:AdressesCov")->FindByName($AdrC->getNom());
            $AdrC->setLat($request->get("deplat"));
            $AdrC->setLng($request->get("deplng"));
            $em->persist($AdrC);
            $em->flush();
        }
        $form->handleRequest($request);
        if($form->isValid()){
            $covoiturage->setIdU($this->getUser());
            $covoiturage->setEtat(1);
            $covoiturage->setVue(1);
            $em->persist($covoiturage);
            $em->flush();
            return $this->redirectToRoute("covoiturage_Lister");
        }
        $AdressesCov=$em->getRepository("UtilisateurBundle:AdressesCov")->findAll();
        return $this->render("CovoiturageBundle:Covoiturage:Modifier.html.twig",array(
            "Form"=>$form->createView(),
            "Adresses"=>$AdressesCov
        ));
    }
    public function SupprimerAction(Request $request)
    {
        $id=$request->get('IdC');
        $em=$this->getDoctrine()->getManager();
        $covoiturage=$em->getRepository("UtilisateurBundle:Covoiturage")->find($id);
        $em->remove($covoiturage);
        $em->flush();
        return $this->redirectToRoute("covoiturage_Lister");
    }
    public function ChercherAction(Request $request){
        $em=$this->getDoctrine()->getManager();

        if ($request->isMethod("POST")){
            if ($request->isXmlHttpRequest()) {
                $serializer = new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );

                $covoiturages = $em->getRepository("UtilisateurBundle:Covoiturage")->findCustom($request->request->get('input'),
                    $request->get('date'),$request->request->get('type'),$request->get('SortBy'));
                $data = $serializer->normalize($covoiturages);
                return new JsonResponse($data);
            }
        }
        $covoiturages=$em->getRepository("UtilisateurBundle:Covoiturage")->findAll();
        return $this->render('CovoiturageBundle:Covoiturage:Lister.html.twig',array(
            "covoiturages"=>$covoiturages
        ));
    }
}