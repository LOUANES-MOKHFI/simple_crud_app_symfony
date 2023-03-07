<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(Security $security): Response
    {
        if ($security->isGranted('ROLE_ADMIN')) {
            // User is authenticated
            return $this->render('admin/index.html.twig');
        } else {
            return $this->redirectToRoute('app_login');
        }
        
    }
}
