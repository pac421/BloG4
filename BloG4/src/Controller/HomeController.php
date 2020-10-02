<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class HomeController extends AbstractController
{
    private $user;

    public function __construct(User $user, EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
        $this->$user = $user;
        
    }
   
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {
        return $this->render('home/home.html.twig');
    }



    /**
     * @Route("/profil/{id}", name="profil")
     */
    public function profil()
    {  
                return $this->render('home/profil.html.twig');
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
