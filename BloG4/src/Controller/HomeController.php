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
            
            return $this->render('home/fils.html.twig');
        }
         
        return $this->render('security/login.html.twig');
    }


    /**
     * @Route("/fils", name="fils")
     */
    public function fils()
    {
        return $this->render('home/fils.html.twig');
    }


}
