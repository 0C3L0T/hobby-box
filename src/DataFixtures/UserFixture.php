<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $manager->persist($user);

        $user->setEmail('gdejong@stmichaelcollege.nl');

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));

        $user->setRoles(['ROLE_ADMIN']);

        $manager->flush();
    }

}
