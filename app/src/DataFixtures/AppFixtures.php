<?php

namespace App\DataFixtures;

use App\Entity\ContactMessage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
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
