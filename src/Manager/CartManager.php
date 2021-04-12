<?php


namespace App\Manager;


use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class CartManager
{
    /**
     * @var CartSessionStorage
     */
    private $cartSessionStorage;

    /**
     * @var OrderFactory
     */
    private $cartFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var Security
     */
    private Security $security;


    /**
     * CartManager constructor.
     *
     * @param CartSessionStorage $cartStorage
     * @param OrderFactory $orderFactory
     * @param EntityManagerInterface $entityManager
     * @param Security $security
     */
    public function __construct(
        CartSessionStorage $cartStorage,
        OrderFactory $orderFactory,
        EntityManagerInterface $entityManager,
        Security $security

    ) {
        $this->cartSessionStorage = $cartStorage;
        $this->cartFactory = $orderFactory;
        $this->entityManager = $entityManager;
        $this->security = $security;

    }

    /**
     * Gets the current cart.
     *
     * @return Order
     */
    public function getCurrentCart(): Order
    {
        $user = $this->security->getUser();


        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create($user);
        }

        return $cart;
    }

    /**
     * Persists the cart in database and session.
     *
     * @param Order $cart
     */
    public function save(Order $cart): void
    {

        // Persist in session
        $this->cartSessionStorage->setCart($cart);

        // Persist in database
        $this->entityManager->persist($cart);
        $this->entityManager->flush();

    }
}