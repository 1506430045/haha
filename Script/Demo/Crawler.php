<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/24
 * Time: 上午11:41
 */
class Crawler
{
    private $url;
    private $toVisit = [];

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function visitOneDegree()
    {
        $this->loadPageUrls();
        $this->visitAll();
    }

    private function loadPageUrls()
    {
        $content = $this->visit($this->url);
        $pattern = '#((http|ftp)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i';
        preg_match_all($pattern, $content, $matched);
        foreach ($matched[0] as $url) {
            if (in_array($url, $this->toVisit)) {
                continue;
            }
            $this->toVisit[] = $url;
        }
    }

    private function visitAll()
    {
        foreach ($this->toVisit as $url) {
            $this->visit($url);
        }
    }

    private function visit($url)
    {
        return @file_get_contents($url);
    }

    public function run()
    {
        $start = microtime(true);
        $this->visitOneDegree();

        $timeUsed = microtime(true) - $start;
        echo "time used: " . $timeUsed;
    }
}

$o = new Crawler('http://www.swoole.com/');
$o->run();