<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\Question;
use App\Entity\Answer;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\FAQ;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(QuestionCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="img/logo_lo.png" style="width:70px; height:70px"> Law Overflow');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linktoDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('All'),
            MenuItem::linkToCrud('User', 'fa fa-user', User::class)->setPermission("ROLE_ADMIN"),
            MenuItem::linkToCrud('Questions', 'fa fa-question-circle', Question::class),
            MenuItem::linkToCrud('Answers', 'fa fa-comments-o', Answer::class),
            MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class),
            MenuItem::linkToCrud('News', 'fa fa-newspaper-o', News::class),
            MenuItem::linkToCrud('FAQ', 'fa fa-question', FAQ::class),
        ];
    }
}
