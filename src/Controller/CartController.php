<?php

namespace App\Controller;

use App\Form\CartType;
use App\Manager\CartManager;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    /**
     * @Route ("/cart", name="app_cart")
     */
    public function cart(CartManager $cartManager, Request $request): Response
    {
        $cart = $cartManager->getCurrentCart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setUpdatedAt(new \DateTime());
            $cartManager->save($cart);

            return $this->redirectToRoute('app_cart');
        }





        return $this->render('cart/cart.html.twig', [
            'cart' => $cart,
            'form' => $form->createView()
        ]);
    }
}
