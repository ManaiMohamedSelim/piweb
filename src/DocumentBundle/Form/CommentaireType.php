<?php

namespace DocumentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder//->add('idCollocation')
            //->add('idCovoiturage')
            //->add('idEvenement')
            ->add('post')
            ->add('contenu')
            //->add('etatCommentaire')
            //->add('rating')
            ->add('idUser')
            ->add('idDocument');
            //->add('idTopic');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UtilisateurBundle\Entity\Commentaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'utilisateurbundle_commentaire';
    }


}
