<?php

namespace UtilisateurBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CovoiturageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder ->add('depart',TextType::class,array(
            "attr"=>array(
                "pattern"=>'^[a-zA-Z]+$',
                "list"=>"Adresses"
            )
        ))
            ->add('destination',TextType::class,array(
                "attr"=>array(
                    "pattern"=>'^[a-zA-Z]+$',
                    "list"=>"Adresses"
                )
            ))
            ->add('date',DateType::class)
            ->add('type',ChoiceType::class,array(
                'choices'=>array(
                    "Offre"=>"0",
                    "Demande"=>"1"
                )
            ))
            ->add('Ajouter',SubmitType::class);
        $builder->get('date')->addModelTransformer(new CallbackTransformer(
            function ($value) {
                if(!$value) {
                    return new \DateTime('now');
                }
                return $value;
            },
            function ($value) {
                return $value;
            }
        ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UtilisateurBundle\Entity\Covoiturage'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'utilisateurbundle_covoiturage';
    }


}
