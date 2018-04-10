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
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class ReservationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valider',SubmitType::class, ['label' => 'Reserver votre place!', 'attr' => ['class' => 'btn btn-danger']]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => 'UtilisateurBundle\Entity\Reservation']);
    }

    public function getBlockPrefix()
    {
        return 'eventbundle_reservation';
    }

}