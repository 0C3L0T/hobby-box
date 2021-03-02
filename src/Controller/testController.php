<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController
{

    /**
     * @Route("/test/{id}"), name="test_page"
     */
    public function show($id){

        return $this->render('home/homepage.html.twig', ['box' => $id]);

    }
}