<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
	
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }
    
    public function getAllArticles(): array
    {             
        $entityManager = $this->getEntityManager();
		
        $result = $entityManager->createQuery(
            '
            SELECT A.id, IDENTITY(A.created_on), A.created_at, A.title, A.picture, A.content, A.lst_categories, U.firstname, U.lastName 
            FROM App\Entity\Article A, App\Entity\User U
            WHERE A.created_on = U.id AND A.deleted_at IS NULL
            '
        )->getArrayResult();
        
        for($i = 0; $i < count($result); $i++){
			$firstname = $result[$i]['firstname'];
			$lastname  = $result[$i]['lastName'];
			$result[$i]['name'] = $entityManager->getRepository(User::class)->formatUserName($firstname, $lastname);
		}
        
        return $result;
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
