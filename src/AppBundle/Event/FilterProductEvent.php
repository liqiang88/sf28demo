<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/25
 * Time: 14:23
 */

namespace AppBundle\Event;


use AppBundle\Entity\Product;
use Symfony\Component\EventDispatcher\Event;

class FilterProductEvent extends Event
{
    public $product = null;

    public function __construct(Product $product)
    {
        $this->product = $product;


    }

    public function getProduct()
    {
        return $this->product;
    }
}