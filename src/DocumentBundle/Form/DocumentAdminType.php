<?php

namespace DocumentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DocumentAdminType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder//->add('titre')
                //->add('description')
                //->add('path')
                //->add('niveau', ChoiceType::class, array(
                //    'choices'  => array(
                //        '3A' => '3A',
                 //       '3B' => '3B',
                 //       '4BI' => '4BI',
                //    ),
                //))
                //->add('matiere')
                ->add('etat', ChoiceType::class, array(
                    'choices'  => array(
                        'publique' => 'publique',
                        'en attente' => 'en attente',
                    ),
                ))
                //->add('idUser')
                //    ->add('file')
                ->add('Valider', SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UtilisateurBundle\Entity\Document'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'utilisateurbundle_document';
    }


}
