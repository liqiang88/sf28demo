<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/25
 * Time: 14:23
 */

namespace AppBundle\Event;


use Symfony\Component\EventDispatcher\Event;

class FilterOrderEvent extends Event
{

    public function __construct(Order $order)
    {
    }
}