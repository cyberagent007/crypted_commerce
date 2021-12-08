<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $users = [
        ['administrator', '12345678', ['ROLE_USER', 'ROLE_ADMIN']],
        ['client', '12345678', ['ROLE_USER']],
        ['worker', '12345678', ['ROLE_USER', 'ROLE_ADMIN']],
        ['operator', '12345678', ['ROLE_USER', 'ROLE_ADMIN']],
    ];

    private $encoder;


    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {

        foreach ($this->users as $userData) {
            $user = new User();

            $user->setUsername($userData[0]);
            $user->setPassword($this->encoder->encodePassword($user, $userData[1]));
            $user->setRoles($userData[2]);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
