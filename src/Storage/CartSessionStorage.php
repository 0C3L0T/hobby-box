<?php


namespace App\Storage;

use App\Entity\Order;
use App\Entity\User;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Security;


class CartSessionStorage
{

    /**
     * The session storage.
     *
     * @var SessionInterface
     */
    private SessionInterface $session;

    /**
     * The cart repository
     *
     * @var OrderRepository
     */
    private OrderRepository $cartRepository;

    /**
     * @var string
     */
    const CART_KEY_NAME = 'cart_id';

    /**
     * @var Security
     */
    private Security $security;

    /**
     * CartSessionStorage constructor.
     *
     * @param SessionInterface $session
     * @param OrderRepository $cartRepository
     * @param Security $security
     */
    public function __construct(SessionInterface $session, OrderRepository $cartRepository, Security $security)
    {
        $this->session = $session;
        $this->cartRepository = $cartRepository;
        $this->security = $security;
    }

    /**
     * Gets the cart in session.
     *
     * @return Order|null
     */
    public function getCart(): ?Order
    {

        return $this->cartRepository->findOneBy([
            
            'status' => Order::STATUS_CART,
            'user_id' => $this->security->getUser()

        ]);
    }

    /**
     * Sets the cart in session.
     *
     * @param Order $cart
     */
    public function setCart(Order $cart): void
    {
        $this->session->set(
            self::CART_KEY_NAME,
            $cart->getId())
        ;
    }

    /**
     * Returns the cart id.
     *
     * @return int|null
     */
    private function getCartId(): ?int
    {
        return $this->session->get(self::CART_KEY_NAME);
    }


}