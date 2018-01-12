<?php
/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 12.01.2018
 * Time: 21:08
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @ORM\Table(name="order_items")
 */
class OrderItem
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Order|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inversedBy="items")
     * @ORM\JoinColumn(name="order_id", nullable=true, onDelete="CASCADE")
     */
    private $order;

    /**
     * @var Product|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Product")
     * @ORM\JoinColumn(name="product_id", nullable=true, onDelete="CASCADE")
     */
    private $product;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $count;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $amount;

    /**
     * OrderItem constructor.
     */
    public function __construct()
    {

    }


}