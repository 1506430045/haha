<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/13
 * Time: 上午11:40
 */
namespace DesignPatten\Structral\Adapter;

class BookAdapter
{
    private $book;

    public function __construct(SimpleBook $book)
    {
        $this->book = $book;
    }

    public function getAuthorAndTitle()
    {
        return $this->book->getTitle() . ' by ' . $this->book->getAuthor();
    }
}