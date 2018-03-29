<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 12/03/2018
 * Time: 04:31
 */

namespace EventBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class EventForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
            ->add('type',ChoiceType::class,[
                'choices' =>['Associatif' => 'Associatif', 'Culturel' => 'Culturel', 'Autres' => 'Autres' ],
                'placeholder' => 'Veuillez choisir un type d\'événement'
                ]
            )
            ->add('typeReservation',ChoiceType::class, [
                'choices' => ['Gratuite' => 'Gratuite', 'Payante' => 'Payante'],
                'placeholder' => 'Veuillez choisir un type de réservation'
                ]
            )
            ->add('prix')
            ->add('dateEvent',DateTimeType::class)
            ->add('duree')
            ->add('lieu')
            ->add('nombre')
            ->add('description')
            ->add('afficheFile', VichFileType::class)
            ->add('valider',SubmitType::class, ['label' => 'Click']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'UtilisateurBundle\Entity\Evenement']);
    }

    public function getBlockPrefix()
    {
        return 'eventbundle_event';
    }
}