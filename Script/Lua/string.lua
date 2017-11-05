--
-- Created by IntelliJ IDEA.
-- User: xiangqian
-- Date: 17/9/3
-- Time: 下午1:35
-- To change this template use File | Settings | File Templates.
--

print(string.byte("abc", 1, 3))
print(string.byte("abc", 3))
print(string.byte("abc"))

print(string.char(96, 97, 98))
print(string.char())
print(string.char(65, 66))

print(string.upper("hello world"))
print(string.lower("Hello World"))
print(string.len("hello world"))

local find = string.find
print(find("abc cba", "cb"))
print(find("abc cba", "bc", 2))
print(find("abc cba", "cb", -3))
print(find("abc cba", "(%a+)", 1))
print(find("abc cba", "(%a+)", 1, true))

print(string.format("%.4f", 3.1235566))
print(string.format("%d %x %o", 31, 31, 31))
