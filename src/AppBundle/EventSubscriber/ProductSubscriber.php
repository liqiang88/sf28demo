<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/25
 * Time: 15:41
 */

namespace AppBundle\EventSubscriber;

use AppBundle\Event\FilterProductEvent;
use AppBundle\AppEvents;
use AppBundle\EventListener\ProductListener;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
//use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


class ProductSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            AppEvents::NAME => [
                ['onProductPre',100],
                ['onProductMid',0],
                ['onProductPost', -1],
            ],
//            AppEvents::NAME => 'onProductPre'
        ];
    }


    public function onProductPre(FilterProductEvent $event)
    {
        echo '<br />onProductPre';

    }

    public function onProductMid(FilterProductEvent $event)
    {
        echo '<br />onProductMid';
        $event->stopPropagation();

    }

    public function onProductPost(FilterProductEvent $event)
    {
        echo '<br />onProductPost';
    }

}