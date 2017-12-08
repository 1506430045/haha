<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/11/24
 * Time: 上午11:58
 */
define('SCRIPT_BASE_DIR', __DIR__ . '/../..');

require_once SCRIPT_BASE_DIR . '/vendor/autoload.php';

class CrawlerV2
{
    private $url;
    private $toVisit = [];

    public function __construct($url)
    {
        $this->url = $url;
    }

    public function visitOneDegree($callback)
    {
        $this->visit($this->url, function ($content) use ($callback) {
            $this->loadPage($content);
            $this->visitAll();
            call_user_func($callback);
        });
    }

    private function loadPage($content)
    {
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

    private function visit($url, $callBack = null)
    {
        $urlInfo = parse_url($url);
        //Swoole\Async::dnsLookup
        swoole_async_dns_lookup($urlInfo['host'], function ($domainName, $ip) use ($urlInfo, $callBack) {
            if (!$ip) {
                return;
            }
            $cli = new swoole_http_client($ip, 80);
            $cli->setHeaders([
                'Host' => $domainName,
                "User-Agent" => 'Chrome/49.0.2587.3',
                'Accept' => 'text/html,application/xhtml+xml,application/xml',
                'Accept-Encoding' => 'gzip',
            ]);
            $cli->get($urlInfo['path'], function ($cli) use ($callBack) {
                if ($callBack) {
                    call_user_func($callBack, $cli->body);
                }
                $cli->close();
            });
        });
    }

    public function run()
    {
        $start = microtime(true);
        $this->visitOneDegree(function () use ($start) {
            $timeUsed = microtime(true) - $start;
            echo "time used: " . $timeUsed;
        });
    }
}

$o = new CrawlerV2('http://www.swoole.com/');
$o->run();