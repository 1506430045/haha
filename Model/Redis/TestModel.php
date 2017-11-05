<?php

/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/3
 * Time: 下午4:05
 */
namespace Model\Redis;

use Config\RedisConfig;

class TestModel
{
    private $redis;

    public function __construct()
    {
        $this->redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    /**
     * 将商品放到市场上销售
     *
     * @param $itemId   int 商品ID
     * @param $sellerId int 卖家ID
     * @param $price    float   商品价格
     * @return bool
     */
    public function listItem($itemId, $sellerId, $price)
    {
        $inventory = "inventory:{$sellerId}";
        $item = "{$itemId}.{$sellerId}";
        $end = time() + 5;
        while (time() < $end) {
            try {
                $this->redis->watch($inventory);    //监视包裹发生变化 $inventory为set
                if (!$this->redis->sIsMember($inventory, $itemId)) {
                    $this->redis->unwatch();
                    return false;
                }
                $this->redis->multi();
                $this->redis->zAdd("market:", $item, $price);
                $this->redis->sRem($inventory, $itemId);
                $this->redis->exec();
                return true;
            } catch (\RedisException $e) {
                continue;
            }
        }
        return false;
    }

    /**
     * 购买物品
     *
     * @param $buyerId
     * @param $itemId
     * @param $sellerId
     * @param $price
     * @return bool
     */
    public function purchaseItem($buyerId, $itemId, $sellerId, $purchasePrice)
    {
        $buyer = "users:{$buyerId}";
        $seller = "users:{$sellerId}";
        $item = "{$itemId}.{$sellerId}";
        $inventory = "inventory:{$buyerId}";
        $end = time() + 5;

        while (time() < $end) {
            try {
                $this->redis->watch("market:{$buyer}");
                $price = (float)$this->redis->zScore("market:", $item);
                $funds = (float)$this->redis->hGet($buyer, "funds");
                if ($price != $purchasePrice || $price > $funds) {
                    $this->redis->unwatch();
                    return false;
                }
                $this->redis->multi();
                $this->redis->hIncrBy($seller, "funds", $price);
                $this->redis->hIncrBy($buyer, "funds", -$price);
                $this->redis->sAdd($inventory, $itemId);
                $this->redis->zRem("market:", $item);
                $this->redis->exec();
                return true;
            } catch (\RedisException $e) {
                continue;
            }
        }
        return false;
    }

    public function test()
    {
        $multi = $this->redis->multi();
        for ($i = 0; $i < 5; $i++) {
            $multi->set('hello' . $i, $i);
        }
        $multi->exec();
    }
}