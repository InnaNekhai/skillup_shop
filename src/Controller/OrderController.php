<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 14.01.2018
 * Time: 9:04
 */

namespace App\Controller;


use App\Entity\Order;
use App\Entity\OrderItem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OrderController extends Controller
{
    /**
     * @Route("cart/{order_id}", name="cart", requirements={"order_id": "\d+"})
     *
     * @param $order_id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showCart($order_id)
    {
        $repo = $this->getDoctrine()->getRepository(OrderItem::class);
        $orderItems = $repo->findBy(['order'=>$order_id]);

        return $this->render('order/cart.html.twig', ['orderItems'=>$orderItems]);
    }

}