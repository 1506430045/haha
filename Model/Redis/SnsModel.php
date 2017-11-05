<?php
/**
 * Created by PhpStorm.
 * User: xiangqian
 * Date: 17/8/20
 * Time: 下午12:16
 */

namespace Model\Redis;


use Config\RedisConfig;

class SnsModel
{

    private $redis;

    public function __construct()
    {
        $this->redis = BaseModel::getInstance(RedisConfig::$defaultConfig)->redis;
    }

    /**
     * 注册新用户
     *
     * @param $login
     * @param $name
     * @return int
     */
    public function createUser($login, $name)
    {
        $login = strtolower($login);
        $lockModel = (new LockModel());
        $lock = $lockModel->acquireLockWithTimeout('user:' . $login, 1); //加锁失败证明用户名已经被占用
        if (empty($lock)) {
            return 0;
        }
        if ($this->redis->hGet('users:', $login)) { //用户名已经被映射到其他用户
            $lockModel->releaseLock('user:' . $login, $lock);
            return 0;
        }
        $id = $this->redis->incr('user:id:');
        $pipe = $this->redis->multi(\Redis::PIPELINE);
        $pipe->hSet('users:', $login, $id); //设置用户名
        $pipe->hMset('user:' . $id, [
            'login' => $login,
            'id' => $id,
            'name' => $name,
            'followers' => 0,
            'following' => 0,
            'posts' => 0,
            'sign_up' => time()
        ]);
        $pipe->exec();
        $lockModel->releaseLock('user:' . $login, $lock);
        return $id;
    }

    /**
     * 发布动态
     *
     * @param $uid
     * @param $message
     * @return int
     */
    public function createStatus($uid, $message)
    {
        $pipe = $this->redis->multi(\Redis::PIPELINE);
        $pipe->hGet('user:' . $uid, 'login');
        $pipe->incr('status:id:');
        list($login, $id) = $pipe->exec();

        if (empty($login)) {
            return 0;
        }

        $data = [
            'message' => $message,
            'posted' => time(),
            'id' => $id,
            'uid' => $uid,
            'login' => $login
        ];
        $pipe->hMset('status:' . $id, $data);
        $pipe->hIncrBy('user:' . $uid, 'posts', 1);
        $pipe->exec();
        return $id;
    }

    /**
     *
     * @param $uid
     * @param string $timeLine
     * @param int $page
     * @param int $count
     * return array
     */
    public function getStatusMessage($uid, $timeLine = 'home:', $page = 1, $count = 30)
    {
        $statuses = $this->redis->zRevRange($timeLine . $uid, ($page - 1) * $count, $page * ($count - 1));
        $pipe = $this->redis->multi(\Redis::PIPELINE);
        foreach ($statuses as $id) {
            $pipe->hGetAll('status:' . $id);
        }
        return $pipe->exec();
    }
}