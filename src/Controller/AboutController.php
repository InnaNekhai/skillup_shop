<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.12.2017
 * Time: 9:34
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AboutController extends Controller
{
    /**
     * @Route("/about")
     *
     * @return Response
     */

    public function about(SessionInterface $session)
    {
        $url = $this->generateUrl('category_show', [
            'slug'=> 'notebooks',
            'param'=>'getParam',
            ], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->render('about.html.twig', [
            'notebooksUrl'=>$url,
            'lastCategory' => $session->get('lastVisitedCategory')
            ]
            );
    }

    /**
     * @Route("/to-about")
     */
    public function redirectToShow()
    {
        return $this->redirectToRoute('about_show');
    }

}