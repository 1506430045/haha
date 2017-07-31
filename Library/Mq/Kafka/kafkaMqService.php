<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/7/31
 * Time: 下午2:07
 */
namespace Library\Mq\Kafka;

use Kafka\Consumer;
use Kafka\Produce;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class kafkaMqService
{
    private $logger;
    private $maxBytes = 102400;

    private $hostList = "kafka0:2181";

    private $consumerList = [];

    private $group;
    private $topic;

    const TIME_OUT = 2;

    public function __construct($group, $topic)
    {
        $this->group = $group;
        $this->topic = $topic;

        $this->logger = new Logger('my_logger');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/my_app.log', Logger::INFO));

    }

    /**
     * 设置消费者
     *
     * @param Consumer $consumer
     */
    public function setConsumer(Consumer $consumer)
    {
        if (!empty($consumer) && isset($consumer->tableName)) {
            $this->consumerList[$consumer->tableName] = $consumer;
        }
    }

    /**
     * 获取消费者对象
     *
     * @return Consumer|null
     */
    private function _getConsumer()
    {
        $consumer = null;
        try {
            $consumer = Consumer::getInstance($this->hostList, self::TIME_OUT);
            $consumer->setGroup($this->group);
            $consumer->setFromOffset(true);
            $consumer->setTopic($this->topic);
            $consumer->setMaxBytes($this->maxBytes);
        } catch (\Exception $e) {
            exit('获取消费者对象异常');
        }
        return $consumer;
    }

    /**
     * 获取生产者者对象
     *
     * @return Produce
     */
    private function _getProducer()
    {
        $producer = null;
        try {
            $producer = Produce::getInstance($this->hostList, self::TIME_OUT);
            $producer->setRequireAck(-1);
        } catch (\Exception $e) {
            exit('获取生产者者对象异常');
        }
        return $producer;
    }

    /**
     * 消费
     */
    public function consume()
    {
        $consumer = $this->_getConsumer();
        while (true) {
            $result = $consumer->fetch(); //读取消息
            foreach ($result as $topicName => $partition) { //结果处理
                foreach ($partition as $partId => $messageSet) {    //读取分区上消息
                    foreach ($messageSet as $message) {
                        var_dump(strval($message));
                    }
                }
                var_dump($partition->getMessageOffset());
            }
        }
    }

    /**
     * 发送消息
     *
     * @param array $messages
     * @return array|bool
     */
    public function push(array $messages)
    {
        $producer = $this->_getProducer();
        $producer->setMessages($this->topic, 0, $messages);
        return $producer->send();
    }
}