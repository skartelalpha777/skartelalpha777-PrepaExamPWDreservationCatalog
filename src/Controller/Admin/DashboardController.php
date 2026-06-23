<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // return $this->redirectToRoute('admin_user_index');

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkTo(UserCrudController::class, 'Utilisateurs', 'fa fa-user');
        yield MenuItem::linkTo(ShowCrudController::class, 'Spectacles', 'fa fa-list');
        yield MenuItem::linkTo(LocalityCrudController::class, 'Localités', 'fa fa-location-arrow');
        yield MenuItem::linkTo(LocationCrudController::class, 'Lieux', 'fa fa-map-marker');
        yield MenuItem::linkTo(ArtistCrudController::class, 'Artists', 'fa fa-users');
        yield MenuItem::linkTo(PriceCrudController::class, 'Prix', 'fa fa-eur');
        yield MenuItem::linkTo(RepresentationCrudController::class, 'Répresentations', 'fa fa-calendar');
        yield MenuItem::linkTo(ReservationCrudController::class, 'Réservations', 'fa fa-ticket');
        yield MenuItem::linkTo(ReviewCrudController::class, 'Avis', 'fa fa-commenting-o');
        yield MenuItem::linkToRoute(
            'Retour au site',
            'fa fa-home',
            'app_show_index'
        );
    }
}
