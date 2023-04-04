<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 100; $i++) {
            $livre = new Book();
            $livre->setIsbn(1234567890)
                ->setTitle('DBZ Tome ' . $i)
                ->setDescription('lorem ipsum')
                ->setAuthor('Akira Toriyama')
                ->setPublication(new \DateTime('now'));

            // Ajouter l'info à la base de données
            $manager->persist($livre);
            
            // Nettoyer la file d'attente
            $manager->flush();
        }
    }
}
