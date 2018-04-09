<?php
/**
 * Created by PhpStorm.
 * User: Aymen
 * Date: 27/03/2018
 * Time: 01:43
 */

namespace ForumBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CommentaireRepository extends EntityRepository
{

    public function diffDate($x){

        $query =$this->getEntityManager()
            ->createQuery("SELECT c FROM UtilisateurBundle:Commentaire c WHERE c.idTopic =:x ")
            ->setParameter("x",$x);
        return $query->getResult();
    }

   public function nbComment(){


       $query =$this->getEntityManager()
           ->createQuery("SELECT count(c.id) x FROM UtilisateurBundle:Commentaire c ");
       return $query->getSingleScalarResult();

   }
}