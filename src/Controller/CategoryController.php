<?php
/**
 * Created by PhpStorm.
 * User: SkillUP student
 * Date: 05.12.2017
 * Time: 19:33
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}/{page}", name="category_show",
     *      requirements={"page": "\d+"})
     *
     * @param $slug
     * @param  $page
     * @param  $session
     *
     * @return Response
     */
    public function show($slug, $page=1, SessionInterface $session)
    {
        $session->set('lastVisitedCategory', $slug);
        return $this->render(
            'category/show.html.twig', ['slug'=>$slug, 'page'=> $page]);
    }

    /**
     * @Route("category/message", name="category_message")
     */
    public function message(SessionInterface $session)
    {
        $this->addFlash('notice', 'Your message');
        $lastCategory = $session->get('lastVisitedCategory');
        return $this->redirectToRoute('category_show', ['slug'=>$lastCategory]);
    }
}