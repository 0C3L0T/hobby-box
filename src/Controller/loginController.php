<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class loginController extends AbstractController
{

    /**
     * @Route("/login", name="app_loginpage")
     */
    public function login(Environment $twigEnvironment) {

        return $this->render('login.html.twig');

    }



}