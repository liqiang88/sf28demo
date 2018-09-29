<?php
/**
 * Created by PhpStorm.
 * User: a1
 * Date: 18/9/20
 * Time: 09:50
 */

namespace AppBundle\Service;

use Psr\Log\LoggerInterface;

class MessageGenerator
{

    public $logger;
    /**
     * 依赖注入logger
     * MessageGenerator constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getHappyMessage()
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $this->logger->info(var_export($messages,true));

        $index = array_rand($messages);

        return $messages[$index];
    }


}