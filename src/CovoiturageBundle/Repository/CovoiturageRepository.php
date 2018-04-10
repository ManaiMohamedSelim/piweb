<?php
/**
 * Created by PhpStorm.
 * User: ASUS-PC
 * Date: 23/03/2018
 * Time: 22:51
 */

namespace CovoiturageBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CovoiturageRepository extends EntityRepository
{
    public function findCustom($input,$date,$type,$SortBy){
        if($type==2){
            if($SortBy=="date"){
        $query=$this->getEntityManager()->createQuery("SELECT c from UtilisateurBundle:Covoiturage c JOIN  c.idU u 
            WHERE (c.depart LIKE :i OR c.destination LIKE :i OR u.username LIKE :i) AND (c.date<=:d AND  CURRENT_DATE ()<=c.date) ORDER BY c.date ")
            ->setParameters(array("i"=>"%".$input."%","d"=>$date));
            }else {
                $query=$this->getEntityManager()->createQuery("SELECT c from UtilisateurBundle:Covoiturage c JOIN  c.idU u 
            WHERE (c.depart LIKE :i OR c.destination LIKE :i OR u.username LIKE :i) AND (c.date<=:d AND  CURRENT_DATE ()<=c.date) ORDER BY u.username ")
                    ->setParameters(array("i"=>"%".$input."%","d"=>$date));
            }
        }else {
            if ($SortBy=="date") {
                $query=$this->getEntityManager()->createQuery("SELECT c from UtilisateurBundle:Covoiturage c JOIN  c.idU u 
            WHERE (c.depart LIKE :i OR c.destination LIKE :i OR u.username LIKE :i) AND (c.date<=:d AND  CURRENT_DATE ()<=c.date)
            AND c.type=:t ORDER BY c.date")
                    ->setParameters(array("i"=>"%".$input."%","d"=>$date,"t"=>$type));
            }else {
                $query=$this->getEntityManager()->createQuery("SELECT c from UtilisateurBundle:Covoiturage c JOIN  c.idU u 
            WHERE (c.depart LIKE :i OR c.destination LIKE :i OR u.username LIKE :i) AND (c.date<=:d AND  CURRENT_DATE ()<=c.date)
            AND c.type=:t ORDER BY u.username")
                    ->setParameters(array("i"=>"%".$input."%","d"=>$date,"t"=>$type));
            }

        }
        return $query->getResult();
    }
}