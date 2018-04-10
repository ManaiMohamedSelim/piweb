<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 09/04/2018
 * Time: 17:51
 */

namespace EventBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu', TextareaType::class, ['label' => false,'attr' => ['placeholder' => 'Ajouter votre commentaire']])
            ->add('valider',SubmitType::class, ['label' => 'Commenter', 'attr' => ['class' => 'btn btn-danger comm']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'UtilisateurBundle\Entity\Commentaire']);
    }

    public function getBlockPrefix()
    {
        return 'eventbundle_commentaire';
    }

}