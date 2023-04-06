<?php

namespace App\Controller\Admin;

// Chargement des Entités
use App\Entity\Book;
use App\Entity\Rental;
use App\Entity\Client;

// Chargement des Bundles et composants
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Dto\LocaleDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Locale;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(BookCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Biblio App')

            // ->renderContentMaximized()

            // ->renderSidebarMinimized()

            ->disableDarkMode()

            ->setLocales(['en', 'fr'])
            
            ->setLocales([
                'en' => '🇬🇧 English',
                'fr' => '🇫🇷 Français'
            ])
            
            ->setLocales([
                'en', // locale without custom options
                Locale::new('fr', 'french', 'far fa-language') // custom label and icon
            ])
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Livres', 'fas fa-list', Book::class);
        yield MenuItem::linkToCrud('Emprunts', 'fas fa-list', Rental::class);
        yield MenuItem::linkToCrud('Clients', 'fas fa-list', Client::class);
    }
}
