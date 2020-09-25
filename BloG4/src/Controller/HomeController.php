<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;




class HomeController extends AbstractController
{



   
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
    public function profil(EntityManagerInterface $entityManager, User $user)
    {

        if(isset($user))
        {

            $user = $entityManager->getRepository(User::class)->findAll();
        
                return $this->render('home/profil.html.twig', [
                    'user' => $user
                ]);
        }
    }


}
