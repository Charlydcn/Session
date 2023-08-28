<?php

namespace App\Repository;

use App\Entity\Session;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Session>
 *
 * @method Session|null find($id, $lockMode = null, $lockVersion = null)
 * @method Session|null findOneBy(array $criteria, array $orderBy = null)
 * @method Session[]    findAll()
 * @method Session[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SessionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Session::class);
    }

    public function getStagiairesNonInscrits($id)
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $qb = $sub;
        // sélectionner tous les stagiaires d'une session dont l'id est passé en paramètre
        $qb->select('s')
            ->from('App\Entity\Stagiaire', 's')
            ->leftJoin('s.sessions', 'se')
            ->where('se.id = :id');
        
        $sub = $em->createQueryBuilder();
        // sélectionner tous les stagiaires qui ne SONT PAS (NOT IN) dans le résultat précédent
        // on obtient donc les stagiaires non inscrits pour une session définie
        $sub->select('st')
            ->from('App\Entity\Stagiaire', 'st')
            ->where($sub->expr()->notIn('st.id', $qb->getDQL()))
            // requête paramétrée
            ->setParameter('id', $id)
            // trier la liste des stagiaires sur le nom de famille
            ->orderBy('st.nom');
        
        // renvoyer le résultat
        $query = $sub->getQuery();
        return $query->getResult();
    }

    // RECUPERER TOUT LES MODULES D'UNE SESSION
    // SELECT module.intitule AS "Module"
    // FROM programme
    // INNER JOIN module ON programme.module_id = module.id
    // WHERE programme.session_id = 5

    // A PARTIR DE L'AUTRE REQUETE, RECUPERER TOUT LES MODULES
    // QUI NE SONT PAS CEUX DEJA PRESENTS DANS LA SESSION


    public function getModulesNonUtilisés($id)
    {
        $em = $this->getEntityManager();
        $sub = $em->createQueryBuilder();

        $qb = $sub;
        // sélectionner tout les modules d'une session dont l'id est passé en paramètre
        $qb->select('m.id')
            ->from('App\Entity\Programme', 'p')
            ->leftJoin('p.module', 'm')
            ->where('p.session = :id');

        $sub = $em->createQueryBuilder();

        // sélectionner tout les modules qui ne sont pas ceux présent dans la dernière requête
        $sub->select('mo')
            ->from('App\Entity\Module', 'mo')
            ->where($sub->expr()->notIn('mo.id', $qb->getDQL()))
            // requête paramétrée
            ->setParameter('id', $id)
            // requête trié par intitulé de module
            ->orderBy('mo.intitule');

        // renvoyer le résultat
        $query = $sub->getQuery();
        return $query->getResult();
    }



//    /**
//     * @return Session[] Returns an array of Session objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Session
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
