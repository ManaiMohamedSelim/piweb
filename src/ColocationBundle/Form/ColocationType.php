<?php

namespace ColocationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class ColocationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeColocation',HiddenType::class,array('empty_data' => 'Annonce'))
            ->add('adresse')
            ->add('prix')
            ->add('placeDispo')
            ->add('sexe')
            ->add('typeMaison',ChoiceType::class,array( 'choices' =>
                array( 'Appartement' => 'Appartement'
                , 'Maison' => 'Maison'
                ,'Studio' => 'Studio')))
            ->add('description')
            ->add('file')
            ;

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ColocationBundle\Entity\Colocation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'colocationbundle_colocation';
    }


}
