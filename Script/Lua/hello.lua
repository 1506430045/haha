--
-- Lua基础数据类型、表达式、控制结构

-- User: xiangqian
-- Date: 17/9/2
-- Time: 下午5:41
-- To change this template use File | Settings | File Templates.
--

-- Lua基础数据类型
-- 函数type返回一个值或者一个变量所属的类型

print(type("hello world"))
print(type(print))
print(type(true))
print(type(360.0))
print(type(nil))

-- 1、nil
local num
print(num)

-- 2、boolean    Lua中nil和false为假,其他均为真
local a = true
local b = 0
local c = nil
if a then
    print(a)
else
    print("not a")
end

-- 3、number
local order = 3.99
local score = 98.01
print(math.floor(order)) --向下取整
print(math.ceil(score)) --向上取整

-- 4、string 字符串内化:完全一样的lua字符串在lua虚拟机中只会存储一份
local string1 = "hello world"
local string2 = 'hello world'



-- 5、table

local corp = {
    web = "www.google.com", --索引为字符串
    telephone = "12345678",
    staff = {
        "jack", "tom", "gary"
    },
    10086, --相当于[1] = 10086,此时索引为数字
    10091, --相当于[2] = 10091,此时索引为数字
    [10] = 360,
    ["city"] = "beijing" --索引为字符串
}

print(corp["city"])

-- 6、function

local function foo()
    print("in the function")
    --dosomething
    local x = 10
    local y = 20
    return x + y
end

local a = foo

print(a())

-- 表达式

print(1 + 2)
print(5 / 10)
print(5.0 / 10)
-- pinrt(10 / 0)    --除数不能为0
print(2 ^ 10)

local num = 1357
print(num % 2)
print((num % 2) == 1)
print((num % 2) == 0)

print(1 ~= 2)
local a, b = true, false
print(a == b)

-- 注意:1、"不等于"写法为~= 2、lua是做引用比较 3、lua字符串的相等性比较可简化为其内部地址的比较


local c = nil
local d = 0
local e = 100
print(c and b) -->打印 nil
print(c and e) -->打印 nil
print(d and e) -->打印 100
print(c or d) -->打印 0
print(c or e) -->打印 100
print(not c) -->打印 true
print(not d) -->打印 false

-- 字符串拼接
print("hello" .. "world")
str = string.format("%s-%s", "hello", "world")
print(str)

-- 控制结构 if-else

-- 单个if分支型
x = 10
if x > 0 then
    print("x is a positive number")
end

-- 两个分支if-else型
x = 10
if x > 10 then
    print("x is a positive number")
else
    print("x is a non-positive number")
end

-- 多个分支if-else型 注意:elseif 和else if的区别
score = 90
if score == 100 then
    print("Very good!Your Score is 100")
elseif score >= 60 then
    print("Congratulations!Your Score is " .. score)
else
    print("Sorry!Your Score is " .. score)
end

-- wile 注意无 continue 但是有 break
x = 1
sum = 0

while x <= 5 do
    sum = sum + x
    x = x + 1
end
print(sum)

-- repeat
-- 类似其他语言的 do-while,但是控制方式刚好相反,执行 repeat 循环体后,直到 until为真结束
-- 下面是个死循环

--x = 10
--repeat
--    print(x)
--until false

-- for 控制结构

-- for 数字型

print(math.huge) --数字上限

for i = 10, 1, -1 do
    print(i)
end

-- for 泛型
local a = { "a", "b", "c", "d" }
for i, v in ipairs(a) do
    print("index:", i, " value:", v)
end

-- 函数 table是引用传递 其他是值传递
-- 函数变长参数
local function func(...)
    local temp = { ... }
    local ans = table.concat(temp, " ")
    print(ans)
end

func(1, 2, 3, 4)

-- 多返回值
local function init()
    return 1, "lua"
end
print(init())