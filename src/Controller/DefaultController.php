<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 26.12.2017
 * Time: 8:03
 */

namespace App\Controller;


use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        $repo = $this->getDoctrine()->getRepository(Product::class);
        $products = $repo->findBy(['isTop'=>true]);

        return $this->render('Default/homepage.html.twig', ['products'=>$products]);
    }
}