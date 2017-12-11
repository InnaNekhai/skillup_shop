<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.12.2017
 * Time: 9:34
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AboutController extends Controller
{
    /**
     * @Route("/about")
     *
     * @return Response
     */

    public function about(){
        $about = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis consectetur consequuntur deserunt dolorem dolorum, eius est iste iure iusto maiores modi neque nesciunt perspiciatis quae recusandae rerum sed totam voluptas.';
        return $this->render('about/about.html.twig', array(
            'about' => $about,
        ));
    }
}