<?php


namespace App\Controller;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class productController extends AbstractController
{

    /**
     * @Route("/product/{slug}", name="app_product_show")
     */
    public function show(Product $product): Response{

        return $this->render('product/view.html.twig', [
            'product' => $product,
        ]);
    }

}