<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 03.01.2018
 * Time: 8:05
 */

namespace App\Menu;

use App\Service\Catalogue;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @var Catalogue
     */
    private $catalogueService;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Catalogue $catalogue)
    {
        $this->factory = $factory;
        $this->catalogueService = $catalogue;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Главная', array('route' => 'homepage'));
        $catalogueMenu = $menu->addChild('Каталог', array('route' => 'list_of_categories'));
        $catalogueMenu->setExtra('dropdown', true);

        foreach ($this->catalogueService->getTopCategories() as $category){
            $catalogueMenu->addChild($category->getName(), [
                'route'=>'category_show',
                'routeParameters'=>['slug'=> $category->getSlug()],
            ]);
        }

        $menu->addChild('О нас', array('route' => 'about_show'));
        $menu->addChild('Контакты', array('route' => 'contacts'));
        // ... add more children

        return $menu;
    }
}