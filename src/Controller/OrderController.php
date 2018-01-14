<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 14.01.2018
 * Time: 9:04
 */

namespace App\Controller;


use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

class OrderController extends Controller
{

    /**
     * @Route("cart/{id}", name="cart", requirements={ "id" = "\d+" })
     */
    public function showCart(Order $order)
    {
        return $this->render('order/cart.html.twig', ['order'=>$order]);
    }

}