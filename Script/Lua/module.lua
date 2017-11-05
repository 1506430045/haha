--
-- Created by IntelliJ IDEA.
-- User: xiangqian
-- Date: 17/9/3
-- Time: 下午1:30
-- To change this template use File | Settings | File Templates.
--

local foo = {}

local function getName()
    return "tom"
end

function foo.greeting()
    print("hello " .. getName())
end

return foo