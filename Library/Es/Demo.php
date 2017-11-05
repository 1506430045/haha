<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/9/18
 * Time: 下午4:37
 */
use \ElasticSearch\Client;

class Demo
{
    public function __construct()
    {
    }

    public function test()
    {
        $es = Client::connection('');

        $id = 1;
        $es->index(['title' => 'my title'], $id);
        $es->get($id);
        $es->search('title:cool');

        $es->map(array(
            'title' => array(
                'type' => 'string',
                'index' => 'analyzed'
            )
        ));

        $results = $esw
            ->setIndex(array("one", "two"))
            ->setType(array("mytype", "other-type"))
            ->search('title:cool');

        $es->search(array(
            'query' => array(
                'term' => array('title' => 'cool')
            )
        ));

    }
}