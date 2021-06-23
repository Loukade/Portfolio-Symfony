<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new Member();
        $user->setPseudo('loukade');
        $user->setPassword($this->encoder->encodePassword($user, 'lilylulu'));
        $user->setEmail('lucas.jenvrain@gmail.com');
        $user->setIsAdmin('1');
        $manager->persist($user);

        $manager->flush();
    }
}
