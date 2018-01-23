<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 26.12.2017
 * Time: 8:03
 */

namespace App\Controller;


use App\Entity\Product;
use App\Service\Catalogue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @var Catalogue
     */
    private $catalogue;

    public function __construct(Catalogue $catalogue)
    {
        $this->catalogue=$catalogue;
    }


    /**
     * @Route("/", name="homepage")
     */
    public function showTopProducts()
    {
        $topProducts = $this->catalogue->topProducts();
        return $this->render('Default/homepage.html.twig', ['topProducts'=>$topProducts]);
    }


}