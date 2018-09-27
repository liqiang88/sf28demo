<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

//添加product
$collection->add('app_product_create', new Route('/app/product/create', array(
    '_controller' => 'AppBundle:Default:create',
)));

return $collection;
