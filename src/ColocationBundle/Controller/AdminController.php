<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 08-04-18
 * Time: 22:53
 */

namespace ColocationBundle\Controller;


use ColocationBundle\Entity\Colocation;
use ColocationBundle\Form\ColocationType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UtilisateurBundle\Entity\FavorisColocation;

class AdminController extends Controller
{
    public function affichecolocationAction(Request $request)
    {


        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository(Colocation::class)->findAll();


        return $this->render('ColocationBundle:Admin:colocation.html.twig', array(

            'colocation'=>$Colocation,


        ));
    }

    public function deletecolocationAction(Request $request){
        $id=$request->get("id");
        $em=$this->getDoctrine()->getManager();
        $Colocation=$em->getRepository("ColocationBundle:Colocation")->find($id);
        $Favoris=$em->getRepository(FavorisColocation::class)->findBy(array("idColocation"=>$id));
        while ($Favoris !=null){
            foreach ($Favoris as $favori) {
                $em->remove($favori);
                $em->flush();
            }

        }
        $em->remove($Colocation);
        $em->flush();
        return $this->redirectToRoute("admin_afficher_colocation");


    }
    public function updatecolocationAction(Request $request){
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
            return $this->redirectToRoute("admin_afficher_colocation");
        }   return $this->render("ColocationBundle:Admin:updatecoloc.html.twig",
            array(
                "Form" =>$form->createView()
            ));
    }

    public function updatedemandeAction(Request $request){
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
            return $this->redirectToRoute("admin_afficher_colocation");
        }

        return $this->render("ColocationBundle:Admin:updatedemande.html.twig",
            array(
                "Form" =>$form->createView()
            ));
    }

}