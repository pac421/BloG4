<?php

namespace App\DataFixtures;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
        $this->passwordEncoder = $passwordEncoder;
     }


    public function load(ObjectManager $manager)
    {
 

        $user1 = new User();

                $user1->setEmail("nadjim13-13@hotmail.fr");
                $user1->setFirstname("Nadjim");
                $user1->setLastName("MOSTEFAOUI");
                $user1->setBornDate(new \DateTime("02/09/1997"));
                $user1->setRoles(["ROLE_ADMIN"]);
                $user1->setPassword($this->passwordEncoder->encodePassword(
                         $user1,
                        '1234'
                     ));

                $manager->persist($user1);


                $user2 = new User();

                $user2->setEmail("mathwal@hotmail.fr");
                $user2->setFirstname("Mathieu");
                $user2->setLastName("WALCZAK");
                $user2->setBornDate(new \DateTime("27/01/1999"));
                $user2->setRoles(["ROLE_ADMIN"]);
                $user2->setPassword($this->passwordEncoder->encodePassword(
                         $user2,
                        '1234'
                     ));

                $manager->persist($user2);




                $user3 = new User();

                $user3->setEmail("jasondangel@hotmail.fr");
                $user3->setFirstname("Jason");
                $user3->setLastName("DANGEL");
                $user3->setBornDate(new \DateTime("27/09/2000"));
                $user3->setRoles(["ROLE_ADMIN"]);
                $user3->setPassword($this->passwordEncoder->encodePassword(
                         $user3,
                        '1234'
                     ));

                $manager->persist($user3);





                $user4 = new User();

                $user4->setEmail("paul-alexandre.cieslik@hotmail.com");
                $user4->setFirstname("Paul-Alexandre");
                $user4->setLastName("CIESLIK");
                $user4->setBornDate(new \DateTime("21/01/2000"));
                $user4->setRoles(["ROLE_ADMIN"]);
                $user4->setPassword($this->passwordEncoder->encodePassword(
                         $user4,
                        '1234'
                     ));

                $manager->persist($user4);
                $manager->flush();

    }
    
}
