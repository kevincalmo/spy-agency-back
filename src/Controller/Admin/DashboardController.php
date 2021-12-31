<?php

namespace App\Controller\Admin;

use App\Entity\Administrator;
use App\Entity\Agents;
use App\Entity\Contacts;
use App\Entity\Missions;
use App\Entity\Specialitys;
use App\Entity\Stashs;
use App\Entity\Targets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('KGB Gestion');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Agents', 'fas fa-list', Agents::class);
        yield MenuItem::linkToCrud('Administration', 'fas fa-list', Administrator::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-list', Contacts::class);
        yield MenuItem::linkToCrud('Missions', 'fas fa-list',Missions::class);
        yield MenuItem::linkToCrud('Specialitys', 'fas fa-list',Specialitys::class);
        yield MenuItem::linkToCrud('Stashs', 'fas fa-list',Stashs::class);
        yield MenuItem::linkToCrud('Targets', 'fas fa-list',Targets::class);
    }
}
