<?php
/**
 * Created by PhpStorm.
 * User: Mechlaoui
 * Date: 03/04/2018
 * Time: 18:10
 */

namespace UtilisateurBundle\Entity;


use Doctrine\ORM\EntityRepository;

class EvenementRepository extends EntityRepository
{
 public function findWe(){
     $em = $this->getEntityManager();
     $query = $em->createQuery("SELECT e FROM  UtilisateurBundle\Entity\Evenement e 
                        where WEEK(e.dateEvent) = WEEK(DATETIME)");
     return $query->getResult();

 }

 public function findWeek(){
     $em = $this->getEntityManager();
     $start_week = date("Y-m-d",strtotime('monday this week'));
     $end_week = date("Y-m-d",strtotime('sunday this week'));
     return $this->createQueryBuilder('t')
         ->where('t.dateEvent >= :start')
         ->andWhere('t.dateEvent <= :end')
         ->setParameter('start',$start_week)
         ->setParameter('end',$end_week)
         ->getQuery()
         ->getResult();
 }

    public function search($data, $page = 0, $max = NULL, $getResult = true)
    {
        $qb = $this->_em->createQueryBuilder();
        $query = isset($data['query']) && $data['query']?$data['query']:null;
        $user = isset($data['user']) && $data['user']?$data['user']:null;

        $qb
            ->select('e')
            ->from('UtilisateurBundle:Evenement', 'e')
        ;
        if($user){
            $qb->where('e.idOrganisateur = :user')
                ->setParameter('user', $user);
        }
        if ($query){
            $qb
                ->andWhere('e.nom like :query')
                ->orWhere('e.type like :query')
                ->orWhere('e.typeReservation like :query')
                ->orWhere('e.duree like :query')
                ->orWhere('e.dateEvent like :query')
                ->orWhere('e.lieu like :query')
                ->orWhere('e.nombre like :query')
                ->orWhere('e.prix like :query')
                ->setParameter('query', "%".$query."%")
            ;

        }
        $qb->orderBy('e.dateEvent', 'DESC');

        if ($max) {
            $preparedQuery = $qb->getQuery()
                ->setMaxResults($max)
                ->setFirstResult($page * $max)
            ;
        } else {
            $preparedQuery = $qb->getQuery();
        }

        return $getResult?$preparedQuery->getResult():$preparedQuery;
    }

    public function searchRes($data, $page = 0, $max = NULL, $getResult = true)
    {
        $qb = $this->_em->createQueryBuilder();
        $query = isset($data['query']) && $data['query']?$data['query']:null;
        $user = isset($data['user']) && $data['user']?$data['user']:null;

        $qb
            ->select('e')
            ->from('UtilisateurBundle:Evenement', 'e')
        ;

        if ($query){
            $qb
                ->andWhere('e.nom like :query')
                ->orWhere('e.type like :query')
                ->orWhere('e.typeReservation like :query')
                ->orWhere('e.duree like :query')
                ->orWhere('e.dateEvent like :query')
                ->orWhere('e.lieu like :query')
                ->orWhere('e.nombre like :query')
                ->orWhere('e.prix like :query')
                ->setParameter('query', "%".$query."%")
            ;

        }
        $qb->orderBy('e.dateEvent', 'DESC');

        if ($max) {
            $preparedQuery = $qb->getQuery()
                ->setMaxResults($max)
                ->setFirstResult($page * $max)
            ;
        } else {
            $preparedQuery = $qb->getQuery();
        }

        return $getResult?$preparedQuery->getResult():$preparedQuery;
    }


}