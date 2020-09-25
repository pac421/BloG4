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
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();

        $user = new User();

                $user->setEmail("superadmin@gamil.fr");
                $user->setFirstname("Admin");
                $user->setLastName("Super");
                $user->setBornDate(new \DateTime("20/12/1996"));
                $user->setRoles(["ROLE_ADMIN"]);
                $user->setPassword($this->passwordEncoder->encodePassword(
                         $user,
                        'password'
                     ));
    }
}
