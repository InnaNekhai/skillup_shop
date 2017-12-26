<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 12.12.2017
 * Time: 6:32
 */

namespace App\Controller;


use App\Entity\Category;
use App\Service\Catalogue;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CategoryController extends Controller
{
    /**
     * @var Catalogue
     */
    private $catalogue;

    public function __construct(Catalogue $catalogue)
    {
        $this->catalogue = $catalogue;
    }


    /**
     * @Route("/category/{slug}/{page}",
     *     name="category_show",
     *     requirements={"page": "\d+"})
     *
     * @ParamConverter("slug", options={"mapping": {"slug": "slug"}})
     *
     * @param Category $category
     * @param $page
     * @param $session
     *
     * @return Response
     */
    public function show(Category $category, $page = 1, SessionInterface $session)
    {
        $session->set('lastVisitedCategory', $category->getId());
        $session->set('lastCategory', $category->getSlug());

        return $this->render('Category/show.html.twig', ['category' => $category, 'page' => $page]);
    }

    /**
     * @return Response
     * @Route("/categories", name="list_of_categories")
     */
    public function listCategories()
    {
        $categories = $this->catalogue->getCategories();

        if (!$categories){
            throw $this->createNotFoundException('Категории не найдены');
        }

        return $this->render('Category/list.html.twig', ['categories' => $categories]);
    }


    /**
     * @Route("message", name="category_message")
     *
     *
     */
    public function message(SessionInterface $session)
    {
        $this->addFlash('notice', 'Товар добавлен в корзину');


        return $this->redirectToRoute('category_show', ['slug'=>$session->get('lastCategory')]);
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