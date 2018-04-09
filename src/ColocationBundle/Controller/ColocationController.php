<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 23-03-18
 * Time: 15:16
 */

namespace ColocationBundle\Controller;


use UtilisateurBundle\Entity\Colocation;
use ColocationBundle\Form\ColocationType;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use UtilisateurBundle\Entity\FavorisColocation;

class ColocationController extends Controller
{
    public function ajoutColocationAction(Request $request){
        $Colocation=new Colocation();
        $form=$this->createForm(ColocationType::class,$Colocation);
        $form->handleRequest($request);
        $us=$this->getUser();


        if($form->isValid()) {
            //suite au clique sur le bouton submit
            $em = $this->getDoctrine()->getManager();
            $Colocation->upload();
            $Colocation->setIdUser($us);
            $em->persist($Colocation);
            $em->flush();
            return $this->redirectToRoute("affich_colocation");}

            return $this->render("ColocationBundle:Colocation:ajoutColoc.html.twig",
                array(
                    "Form" =>$form->createView()
                ));
        }

    public function affichColocationAction(Request $request){

        //créer une instance de notre entity  manager
        $em=$this->getDoctrine()->getManager();
        $listfav=$em->getRepository("UtilisateurBundle:FavorisColocation")->findBy(
            array(
                'idUser'=>$this->getUser()
            )
        );

        $Colocation=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Annonce'));
        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {
                $serializer = new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );
                $colocation = $em->getRepository("ColocationBundle:Colocation")
                    ->findcolocationAjax($request->get('prixx'),$request->get('prixx'));

                //print_r($modeles);
                $data = $serializer->normalize($colocation);
                return new JsonResponse($data);

   }
        }
        return $this->render("ColocationBundle:Colocation:affich.html.twig",
            array(
                'colocations'=>$Colocation,
                'listfav'=>$listfav
            ));

    }

    public function affichDemandeAction(Request $request){

        //créer une instance de notre entity  manager
        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Demande'));
        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {
                $serializer = new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );
                $colocation = $em->getRepository("ColocationBundle:Colocation")
                    ->finddemandeAjax($request->get('prixx'),$request->get('prixx'));

                //print_r($modeles);
                $data = $serializer->normalize($colocation);
                return new JsonResponse($data);

            }
        }

        return $this->render("ColocationBundle:Colocation:affichDemande.html.twig",
            array(
                'colocations'=>$Colocation
            ));

    }
    public function showcolocationAction(Request $request)
    {
        $id=$request->get("id");

        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $Colocation->upload();

        return $this->render('ColocationBundle:Colocation:showcoloc.html.twig', array(

            'colocation'=>$Colocation,


        ));
    }

    public function showAnnonceAction(Request $request)
    {
        $id=$request->get("id");

        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $Colocation->upload();

        return $this->render('ColocationBundle:Colocation:showannonce.html.twig', array(

            'colocation'=>$Colocation,


        ));
    }
    public function showDemandeAction(Request $request)
    {
        $id=$request->get("id");

        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $Colocation->upload();

        return $this->render('ColocationBundle:Colocation:showdemande.html.twig', array(

            'colocation'=>$Colocation,


        ));
    }
    public function detailDemandeAction(Request $request)
    {
        $id=$request->get("id");

        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $Colocation->upload();

        return $this->render('ColocationBundle:Colocation:showdemandedetail.html.twig', array(

            'colocation'=>$Colocation,


        ));
    }
    public function demandeColocationAction(Request $request){
        $Colocation=new Colocation();
        $us=$this->getUser();

        $form=$this->createFormBuilder($Colocation)
            ->add('typeColocation',HiddenType::class,array('empty_data' => 'Demande'))
            ->add('Adresse',TextType::class)
            ->add('sexe',TextType::class)
            ->add('typeMaison',ChoiceType::class,
             array( 'choices' =>
                    array( 'Appartement' => 'Appartement'
                    , 'Maison' => 'Maison'
                    , 'Studio' => 'Studio'  ),
                      'label'=>'Type de colocation :')


            )
            ->add('placeDispo',ChoiceType::class,
                array( 'choices' =>
                    array( '0' => '0'
                    , '1' => '1'
                    , '2' => '2'
                    , '3' => '3' ),
                'label'=>'nombre de colocataire souhaitée')


            )
            ->add('Description',TextareaType::class)
            ->add('file')
            ->getForm();
        $form->handleRequest($request);


        if($form->isValid()&& $form->isSubmitted()) {
            //suite au clique sur le bouton submit
            $em = $this->getDoctrine()->getManager();
            $Colocation->upload();
            $Colocation->setIdUser($us);

            $em->persist($Colocation);
            $em->flush();
            return $this->redirectToRoute("affich_demande");}

        return $this->render("ColocationBundle:Colocation:demandColoc.html.twig",
            array(
                "Form" =>$form->createView()
            ));
    }

    public function mesannonceColocationAction(){

        //créer une instance de notre entity  manager

        $em=$this->getDoctrine()->getManager();
        $us=$this->getUser();

        $Colocation=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Annonce',
            'idUser'=>$us

        ));
        return $this->render("ColocationBundle:Colocation:mesannonce.html.twig",
            array(
                'colocations'=>$Colocation
            ));

    }
    public function mesDemandeAction(){

        //créer une instance de notre entity  manager

        $em=$this->getDoctrine()->getManager();
        $us=$this->getUser();

        $Colocation=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Demande',
            'idUser'=>$us

        ));
        return $this->render("ColocationBundle:Colocation:mesDemande.html.twig",
            array(
                'colocations'=>$Colocation
            ));

    }

    public function supprimercolocationAction(Request $request){
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $em->remove($Colocation);
        $em->flush();
        return $this->redirectToRoute("mesannonce_colocation");


    }
    public function supprimerDemandeAction(Request $request){
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $em->remove($Colocation);
        $em->flush();
        return $this->redirectToRoute("mes_demande");


    }

    public function modifierColocationAction(Request $request){
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();

        $Colocation=$em->getRepository("ColocationBundle:Colocation")
            ->find($id);
        $form=$this->createForm(ColocationType::class,$Colocation);
        $form->handleRequest($request);
        if($form->isValid()&& $form->isSubmitted()){
            $Colocation->upload();
            $em->persist($Colocation);
            $em->flush();
            return $this->redirectToRoute("mesannonce_colocation");
        }

        return $this->render("ColocationBundle:Colocation:editcoloc.html.twig",
            array(
                "Form" =>$form->createView()
            ));
    }
    public function modifierDemandeAction(Request $request){
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();

        $Colocation=$em->getRepository("ColocationBundle:Colocation")
            ->find($id);
        $form=$this->createFormBuilder($Colocation)
            ->add('typeColocation',HiddenType::class,array('empty_data' => 'Demande'))
            ->add('Adresse',TextType::class)
            ->add('sexe',TextType::class)
            ->add('typeMaison',ChoiceType::class,
                array( 'choices' =>
                    array( 'Appartement' => 'Appartement'
                    , 'Maison' => 'Maison'
                    , 'Studio' => 'Studio'  ),
                    'label'=>'Type de colocation :')


            )
            ->add('placeDispo',ChoiceType::class,
                array( 'choices' =>
                    array( '0' => '0'
                    , '1' => '1'
                    , '2' => '2'
                    , '3' => '3' ),
                    'label'=>'nombre de colocataire souhaitée')


            )
            ->add('Description',TextareaType::class)
            ->add('file')
            ->getForm();
        $form->handleRequest($request);
        if($form->isValid()&& $form->isSubmitted()){
            $Colocation->upload();
            $em->persist($Colocation);
            $em->flush();
            return $this->redirectToRoute("mes_demande");
        }

        return $this->render("ColocationBundle:Colocation:editDemande.html.twig",
            array(
                "Form" =>$form->createView()
            ));
    }


    public function favorisAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $Colocations=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Annonce'));
        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {
                $idcoloc=$request->get('id');
                $Colocation=$em->getRepository("UtilisateurBundle:Colocation")
                    ->find($idcoloc);
                $favoris=new FavorisColocation();
                $favoris->setIdColocation($Colocation);
                $favoris->setIdUser($this->getUser());
                $em->persist($favoris);
                $em->flush();
            }
        }
        return $this->render("ColocationBundle:Colocation:affichDemande.html.twig",
            array(
                'colocations'=>$Colocations
            ));

    }
    public function NonfavorisAction(Request $request){
        $em=$this->getDoctrine()->getManager();
        $Colocations=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Annonce'));
        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {
                $idcoloc=$request->get('id');
                $Colocation=$em->getRepository("UtilisateurBundle:Colocation")
                    ->find($idcoloc);
                $favoris=$em->getRepository("UtilisateurBundle:FavorisColocation")->findOneBy(
                    array(
                        'idColocation'=>$Colocation,
                        'idUser'=>$this->getUser()
                    )
                );


                $em->remove($favoris);
                $em->flush();
            }
        }
        return $this->render("ColocationBundle:Colocation:affichDemande.html.twig",
            array(
                'colocations'=>$Colocations
            ));

    }
    public function mesfavorisAction(Request $request){

        //créer une instance de notre entity  manager
        $em=$this->getDoctrine()->getManager();
        $listfav=$em->getRepository("UtilisateurBundle:FavorisColocation")->findBy(
            array(
                'idUser'=>$this->getUser()
            )
        );

        $Colocation=$em->getRepository("ColocationBundle:Colocation")->findBy(array(

            'typeColocation'=>'Annonce'));
        if ($request->isMethod("POST")) {
            if ($request->isXmlHttpRequest()) {
                $serializer = new Serializer(
                    array(
                        new ObjectNormalizer()
                    )
                );
            }
        }
        return $this->render("ColocationBundle:Colocation:mesfavoris.html.twig",
            array(
                'colocations'=>$Colocation,
                'listfav'=>$listfav
            ));

    }

    public function callAction(Request $request)
    {

        //returns an instance of Vresh\TwilioBundle\Service\TwilioWrapper
//        $twilio = $this->get('twilio.api');
//        $us=$this->getUser();
//        $id=$request->get("id");
//        $em=$this->getDoctrine()->getManager();
//        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
//
        $sms_sender = $this->get('sms.sender');
        $sms_sender->send('+21624273476', 'It\'s the answer.');

        return $this->redirectToRoute("affich_colocation");
    }
}