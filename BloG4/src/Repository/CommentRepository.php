<?php

namespace App\Repository;

use App\Entity\Comment;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comment::class);
    }
    
    public function getCommentsByArticleId($article_id): array
    {           
		$entityManager = $this->getEntityManager();
		
        $result = $entityManager->createQuery(
            '
            SELECT C.id, IDENTITY(C.created_on), C.created_at, C.content, IDENTITY(C.fiche), U.firstname, U.lastName
            FROM App\Entity\Comment C, App\Entity\User U
            WHERE C.created_on = U.id AND C.deleted_at IS NULL AND C.fiche = :_article_id
            '
        )->setParameter('_article_id', $article_id)->getArrayResult();
        
        for($i = 0; $i < count($result); $i++){
			$firstname = $result[$i]['firstname'];
			$lastname = $result[$i]['lastName'];
			$result[$i]['name'] = $entityManager->getRepository(User::class)->formatUserName($firstname, $lastname);
		}
        
        return $result;
    }

    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Comment
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
