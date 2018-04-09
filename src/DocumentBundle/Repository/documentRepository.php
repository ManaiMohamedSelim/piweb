<?php
/**
 * Created by PhpStorm.
 * User: Manai
 * Date: 08/04/2018
 * Time: 22:50
 */

namespace DocumentBundle\Repository;

use Doctrine\ORM\EntityRepository;

class documentRepository extends EntityRepository
{


    public function findDoc($niveau){
        $query=$this->getEntityManager()
            ->createQuery("SELECT d FROM UtilisateurBundle:Document d
                          WHERE d.niveau LIKE :niveau")
            ->setParameter("niveau","%".$niveau."%");
        return $query->getResult();
    }
}