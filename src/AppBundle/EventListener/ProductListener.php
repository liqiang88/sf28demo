<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/25
 * Time: 14:34
 */

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Event\FilterProductEvent;

class ProductListener
{
    public function onFooAction(Event $event)
    {
        //do something
//        echo 'onFoo';
        echo '<br />';
        echo 'This is ProductListener';
        echo '<br />';
        $event->stopPropagation();

    }


    public function onHooAction(Event $event)
    {
        //do something
//        echo 'onFoo';
        echo '<br />';
        echo 'This is ProductListener Hoo';
        echo '<br />';

    }


}