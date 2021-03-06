<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class SecurityController extends AbstractController
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        
    }
    
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
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

            return $this->redirectToRoute('app_login');
            
        }
    }    

    /**
     * @Route("/change_user_password/{id}", name="change_user_password")
     */
    public function change_user_password(EntityManagerInterface $entityManager, Request $request,$id,  UserPasswordEncoderInterface $passwordEncoder) 
    {
        $user = $entityManager->find(User::class, $this->getUser());
        $old_pwd = $request->get('old_pw'); 
        $new_pwd = $request->get('new_pw'); 
        $new_pwd_confirm = $request->get('cnew_pw');

       $checkPass = $passwordEncoder->isPasswordValid($user, $old_pwd);

       if($checkPass === true) 
       {
            $user->setpassword($this->passwordEncoder->encodePassword
            ($user,
            $new_pwd));


            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profil', array('id' => $id));
               
       }
       
    }
    
    /**
     * @Route("/change_name{id}", name="change_name")
     */
    public function change_name (EntityManagerInterface $entityManager, Request $request, $id)
    {
        $user = $entityManager->find(User::class, $this->getUser());
        $firstname = $request->get('firstname'); 
        $lastname = $request->get('lastname'); 


       if(isset($user)) 
       {
            $user->setFirstname($firstname);
            $user->setLastname($lastname);


            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('profil', array('id' => $id));
               
       }
    }
}
