<?php

namespace AppBundle\Controller;

use Doctrine\ORM\Query\ResultSetMapping;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\EventDispatcher\EventDispatcher;
use AppBundle\AppEvents;
use Symfony\Component\EventDispatcher\Event;
use AppBundle\EventListener\ProductListener;
use AppBundle\EventSubscriber\ProductSubscriber;
use AppBundle\Event\FilterProductEvent;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ));
    }

    /**
     * 添加product
     * @return Response
     */
    public function createAction()
    {
        $product = new Product();
        $product->setProductName('电脑11');
        $product->setPrice(8888.88);
        $product->setDescription('koko');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('ok');
    }

    /**
     * @param $id
     * @return Response
     */
    public function getOneAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        var_dump(Product::class);

        $product = $em->getRepository(Product::class)->find($id);

//        $product->setPrice(888);
//        $em->
        var_dump($product);
        return new Response('11');

    }

    public function getAllAction()
    {
        //方式一：queryBuilder方式查询
//        $repository = $this->getDoctrine()
//            ->getRepository(Product::class);
//
//// createQueryBuilder() automatically selects FROM AppBundle:Product
//// and aliases it to "p"
//        $query = $repository->createQueryBuilder('p')
//            ->where('p.price > :price')
//            ->setParameter('price', '19.99')
//            ->orderBy('p.price', 'ASC')
//            ->getQuery();
//
//        $products = $query->getResult();
//        var_dump($products);



        //方式二： DQL模式
//        $em = $this->getDoctrine()->getManager();
//
//        $rep = $em->getRepository();
//
//
//        $query = $em->createQuery(
//            'SELECT p
//    FROM AppBundle:Product p
//    WHERE p.price > :price
//    ORDER BY p.price ASC'
//        )->setParameter('price', 8888);
//
//        $products = $query->getResult();

        //方式三：SQL模式
        $em = $this->getDoctrine()->getEntityManager();

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult(Product::class,'p');
        $rsm->addFieldResult('p','id','id');
        $rsm->addFieldResult('p','name','productName');

        //$sql = "select id,name from  product limit ?,?";
        $sql = "select id,`name` from  product limit :start,:offset";

        $q = $em->createNativeQuery($sql,$rsm);
//        $q->setParameter(1,0);
//        $q->setParameter(2,5);
        $q->setParameter('start',0);
        $q->setParameter('offset',5);
        $products = $q->getArrayResult();



        var_dump($products);
        return new Response('11');
    }


    /**
     * 删除product
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delAction()
    {
        $entityManager = $this->getDoctrine()->getEntityManager();
        $product = $entityManager->getRepository(Product::class)->find(1);
        $entityManager->remove($product);
        $entityManager->flush();

        return new Response('del ok');
    }


    /**
     * 自定义事件
     * 事件派遣、事件监听和事件订阅
     * @return Response
     */
    public function dispatchAction()
    {
        //事件派遣器
        $dispatcher = new EventDispatcher();
        $productEvent = new FilterProductEvent(new Product());
        //回调函数方式加入事件监听
//        $dispatcher->addListener(AppEvents::NAME,function (Event $event){
//            echo 'this is callable event';
//        });
//        $dispatcher->dispatch(AppEvents::NAME);
//        return new Response('---callable事件监听');


        ///////////

        $productListener = new ProductListener();

        //监听多个方法
        $dispatcher->addListener(AppEvents::NAME,[$productListener,'onFooAction']);
        $dispatcher->addListener(AppEvents::NAME,[$productListener,'onHooAction']);
        $dispatcher->dispatch(AppEvents::NAME);

        ////////////////

        //事件订阅
//        $productSub = new ProductSubscriber();
//        $dispatcher->addSubscriber($productSub);
//        $dispatcher->dispatch(AppEvents::NAME,$productEvent);


        return new Response('ok');


    }

    /**
     * 容器
     */
    public function containerAction()
    {
        //获取容器
        $logger = $this->container->get('logger');
        $logger->info('-----------logger test--------');
//
        //注册服务
//        $msgGen = $this->container->get('app.message_generator');
//        $msg = $msgGen->getHappyMessage();
//
//        var_dump($msg);

        /**
         * @var $mysqliDb \AppBundle\Service\MysqliDb;
         */
        $mysqliDb = $this->container->get('db_mysqli');
        $one = $mysqliDb->getOne('product');
        var_dump($one);


        return new Response('ok');

    }




}
