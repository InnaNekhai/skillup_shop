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
use App\Entity\Product;
use App\Service\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


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

        $repo = $this->getDoctrine()->getRepository(Order::class);
        $order = $repo->find($order_id);


        return $this->render('order/cart.html.twig', ['orderItems'=>$orderItems, 'order'=>$order ]);
    }

    /**
     * @param Product $product
     * @param $count
     *
     * @Route("order/add-product/{id}/{count}", name="order_add_product",
     *           requirements={"id": "\d+", "count": "\d+(\.\d+)?"})
     */
    public function addProduct(Product $product, float $count, Orders $orders, Request $request)
    {
        $orders->addProduct($product, $count);

        return $this->redirect($request->headers->get('referer'));
    }

}