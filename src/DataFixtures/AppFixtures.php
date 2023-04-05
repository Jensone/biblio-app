<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Entity\Client;
use App\Entity\Rental;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 100; $i++) {
            // Ajoute des livres à la base de données
            $livre = new Book();
            $livre->setIsbn(1234567890)
                ->setTitle('DBZ Tome ' . $i)
                ->setDescription('lorem ipsum')
                ->setAuthor('Akira Toriyama')
                ->setPublication(new \DateTime('now'));
                
                $manager->persist($livre);
        }
        // Ajoute 30 clients à la base de données
        for($i = 0; $i < 30; $i++) {
            // Ajoute des clients à la base de données
            $client = new Client();
            $client->setFirstname('John '. $i)
                ->setLastname('Doe ' . $i)
                ->setEmail('johndoe@gmail.com')
                ->setPhone(89898796)
                ->setCity('Paris')
                ->setPostal(76767);
                
                // Ajouter l'info à la base de données
                $manager->persist($client);
        
            // Ajoute des emprunt à la base de données
            $emprunt = new Rental();
            $emprunt->setStart(new \DateTime('now'))
                ->setEnd(new \DateTime('now'))
                ->setIdClient($i)
                ->setIdBook($i);

                // Ajouter l'info à la base de données
                $manager->persist($emprunt);
        }
            
            // Nettoyer la file d'attente
            $manager->flush();
        
    }
}
