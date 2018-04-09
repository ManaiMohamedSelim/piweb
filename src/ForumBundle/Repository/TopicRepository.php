<?php
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 27/03/2018
 * Time: 01:58
 */

namespace ForumBundle\Repository;


use Doctrine\ORM\EntityRepository;

class TopicRepository extends EntityRepository
{
    public function findidtopic($sujet,$contenu,$imageName,$idt,$idu)
    {
        $q = $this->getEntityManager()
            ->createQuery("UPDATE UtilisateurBundle:Topic t SET t.sujet=:sujet,t.Contenu=:contenu,t.image_name=:imageName WHERE t.id=idt AND t.id_user=:idu")
            ->setParameter("sujet", $sujet)
            ->setParameter("contenu",$contenu)
            ->setParameter("imageName",$imageName)
            ->setParameter("idt",$idt)
            ->setParameter("idu",$idu);
        return $q->getResult();

    }


    public function findTopicAjax($suj){

        $query =$this->getEntityManager()
            ->createQuery("SELECT t FROM UtilisateurBundle:Topic t WHERE t.sujet LIKE :suj")
            ->setParameter("suj",'%'.$suj.'%');

        return $query->getResult();
    }



}