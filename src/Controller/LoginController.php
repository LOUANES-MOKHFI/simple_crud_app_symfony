<?php

namespace App\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class LoginController extends AbstractController
{
    /**
     * @Route("/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Security $security): Response
    {
       
        if ($security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('dashboard');
        } else {
            $error = $authenticationUtils->getLastAuthenticationError();

            $lastUsername = $authenticationUtils->getLastUsername();
            return $this->render('login/index.html.twig', [
                'last_username' => $lastUsername,
                'error'         => $error,
            ]);
        }
        
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }
}
