<?php

use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Parameter;
//use AppBundle\EventSubscriber\ExceptionSubscriber;
use AppBundle\EventListener\ExceptionListener;
/*

$container->setDefinition(
    'test.example',
    new Definition(
        'TestBundle\Example',
        array(
            new Reference('service_id'),
            "plain_value",
            new Parameter('parameter_name'),
        )
    )
);

*/

//
//$container
//    ->register('app.exception_listener', ExceptionListener::class)
//    ->addTag('kernel.event_listener', array('event' => 'kernel.exception'))
//;