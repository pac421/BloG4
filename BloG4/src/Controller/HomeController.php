<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use App\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
   
    /**
     * @Route("/home", name="home")
     */
    public function home(EntityManagerInterface $entityManager)
    {
		$data_home = []; // This table will contain all the data required by the home page
		
		$data_home['user'] = $entityManager->getRepository(User::class)->getUserDataById($this->getUser());
		$data_home['lst_categories'] = $entityManager->getRepository(Category::class)->getAllCategories();
		$data_home['lst_articles'] = $entityManager->getRepository(Article::class)->getAllArticles();
		
		for($i = 0; $i < count($data_home['lst_articles']); $i++){
			
			$article_id = $data_home['lst_articles'][$i]['id'];
			$data_home['lst_articles'][$i]['lst_comments'] = $entityManager->getRepository(Comment::class)->getCommentsByArticleId($article_id);
		}
		
        return $this->render('home/home.html.twig', ['data_home' => $data_home]);
    }

    /**
     * @Route("/profil/{id}", name="profil")
     */
    public function profil(EntityManagerInterface $entityManager)
    {
        if($user =! null)
        {
            $user = $entityManager->getRepository(User::class)->findAll();
        
                return $this->render('home/profil.html.twig', [
                    'user' => $user
                ]);
        }
    }

    /**
     * @Route("/newFiche", name="newFiche")
     */
    public function newFiche()
    {
        return $this->render('home/newFiche.html.twig');
    }

    /**
     * @Route("/postFiche/{id}", name="postFiche")
     */
    public function postFiche(Request $request, EntityManagerInterface $entityManager, User $user)
    {
        
        $title = $request->get('title'); 
        $text = $request->get('text'); 
        $images = $request->get('images');
        if(isset($title) && isset($text) && isset($name)){

            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                $image->move(
                    $this->getParameter('/public/pictures/article'),
                    $fichier
                );


            }

            $article = new Article();
                $article->setTitle($title);
                $article->setContent($text);
                $article->setPicture($images);
                $article->setCreatedOn($user->getId());
                $article->setCreatedAt($article->getCreatedAt());
                $article->setLstCategories(['Php']);
                
                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($article);
                $entityManager->flush();

                return $this->render('home/home.html.twig');
        }

        return $this->render('home/newFiche.html.twig');
    }
}
