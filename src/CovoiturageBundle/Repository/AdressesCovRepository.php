<?php
/**
 * Created by PhpStorm.
 * User: ASUS-PC
 * Date: 23/03/2018
 * Time: 22:54
 */

namespace CovoiturageBundle\Repository;


use Doctrine\ORM\EntityRepository;

class AdressesCovRepository extends EntityRepository
{
    public function FindByName($name){
        $query=$this->getEntityManager()->createQuery("Select a from UtilisateurBundle:AdressesCov a 
       where a.nom=:nom")->setParameter('nom',$name);
        return $query->getSingleResult();
    }
}