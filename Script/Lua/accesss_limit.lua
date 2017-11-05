local function close_redis(red)
    if not red then
        return
    end
    --释放连接（连接池实现）
    local pool_max_idle_time = 10000 --毫秒
    local pool_size = 100 --连接池大小
    --    local ok, err = re

    if not ok then
        ngx_log(ngx_ERR, "set redis keepalive error : ", err)
    end
end

local function wait()
    ngx.sleep(1)
end

local redis = require "resty.redis"
local red = redis:new()