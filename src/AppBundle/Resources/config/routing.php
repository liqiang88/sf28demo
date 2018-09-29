<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

//添加product
$collection->add('app_product_create', new Route('/app/product/create', array(
    '_controller' => 'AppBundle:Default:create',
)));


//$collection->add('app_product_get', new Route('/app/product/{id}', array(
//    '_controller' => 'AppBundle:Default:getOne',
//)));


$collection->add('app_product_all', new Route('/app/product/all', array(
    '_controller' => 'AppBundle:Default:getAll',
)));


//删除product
$collection->add('app_product_del', new Route('/app/product/del', array(
    '_controller' => 'AppBundle:Default:del',
)));

$collection->add('app_product_dis', new Route('/app/product/dispatch', array(
    '_controller' => 'AppBundle:Default:dispatch',
)));



$collection->add('app_product_container', new Route('/app/product/container', array(
    '_controller' => 'AppBundle:Default:container',
)));

return $collection;
