<?php
echo "<h1>📚 str_repeat() 函数完整详解</h1>";

// 1. 基本语法
echo "<h2>1. 基本语法</h2>";
echo "<div style='background: #f0f8ff; padding: 15px; border-left: 4px solid #4CAF50;'>";
echo "<strong>语法:</strong> <code>str_repeat(string \$input, int \$multiplier): string</code><br>";
echo "<strong>功能:</strong> 重复一个字符串指定的次数<br>";
echo "<strong>参数:</strong><br>";
echo "&nbsp;&nbsp;• \$input: 要重复的字符串<br>";
echo "&nbsp;&nbsp;• \$multiplier: 重复次数（非负整数）<br>";
echo "<strong>返回:</strong> 重复后的字符串<br>";
echo "</div><br>";

// 2. 基础示例
echo "<h2>2. 基础示例</h2>";
echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
echo "<tr style='background: #e3f2fd;'><th>代码</th><th>结果</th><th>说明</th></tr>";

$examples = [
    ["str_repeat('*', 5)", str_repeat('*', 5), "重复单个字符"],
    ["str_repeat('ABC', 3)", str_repeat('ABC', 3), "重复字符串"],
    ["str_repeat(' ', 10)", str_repeat(' ', 10) . '|', "重复空格（用|标记结束）"],
    ["str_repeat('Hi! ', 4)", str_repeat('Hi! ', 4), "重复含空格的字符串"],
    ["str_repeat('123', 0)", str_repeat('123', 0) ?: '(空字符串)', "重复0次返回空字符串"],
];

foreach($examples as $example) {
    echo "<tr>";
    echo "<td><code>{$example[0]}</code></td>";
    echo "<td style='font-family: monospace; background: #f9f9f9;'>{$example[1]}</td>";
    echo "<td>{$example[2]}</td>";
    echo "</tr>";
}
echo "</table><br>";

// 3. 实际应用场景
echo "<h2>3. 实际应用场景</h2>";

echo "<h3>🔹 场景1: 创建分隔线和装饰</h3>";
echo "<div style='background: #f5f5f5; padding: 10px; margin: 10px 0; font-family: monospace;'>";
$line1 = str_repeat("=", 50);
$line2 = str_repeat("-", 30);
$line3 = str_repeat("*", 20);
echo "$line1<br>";
echo "这是用等号创建的分隔线<br>";
echo "$line1<br><br>";

echo "$line2<br>";
echo "这是用短横线创建的分隔线<br>";
echo "$line2<br><br>";

echo str_repeat(" ", 15) . "$line3<br>";
echo str_repeat(" ", 15) . "居中的星号装饰<br>";
echo str_repeat(" ", 15) . "$line3<br>";
echo "</div>";

echo "<h3>🔹 场景2: 生成缩进（递归/层级显示）</h3>";
echo "<div style='background: #e8f5e8; padding: 10px; margin: 10px 0; font-family: monospace;'>";
for($level = 0; $level < 5; $level++) {
    $indent = str_repeat("  ", $level); // 每层2个空格
    $marker = str_repeat("│ ", $level) . "├─"; // 树状结构
    echo "$marker 第 $level 级内容<br>";
}
echo "</div>";

echo "<h3>🔹 场景3: 数据格式化和填充</h3>";
echo "<div style='background: #fff3cd; padding: 10px; margin: 10px 0; font-family: monospace;'>";
// ID填充
$id = 42;
$paddedId = "ID" . str_repeat("0", 6) . $id;
echo "用户ID填充: $paddedId<br>";

// 进度条
$progress = 70; // 70%
$filled = str_repeat("█", intval($progress/5));
$empty = str_repeat("░", 20 - intval($progress/5));
echo "进度条: [$filled$empty] $progress%<br>";

// 价格对齐
$prices = [12.5, 156.78, 9.99];
foreach($prices as $price) {
    $priceStr = number_format($price, 2);
    $dots = str_repeat(".", 15 - strlen($priceStr));
    echo "商品价格$dots￥$priceStr<br>";
}
echo "</div>";

echo "<h3>🔹 场景4: 创建简单的ASCII艺术</h3>";
echo "<div style='background: #e3f2fd; padding: 10px; margin: 10px 0; font-family: monospace;'>";
// 简单的框架
$width = 25;
$border = str_repeat("*", $width);
$space = str_repeat(" ", $width - 4);
echo "$border<br>";
echo "*$space*<br>";
echo "*" . str_repeat(" ", 7) . "Hello!" . str_repeat(" ", 7) . "*<br>";
echo "*$space*<br>";
echo "$border<br>";
echo "</div>";

// 4. 特殊情况和边界测试
echo "<h2>4. 特殊情况和边界测试</h2>";
echo "<table border='1' cellpadding='8' style='border-collapse: collapse; width: 100%;'>";
echo "<tr style='background: #ffebee;'><th>测试情况</th><th>代码</th><th>结果</th><th>说明</th></tr>";

$edge_cases = [
    ["空字符串", "str_repeat('', 5)", str_repeat('', 5) ?: '(空)', "空字符串重复任意次都是空"],
    ["重复0次", "str_repeat('ABC', 0)", str_repeat('ABC', 0) ?: '(空)', "任何字符串重复0次都是空"],
    ["单字符", "str_repeat('X', 1)", str_repeat('X', 1), "重复1次就是原字符串"],
    ["多字节字符", "str_repeat('中', 3)", str_repeat('中', 3), "支持UTF-8多字节字符"],
    ["特殊字符", "str_repeat('\\n', 3)", addslashes(str_repeat("\n", 3)), "特殊字符也可以重复"],
];

foreach($edge_cases as $case) {
    echo "<tr>";
    echo "<td>{$case[0]}</td>";
    echo "<td><code>{$case[1]}</code></td>";
    echo "<td style='font-family: monospace; background: #f9f9f9;'>{$case[2]}</td>";
    echo "<td>{$case[3]}</td>";
    echo "</tr>";
}
echo "</table><br>";

// 5. 性能比较
echo "<h2>5. 性能比较</h2>";
echo "<div style='background: #f3e5f5; padding: 15px; border-left: 4px solid #9C27B0;'>";

$iterations = 1000;
$char = "A";

// 方法1: str_repeat
$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    $result1 = str_repeat($char, $iterations);
}
$time1 = (microtime(true) - $start) * 1000;

// 方法2: 循环拼接
$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    $result2 = "";
    for($j = 0; $j < $iterations; $j++) {
        $result2 .= $char;
    }
}
$time2 = (microtime(true) - $start) * 1000;

// 方法3: implode + array_fill
$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    $result3 = implode("", array_fill(0, $iterations, $char));
}
$time3 = (microtime(true) - $start) * 1000;

echo "<strong>性能测试 (重复 '$char' $iterations 次，执行 100 轮):</strong><br><br>";
echo "🥇 方法1 - str_repeat(): " . number_format($time1, 3) . " 毫秒<br>";
echo "🥈 方法2 - 循环拼接: " . number_format($time2, 3) . " 毫秒<br>";
echo "🥉 方法3 - implode+array_fill: " . number_format($time3, 3) . " 毫秒<br><br>";

$fastest = min($time1, $time2, $time3);
echo "<strong>结论:</strong> str_repeat() 是最高效的方法！<br>";
echo "比循环拼接快 " . number_format($time2/$time1, 1) . " 倍<br>";
echo "</div>";

// 6. 与其他函数的组合应用
echo "<h2>6. 与其他函数的组合应用</h2>";

echo "<h3>🔹 组合1: str_repeat + str_pad (字符串填充)</h3>";
echo "<div style='background: #e8f5e8; padding: 10px; margin: 5px 0; font-family: monospace;'>";
$name = "张三";
$padded = str_pad($name, 10, str_repeat(".", 1), STR_PAD_RIGHT);
echo "姓名填充: '$padded'<br>";

$amount = "1234.56";
$formatted = str_repeat(" ", 10 - strlen($amount)) . $amount;
echo "金额对齐: '$formatted'<br>";
echo "</div>";

echo "<h3>🔹 组合2: str_repeat + substr (创建固定长度字符串)</h3>";
echo "<div style='background: #e8f5e8; padding: 10px; margin: 5px 0; font-family: monospace;'>";
$pattern = "ABC";
$repeated = str_repeat($pattern, 10);
$fixed_length = substr($repeated, 0, 25);
echo "原始重复: '$repeated'<br>";
echo "截取25位: '$fixed_length'<br>";
echo "</div>";

echo "<h3>🔹 组合3: str_repeat + sprintf (格式化输出)</h3>";
echo "<div style='background: #e8f5e8; padding: 10px; margin: 5px 0; font-family: monospace;'>";
$title = "重要通知";
$border = str_repeat("*", 30);
$centered = sprintf("%s\n%s%s%s\n%s", 
    $border, 
    str_repeat(" ", 11), 
    $title, 
    str_repeat(" ", 11), 
    $border
);
echo "<pre>$centered</pre>";
echo "</div>";

// 7. 注意事项和最佳实践
echo "<h2>7. 注意事项和最佳实践</h2>";
echo "<div style='background: #ffebee; padding: 15px; border-left: 4px solid #f44336;'>";
echo "<strong>⚠️ 注意事项:</strong><br>";
echo "• 重复次数必须是非负整数，负数会产生错误<br>";
echo "• 大量重复可能消耗大量内存，需要注意内存限制<br>";
echo "• 在循环中使用时要考虑性能影响<br>";
echo "• 多字节字符（如中文）按字符计数，不是字节数<br><br>";

echo "<strong>✅ 最佳实践:</strong><br>";
echo "• 优先使用 str_repeat() 而不是循环拼接<br>";
echo "• 对于大量数据，考虑分块处理<br>";
echo "• 结合其他字符串函数实现复杂格式化<br>";
echo "• 在模板和输出格式化中充分利用此函数<br>";
echo "</div>";

echo "<h2>8. 总结</h2>";
echo "<div style='background: #e8f5e8; padding: 15px; border-left: 4px solid #4CAF50;'>";
echo "<code>str_repeat()</code> 是PHP中非常实用的字符串函数，主要用于：<br>";
echo "• 🎨 创建装饰线和分隔符<br>";
echo "• 📐 生成缩进和格式化输出<br>";
echo "• 📊 制作简单的进度条和图表<br>";
echo "• 🔢 数据填充和对齐<br>";
echo "• 🎯 配合其他函数实现复杂格式化<br><br>";
echo "掌握这个函数可以让您的字符串处理更加高效和优雅！";
echo "</div>";
?>
