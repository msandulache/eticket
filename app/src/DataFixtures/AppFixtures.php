<?php

namespace App\DataFixtures;

use App\Entity\ContactMessage;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
       private UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,'12345678')
        );

        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('john@test.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,'12345678')
    );

        $manager->persist($user2);

        // $product = new Product();
        // $manager->persist($product);

        $contactMessage = new ContactMessage();
        $contactMessage->setEmail('mariussandulache2015@gmail.com');
        $contactMessage->setSubject('Test');
        $contactMessage->setMessage('This is a test message');
        $manager->persist($contactMessage);

        $manager->flush();
    }
}
