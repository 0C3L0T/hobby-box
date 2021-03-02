<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class homePageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment) {
        return $this->render('homepage.html.twig');
    }
}