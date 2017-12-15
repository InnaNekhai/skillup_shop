<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 12.12.2017
 * Time: 6:32
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CategoryController extends Controller
{
    /**
     * @param $slug
     * @Route("/category/{slug}/{page}", name="category_show", requirements={"page"="\d+"})
     */
    public function show($slug, $page=1, SessionInterface $session, Request $request)
    {
        $session->set('lastVisitedCategory', $slug);
        $param = $request->query->get('param');

        return $this->render('Category\show.html.twig',
        ['slug'=>$slug, 'page'=>$page, 'param'=> $param,]
        );
    }

    /**
     * @Route("message", name="category_message")
     */
    public function mes(SessionInterface $session)
    {
        $this->addFlash('notice', 'Товар успешно добавлен');

        return $this->redirectToRoute('category_show', ['slug'=>$session->get('lastVisitedCategory')]);
    }

    /**
     * @Route("download", name="category_download")
     */
    public function fileDownload()
    {
        $response = new Response();
        $response->setContent('Test content');

        return $response;
    }
}