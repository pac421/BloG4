<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class HomeController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        
    }

    /**
     * @Route("/subscribe", name="subscribe")
     */
    public function subscribe(EntityManagerInterface $entityManager,Request $request)
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $firstName = $request->request->get('firstname');
        $lastName = $request->request->get('lastname');
        $bornDate = $request->request->get('bornDate');

        if (isset($email) & isset($password) & isset($firstName) & isset($lastName) & isset($bornDate) ){
            $user= new User;
            $user->setEmail($email);
            $user->setFirstname($firstName);
            $user->setLastName($lastName);
            $user->setPassword($this->passwordEncoder->encodePassword
            ($user,
            $password));
            $user->setBornDate(new \DateTime($bornDate));
            $user->setRoles($user->getRoles());

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            
            return $this->render('home/home.html.twig');
        }
         
        return $this->render('home/subscribe.html.twig');
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
