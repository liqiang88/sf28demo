<?php
/**
 * 事件监听
 *
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/20
 * Time: 11:17
 */

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    /**
     * on+“驼峰事件名”
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        // 你可以从接收到的事件中，取得异常对象
        $exception = $event->getException();
        $message = sprintf(
            'My Error says: %s with code: %s',
            $exception->getMessage(),
            $exception->getCode()
        );

        // Customize your response object to display the exception details
        // 自定义响应对象，来显示异常的细节
        $response = new Response();
        $response->setContent($message);

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        // HttpExceptionInterface是一个特殊类型的异常，持有状态码和头信息的细节
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }


        // Send the modified response object to the event
        // 发送修改后的响应对象到事件中
        $event->setResponse($response);
    }
}
