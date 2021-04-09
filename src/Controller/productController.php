<?php


namespace App\Controller;


use App\Entity\Product;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class productController extends AbstractController
{

    /**
     * @Route("/product/{slug}", name="app_product_show")
     */
    public function show(Product $product, Request $request, CartManager $cartManager): Response {

        $form = $this->createForm(AddToCartType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdatedAt(new \DateTime());

            $cartManager->save($cart);

            return $this->redirectToRoute('app_product_show', ['slug' => $product->getSlug()]);
        }

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

}