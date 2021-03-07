<?php


namespace App\Controller;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class productController extends AbstractController
{

    /**
     * @Route("/product/{slug}", name="app_product_show")
     */
    public function show(Product $product){

        return $this->render('product.html.twig', [
            'product' => $product,
        ]);
    }

}