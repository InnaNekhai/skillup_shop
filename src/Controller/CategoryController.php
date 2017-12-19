<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 12.12.2017
 * Time: 6:32
 */

namespace App\Controller;


use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{slug}/{page}", name="category_show")
     *
     * @ParamConverter("slug",)
     * @param Category $category
     * @return Response
     */
    public function show(Category $category, $page=1)
    {

        return $this->render('Category/show.html.twig', ['category' => $category, 'page'=>$page]);
    }

    /**
     * @return Response
     * @Route("/categories", name="list_of_categories")
     */
    public function listCategories()
    {
        $repo = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repo->findAll();

        if (!$categories){
            throw $this->createNotFoundException('Категории не найдены');
        }

        return $this->render('list.html.twig', ['categories'=>$categories]);
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

    /**
     * @param EntityManagerInterface $em
     * @return Response
     * @Route("/createCategory")
     */
    public function createCategory(EntityManagerInterface $em)
    {
        $category = new Category();
        $category->setName('Climate');

        $em->persist($category);
        $em->flush();

        return new Response('Категория добавлена');
    }
}