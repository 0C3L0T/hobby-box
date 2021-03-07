<?php


namespace App\Controller;


use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class homePageController extends AbstractController
{

    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(Environment $twigEnvironment, ProductRepository $repository) {

        $products = $repository->findAll();

        return $this->render('homepage.html.twig', [
            'products' => $products,
        ]);
    }
}