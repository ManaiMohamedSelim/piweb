<?php
/**
 * Created by PhpStorm.
 * User: Karim
 * Date: 23-03-18
 * Time: 14:14
 */

namespace ColocationBundle\Entity;


use Doctrine\ORM\EntityRepository;

class ColocationRepository extends EntityRepository
{
    public function findcolocationAjax($prix,$user){
        $query=$this->getEntityManager()
            ->createQuery("SELECT c FROM  UtilisateurBundle:Colocation c JOIN c.idUser u
                                  WHERE c.prix LIKE :prix OR u.username LIKE :user 
                                  AND c.typeColocation='Annonce'")
            ->setParameter("prix",'%'.$prix.'%' )
            ->setParameter("user",'%'.$user.'%' );

        return $query->getResult();
    }
    public function finddemandeAjax($adresse,$user){
        $query=$this->getEntityManager()
            ->createQuery("SELECT c FROM  UtilisateurBundle:Colocation c JOIN c.idUser u
                                  WHERE c.adresse LIKE :adresse AND c.typeColocation='Demande' OR u.username LIKE :user AND c.typeColocation='Demande'
                                   ")
            ->setParameter("adresse",'%'.$adresse.'%' )
            ->setParameter("user",'%'.$user.'%' );

        return $query->getResult();
    }
}