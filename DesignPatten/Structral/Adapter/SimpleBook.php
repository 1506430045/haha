<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/13
 * Time: 上午11:38
 */
namespace DesignPatten\Structral\Adapter;

class SimpleBook
{
    private $author;
    private $title;

    public function __construct($author, $title)
    {
        $this->author = $author;
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getTitle()
    {
        return $this->title;
    }
}