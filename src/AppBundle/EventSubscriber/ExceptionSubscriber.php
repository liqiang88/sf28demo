<?php
/**
 * 事件订阅
 *
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/20
 * Time: 11:30
 */
namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        // 返回被订阅的事件，以及它们的方法和属性
        return array(
            KernelEvents::EXCEPTION => array(
                array('processException', 10),
                array('logException', 0),
                array('notifyException', -10),
            )
        );
    }

    public function processException(GetResponseForExceptionEvent $event)
    {
        // ...
        echo 11111;
    }

    public function logException(GetResponseForExceptionEvent $event)
    {
        // ...
        echo 2222;
    }

    public function notifyException(GetResponseForExceptionEvent $event)
    {
        // ...
        echo 3333;
    }
}