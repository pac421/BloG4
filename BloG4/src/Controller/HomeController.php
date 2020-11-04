<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Images;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            $user = $entityManager->find(User::class, $this->getUser());
            $article = $entityManager->getRepository(Article::class)->findAll();

                return $this->render('home/profil.html.twig', [
                    'user' => $user,
                    'article'=> $article
                ]);
        }
    }

    /**
     * @Route("/newFiche", name="newFiche")
     */
    public function newFiche(EntityManagerInterface $entityManager)
    {

        $data_home = []; // This table will contain all the data required by the home page
        $data_home['lst_categories'] = $entityManager->getRepository(Category::class)->getAllCategories();
        
        
        return $this->render('home/newFiche.html.twig', ['data_home' => $data_home]);
    }

    /**
     * @Route("/postFiche/{id}", name="postFiche")
     */
    public function postFiche(Request $request, EntityManagerInterface $entityManager)
    {

        $user = $entityManager->find(User::class, $this->getUser());
        $title = $request->get('title'); 
        $text = $request->get('text');
        
        $categoryId= $request->get('categoryId');

        if(isset($user)){


        $article = new Article();
                $article->setTitle($title);
                $article->setContent($text);
                $article->setPicture("public/pictures/article/test.jpg");
                $article->setCreatedAt(new \DateTime('now'));
                $article->setLstCategories($categoryId);
                $article->setCreatedOn($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            
        }
        return $this->redirectToRoute('home');
        }

        /**
     * @Route("/editFiche/{id}", name="editFiche")
     */
    public function editFiche(Request $request, EntityManagerInterface $entityManager)
    {

        $user = $entityManager->find(User::class, $this->getUser());
        $title = $request->get('title'); 
        $text = $request->get('text'); 
        $categoryId[]= $request->get('categoryId');;

        $article = new Article();
                $article->setTitle($title);
                $article->setContent($text);
                $article->setPicture("public/pictures/article/test.jpg");
                $article->setCreatedAt(new \DateTime('now'));
                $article->setLstCategories($categoryId);
                $article->setCreatedOn($user);

                

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }



    /**
     * @Route("/post_commentaire/{id}", name="post_commentaire")
     */
    public function post_commentaire(Request $request, EntityManagerInterface $entityManager)
    {
        $user = $entityManager->find(User::class, $this->getUser());
        $article = $entityManager->getRepository(Article::class);
        $text = $request->get('text'); 


        $comment = new Comment();
                $comment->setContent($text);
                $comment->setCreatedAt(new \DateTime('now'));
                $comment->setCreatedOn($user);
                $comment->setFiche($article);
                
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        
    

}
