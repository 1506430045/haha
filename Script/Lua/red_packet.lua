--
-- Created by IntelliJ IDEA.
-- User: xiangqian
-- Date: 17/8/27
-- Time: 下午11:16
-- To change this template use File | Settings | File Templates.
--

-- 函数: 尝试获得红包,如果成功,则返回json串,如果不成功,则返回空
-- 参数: 红包队列名
-- 返回值: nil 或 json

if redis.call('hexists', KEYS[3], KEYS[4]) ~= 0 then
    return nil
else
    -- 先取出一个小红包
    local redPackage = redis.call('rpop', KEYS[1])
    if redPackage then
        local x = cjson.decode(redPackage)
        -- 加入用户ID信息
        x['userId'] = KEYS[4]
        local re = cjson.encode(x)
        -- 把用户ID放到去重的set里
        redis.call('hset', KEYS[3], KEYS[4], KEYS[4])
        -- 把红包放到已消费队列里
        redis.call('lpush', KEYS[2], re)
        return re
    end
end
return nil