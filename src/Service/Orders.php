<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 18.01.2018
 * Time: 18:24
 */

namespace App\Service;


use App\Entity\Order;
use App\Entity\Product;
use App\Entity\OrderItem;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Orders
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * Orders constructor.
     * @param SessionInterface $session
     * @param EntityManagerInterface $em
     */
    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }


    public function getCurrentOrder(): Order
    {
        $id = $this->session->get('current_order_id');

        $order = $id ? $this->em->find(Order::class, $id) : null;

        if (!$order || $order->getStatus() != Order::STATUS_DRAFT){
            $order = new Order();
            $this->em->persist($order);
            $this->em->flush();
            $this->session->set('current_order_id', $order->getId());
        }

        return $order;
    }

    public function addProduct(Product $product, $count)
    {
        $order = $this->getCurrentOrder();
        $existingItem = null;

        foreach ($order->getItems() as $item){
            if ($item->getProduct()->getId() == $product->getId()){
                $existingItem = $item;
                break;
            }
        }

        if (!$existingItem){
            $existingItem = new OrderItem();
            $existingItem->setProduct($product);
            $order->addItem($existingItem);
            $this->em->persist($existingItem);
        }

        $existingItem->addCount($count);
        $this->em->flush();

    }

    public function removeItem(OrderItem $item)
    {
        $order = $this->getCurrentOrder();

        foreach ($order->getItems() as $orderItem){
            if ($orderItem == $item){
                $order->removeItem($orderItem);
                $this->em->persist($order);
                $this->em->persist($item);
                $this->em->flush();
            }
        }
    }


    public function makeOrder(Order $order)
    {
        $order->setStatus(Order::STATUS_ORDERED);
        $this->em->flush();


    }

}