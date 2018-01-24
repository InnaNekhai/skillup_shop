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
use App\Form\OrderType;
use App\Service\Orders;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class OrderController extends Controller
{

    /**
     * @Route("cart", name="order_cart")
     */
    public function showCart(Orders $orders)
    {
        return $this->render('order/cart.html.twig', ['order' => $orders->getCurrentOrder()]);
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


    /**
     * @Route("order/complete", name="order_complete")
     */
    public function completeOrder(Orders $orders, Request $request)
    {
        $order = $orders->getCurrentOrder();
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

        }

        return $this->render('order/completeForm.html.twig', [
            'order' => $order,
            'form' => $form->createView(),
        ]);
    }

}