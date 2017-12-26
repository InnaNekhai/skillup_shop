<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 25.12.2017
 * Time: 8:46
 */

namespace App\Service;


use App\Entity\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class Catalogue
{

    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @return Category[]|\App\Entity\Product[]|array
     */
    public function getCategories()
    {
        $repo = $this->em->getRepository(Category::class);

        return $repo->findAll();

    }

}