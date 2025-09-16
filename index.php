<?php
// function countdown($n){
//     if($n <= 0){
//         echo "发射！\n";
//         return;
//     }
//     echo  $n. '\n';

//     countdown($n -1);
// }

// countdown(5);

 /**
  * 阶乘--递归法
  */
//  function factorial($n){
//     if($n <=1) return 1;
//     return $n * factorial($n -1);
//  }

//  echo factorial(100);

 /**
  * 阶乘--循环法
  */

//  function factorial_loop($n){
//   $result =  1;
//   for ($i = 1; $i <= $n; $i++){
//     $result *= $i;
//   }
//   return $result;
//  }

//  echo factorial_loop(100);


/**
 * 相加
 * 1+2+3+4+5+6+7+8+9+.....+n
 */

// function recursiveSum($n){
//   if($n ==1) return 1;
//   return $n + recursiveSum($n-1);
// }

// echo recursiveSum(100);



// function a(){
//   echo "进入函数 a<br>";
//   b();
//   echo "离开函数 a<br>";
// }
// function b(){
//   echo "进入函数 b<br>";
//   c();
//   echo "离开函数 b<br>";
// }
// function c(){
//   echo "进入函数 c<br>";
//   echo "离开函数 c<br>";
// }

// a();


// function countdown($n) {
//   if ($n <= 0) {
//       echo "结束\n";
//       return;
//   }
//   echo "$n\n";
//   countdown($n - 1);
// }

// countdown(3);




// 递归执行过程可视化 - 改进版
function visualizeRecursion($n, $depth = 0) {
  // $indent: 根据递归深度创建缩进字符串
  // 每层递归增加2个空格，用于可视化层次结构
  $indent = str_repeat("&nbsp;&nbsp;", $depth); // 使用HTML空格实体
  
  echo $indent . "→ 进入 visualizeRecursion($n)<br>";
  echo $indent . "&nbsp;&nbsp;当前递归深度: $depth<br>";
  
  if ($n <= 0) {
      echo $indent . "&nbsp;&nbsp;🎯 到达基础情况 (n=$n)<br>";
      echo $indent . "← 返回 visualizeRecursion($n)<br>";
      return;
  }
  
  echo $indent . "&nbsp;&nbsp;📞 准备递归调用 visualizeRecursion(" . ($n-1) . ")...<br>";
  visualizeRecursion($n - 1, $depth + 1);
  echo $indent . "← 返回 visualizeRecursion($n)<br>";
}

echo "<hr>";
echo "<h3>🔍 缩进层次结构分析</h3>";
echo "<div style='background: #f0f8ff; padding: 15px; border-left: 4px solid #2196F3;'>";
echo "<strong>为什么需要额外的 &nbsp;&nbsp;？</strong><br><br>";

echo "<strong>层次结构设计：</strong><br>";
echo "• <code>\$indent</code> = 控制整个函数调用的缩进级别<br>";
echo "• <code>&nbsp;&nbsp;</code> = 函数内部信息的额外缩进<br><br>";

echo "<strong>视觉效果对比：</strong><br>";
echo "<div style='font-family: monospace; background: #f9f9f9; padding: 10px; margin: 10px 0;'>";

// 演示不同缩进效果
for($i = 0; $i < 3; $i++) {
    $base_indent = str_repeat("&nbsp;&nbsp;", $i);
    
    echo "<strong>深度 $i 的显示效果：</strong><br>";
    echo "$base_indent" . "→ 进入函数 (主缩进)<br>";
    echo "$base_indent" . "&nbsp;&nbsp;详细信息 (主缩进 + 2空格)<br>";
    echo "$base_indent" . "&nbsp;&nbsp;更多信息 (主缩进 + 2空格)<br>";
    echo "$base_indent" . "← 返回函数 (主缩进)<br><br>";
}
echo "</div>";

echo "<strong>设计目的：</strong><br>";
echo "1. <strong>主缩进 (\$indent)</strong>：区分不同递归层级<br>";
echo "2. <strong>次缩进 (&nbsp;&nbsp;)</strong>：区分函数调用和函数内部信息<br>";
echo "3. <strong>视觉层次</strong>：让输出更清晰易读<br><br>";

echo "<strong>如果不加 &nbsp;&nbsp; 会怎样？</strong><br>";
echo "<div style='font-family: monospace; background: #ffebee; padding: 10px; margin: 10px 0;'>";
echo "→ 进入函数<br>";
echo "当前递归深度: 0<br>";  // 没有额外缩进，看起来像同一级别
echo "← 返回函数<br>";
echo "</div>";

echo "<strong>加了 &nbsp;&nbsp; 的效果：</strong><br>";
echo "<div style='font-family: monospace; background: #e8f5e8; padding: 10px; margin: 10px 0;'>";
echo "→ 进入函数<br>";
echo "&nbsp;&nbsp;当前递归深度: 0<br>";  // 有额外缩进，清楚显示是函数内部信息
echo "← 返回函数<br>";
echo "</div>";

echo "</div>";

echo "<hr>";
echo "<h2>🏗️ 栈帧 (Stack Frame) 详解</h2>";

// 1. 什么是栈帧
echo "<h3>1. 什么是栈帧？</h3>";
echo "<div style='background: #e3f2fd; padding: 15px; border-left: 4px solid #2196F3;'>";
echo "<strong>栈帧 (Stack Frame)</strong> 是调用栈中的一个单元，每次函数调用都会创建一个新的栈帧。<br><br>";
echo "<strong>栈帧包含：</strong><br>";
echo "1. <strong>局部变量 (Local Variables)</strong>：函数内定义的变量<br>";
echo "2. <strong>参数 (Parameters)</strong>：传递给函数的参数<br>";
echo "3. <strong>返回地址 (Return Address)</strong>：函数执行完后返回的位置<br>";
echo "4. <strong>其他信息 (Other Information)</strong>：如寄存器状态等<br>";
echo "</div><br>";

// 2. 递归中的栈帧演示
echo "<h3>2. 递归中的栈帧演示</h3>";
echo "<div style='background: #f1f8e9; padding: 15px; border-left: 4px solid #4CAF50;'>";

// 阶乘函数
function factorial($n) {
    echo "<div style='font-family: monospace; background: #fff3e0; padding: 5px; margin: 2px; border: 1px solid #ff9800;'>";
    echo "🔧 创建栈帧: factorial($n) - 参数: \$n = $n";
    echo "</div>";
    
    // 每次调用都有自己的 $n
    if ($n <= 1) {
        echo "<div style='font-family: monospace; background: #e8f5e8; padding: 5px; margin: 2px; border: 1px solid #4caf50;'>";
        echo "✅ 基础情况: factorial($n) = 1 (销毁栈帧)";
        echo "</div>";
        return 1;
    }
    
    echo "<div style='font-family: monospace; background: #fff3e0; padding: 5px; margin: 2px; border: 1px solid #ff9800;'>";
    echo "📞 递归调用: factorial(" . ($n-1) . ")";
    echo "</div>";
    
    $result = $n * factorial($n - 1);
    
    echo "<div style='font-family: monospace; background: #e3f2fd; padding: 5px; margin: 2px; border: 1px solid #2196f3;'>";
    echo "🔄 返回结果: factorial($n) = $result (销毁栈帧)";
    echo "</div>";
    
    return $result;
}

echo "<strong>调用 factorial(4) 的栈帧过程：</strong><br><br>";
$result = factorial(4);
echo "<br><strong>最终结果: factorial(4) = $result</strong><br>";
echo "</div><br>";

// 3. 栈帧的详细结构分析
echo "<h3>3. 栈帧的详细结构分析</h3>";
echo "<div style='background: #fce4ec; padding: 15px; border-left: 4px solid #e91e63;'>";

echo "<strong>调用 factorial(4) 时的栈帧状态：</strong><br><br>";

// 模拟栈帧结构
$stack_frames = [
    [
        'frame' => 4,
        'function' => 'factorial(4)',
        'params' => ['$n = 4'],
        'return_address' => 'main',
        'status' => '等待递归调用完成'
    ],
    [
        'frame' => 3,
        'function' => 'factorial(3)',
        'params' => ['$n = 3'],
        'return_address' => 'factorial(4)',
        'status' => '等待递归调用完成'
    ],
    [
        'frame' => 2,
        'function' => 'factorial(2)',
        'params' => ['$n = 2'],
        'return_address' => 'factorial(3)',
        'status' => '等待递归调用完成'
    ],
    [
        'frame' => 1,
        'function' => 'factorial(1)',
        'params' => ['$n = 1'],
        'return_address' => 'factorial(2)',
        'status' => '基础情况，准备返回'
    ]
];

echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%; font-family: monospace;'>";
echo "<tr style='background: #e1f5fe;'>";
echo "<th>栈帧编号</th><th>函数调用</th><th>参数</th><th>返回地址</th><th>状态</th>";
echo "</tr>";

foreach($stack_frames as $frame) {
    $color = $frame['frame'] == 1 ? '#e8f5e8' : '#fff3e0';
    echo "<tr style='background: $color;'>";
    echo "<td><strong>栈帧{$frame['frame']}</strong></td>";
    echo "<td><code>{$frame['function']}</code></td>";
    echo "<td>{$frame['params'][0]}</td>";
    echo "<td><code>{$frame['return_address']}</code></td>";
    echo "<td>{$frame['status']}</td>";
    echo "</tr>";
}
echo "</table><br>";

echo "<strong>栈帧特点：</strong><br>";
echo "• <strong>LIFO (后进先出)</strong>：最后创建的栈帧最先销毁<br>";
echo "• <strong>独立空间</strong>：每个栈帧都有独立的变量空间<br>";
echo "• <strong>嵌套关系</strong>：栈帧之间形成调用链<br>";
echo "• <strong>自动管理</strong>：函数结束时自动销毁栈帧<br>";
echo "</div><br>";

// 4. 栈帧的生命周期
echo "<h3>4. 栈帧的生命周期</h3>";
echo "<div style='background: #f3e5f5; padding: 15px; border-left: 4px solid #9c27b0;'>";

echo "<strong>栈帧的完整生命周期：</strong><br><br>";

$lifecycle_steps = [
    "1️⃣ <strong>创建阶段</strong>：函数被调用时创建新的栈帧",
    "2️⃣ <strong>初始化阶段</strong>：设置参数、局部变量、返回地址",
    "3️⃣ <strong>执行阶段</strong>：执行函数体代码",
    "4️⃣ <strong>递归阶段</strong>：如果需要，创建新的栈帧",
    "5️⃣ <strong>返回阶段</strong>：计算返回值，准备销毁",
    "6️⃣ <strong>销毁阶段</strong>：释放内存，返回到调用者"
];

foreach($lifecycle_steps as $step) {
    echo "<div style='background: #f9f9f9; padding: 8px; margin: 5px 0; border-radius: 4px;'>";
    echo "$step";
    echo "</div>";
}

echo "<br><strong>内存管理：</strong><br>";
echo "• 栈帧在<strong>栈内存</strong>中分配<br>";
echo "• 栈内存大小有限，递归过深可能导致<strong>栈溢出</strong><br>";
echo "• 每个栈帧占用固定大小的内存空间<br>";
echo "• 函数返回后，栈帧立即被回收<br>";
echo "</div><br>";

// 5. 栈帧的可视化演示
echo "<h3>5. 栈帧的可视化演示</h3>";
echo "<div style='background: #fff8e1; padding: 15px; border-left: 4px solid #ff9800;'>";

echo "<strong>栈帧的堆叠过程：</strong><br><br>";

// 模拟栈帧堆叠
$stack_visualization = [
    "┌─────────────────────────┐",
    "│    栈帧1: factorial(1)  │ ← 最顶层 (当前执行)",
    "│    \$n = 1              │",
    "│    返回地址: factorial(2)│",
    "├─────────────────────────┤",
    "│    栈帧2: factorial(2)  │",
    "│    \$n = 2              │",
    "│    返回地址: factorial(3)│",
    "├─────────────────────────┤",
    "│    栈帧3: factorial(3)  │",
    "│    \$n = 3              │",
    "│    返回地址: factorial(4)│",
    "├─────────────────────────┤",
    "│    栈帧4: factorial(4)  │ ← 最底层 (最先创建)",
    "│    \$n = 4              │",
    "│    返回地址: main       │",
    "└─────────────────────────┘"
];

echo "<div style='font-family: monospace; background: #f5f5f5; padding: 10px; border: 2px solid #333;'>";
foreach($stack_visualization as $line) {
    echo "$line<br>";
}
echo "</div>";

echo "<br><strong>关键理解：</strong><br>";
echo "• 栈帧从<strong>底部向上</strong>堆叠<br>";
echo "• 当前执行的函数在<strong>栈顶</strong><br>";
echo "• 函数返回时，栈帧从<strong>顶部向下</strong>销毁<br>";
echo "• 每个栈帧都<strong>独立</strong>，互不干扰<br>";
echo "</div><br>";

// 6. 栈帧与递归的关系
echo "<h3>6. 栈帧与递归的关系</h3>";
echo "<div style='background: #e8f5e8; padding: 15px; border-left: 4px solid #4caf50;'>";

echo "<strong>递归中的栈帧特点：</strong><br><br>";

echo "<strong>🔹 栈帧数量 = 递归深度</strong><br>";
echo "• 递归调用多少次，就创建多少个栈帧<br>";
echo "• 每个栈帧保存一个递归层级的状态<br><br>";

echo "<strong>🔹 栈帧内容 = 递归状态</strong><br>";
echo "• 参数：当前递归层级的输入值<br>";
echo "• 局部变量：当前层级的计算结果<br>";
echo "• 返回地址：返回到上一层的地址<br><br>";

echo "<strong>🔹 栈帧销毁 = 递归返回</strong><br>";
echo "• 函数返回时，当前栈帧被销毁<br>";
echo "• 控制权返回到调用者的栈帧<br>";
echo "• 递归的\"回溯\"过程就是栈帧的销毁过程<br><br>";

echo "<strong>⚠️ 注意事项：</strong><br>";
echo "• 递归过深会导致<strong>栈溢出 (Stack Overflow)</strong><br>";
echo "• 每个栈帧都占用内存，深度递归消耗大量内存<br>";
echo "• 尾递归优化可以减少栈帧数量<br>";
echo "</div>";

// 添加HTML样式改善显示效果
echo "<h3>递归可视化演示：</h3>";
echo "<div style='font-family: monospace; background: #f5f5f5; padding: 10px; border-radius: 5px;'>";
visualizeRecursion(3);
echo "</div>";

echo "<hr>";
echo "<h3>命令行版本（使用普通空格）：</h3>";

// 命令行友好版本
function visualizeRecursionCLI($n, $depth = 0) {
  $indent = str_repeat("  ", $depth);
  
  echo $indent . "→ 进入 visualizeRecursion($n)" . PHP_EOL;
  echo $indent . "  当前递归深度: $depth" . PHP_EOL;
  
  if ($n <= 0) {
      echo $indent . "  🎯 到达基础情况" . PHP_EOL;
      echo $indent . "← 返回 visualizeRecursion($n)" . PHP_EOL;
      return;
  }
  
  echo $indent . "  📞 准备递归调用..." . PHP_EOL;
  visualizeRecursionCLI($n - 1, $depth + 1);
  echo $indent . "← 返回 visualizeRecursion($n)" . PHP_EOL;
}

echo "<pre>";
visualizeRecursionCLI(3);
echo "</pre>";

echo "<hr>";
echo "<h2>📚 str_repeat() 函数详解</h2>";

// 1. 基本语法演示
echo "<h3>1. 基本语法</h3>";
echo "<code>str_repeat(string \$input, int \$multiplier): string</code><br><br>";

// 2. 基础用法示例
echo "<h3>2. 基础用法示例</h3>";
echo "<div style='background: #f9f9f9; padding: 10px; margin: 10px 0;'>";
echo "<strong>示例1：重复字符</strong><br>";
$result1 = str_repeat("A", 5);
echo "str_repeat('A', 5) = '$result1'<br><br>";

echo "<strong>示例2：重复字符串</strong><br>";
$result2 = str_repeat("Hello ", 3);
echo "str_repeat('Hello ', 3) = '$result2'<br><br>";

echo "<strong>示例3：重复空格（缩进）</strong><br>";
$result3 = str_repeat("&nbsp;&nbsp;", 4);
echo "str_repeat('&nbsp;&nbsp;', 4) = '$result3|' （4层缩进）<br><br>";

echo "<strong>示例4：重复特殊字符</strong><br>";
$result4 = str_repeat("=", 20);
echo "str_repeat('=', 20) = '$result4'<br>";
echo "</div>";

// 3. 参数详解
echo "<h3>3. 参数详解</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>参数</th><th>类型</th><th>说明</th><th>示例</th></tr>";
echo "<tr><td>\$input</td><td>string</td><td>要重复的字符串</td><td>'*', 'ABC', '&nbsp;'</td></tr>";
echo "<tr><td>\$multiplier</td><td>int</td><td>重复次数（必须≥0）</td><td>3, 10, 0</td></tr>";
echo "<tr><td>返回值</td><td>string</td><td>重复后的字符串</td><td>'***', 'ABCABCABC'</td></tr>";
echo "</table><br>";

// 4. 实际应用场景
echo "<h3>4. 实际应用场景</h3>";
echo "<div style='background: #e8f5e8; padding: 10px; margin: 10px 0;'>";

echo "<strong>场景1：创建分隔线</strong><br>";
$separator = str_repeat("-", 30);
echo "分隔线: $separator<br><br>";

echo "<strong>场景2：生成缩进（递归可视化）</strong><br>";
for($i = 0; $i < 4; $i++) {
    $indent = str_repeat("&nbsp;&nbsp;", $i);
    echo $indent . "第 $i 层缩进<br>";
}
echo "<br>";

echo "<strong>场景3：填充字符</strong><br>";
$padding = str_repeat("0", 5);
echo "填充: ID{$padding}123 → ID00000123<br><br>";

echo "<strong>场景4：创建表格边框</strong><br>";
$border = str_repeat("=", 15);
echo "+$border+<br>";
echo "|&nbsp;&nbsp;&nbsp;表格内容&nbsp;&nbsp;&nbsp;|<br>";
echo "+$border+<br>";
echo "</div>";

// 5. 特殊情况和注意事项
echo "<h3>5. 特殊情况和注意事项</h3>";
echo "<div style='background: #fff3cd; padding: 10px; margin: 10px 0;'>";

echo "<strong>情况1：重复次数为0</strong><br>";
$result5 = str_repeat("ABC", 0);
echo "str_repeat('ABC', 0) = '$result5' （返回空字符串）<br><br>";

echo "<strong>情况2：空字符串</strong><br>";
$result6 = str_repeat("", 5);
echo "str_repeat('', 5) = '$result6' （空字符串重复任意次仍是空字符串）<br><br>";

echo "<strong>情况3：单个字符 vs 多字符字符串</strong><br>";
$single = str_repeat("X", 3);
$multiple = str_repeat("AB", 3);
echo "str_repeat('X', 3) = '$single'<br>";
echo "str_repeat('AB', 3) = '$multiple'<br><br>";

echo "<strong>⚠️ 注意事项：</strong><br>";
echo "• 重复次数必须是非负整数<br>";
echo "• 重复次数过大可能导致内存问题<br>";
echo "• 返回值总是字符串类型<br>";
echo "</div>";

// 6. 与其他函数组合使用
echo "<h3>6. 与其他函数组合使用</h3>";
echo "<div style='background: #e3f2fd; padding: 10px; margin: 10px 0;'>";

echo "<strong>组合1：str_repeat + substr（截取固定长度）</strong><br>";
$repeated = str_repeat("ABCD", 10);
$truncated = substr($repeated, 0, 15);
echo "生成: '$repeated'<br>";
echo "截取前15个字符: '$truncated'<br><br>";

echo "<strong>组合2：str_repeat + strtoupper（大写重复）</strong><br>";
$upper_repeat = str_repeat(strtoupper("hello "), 3);
echo "str_repeat(strtoupper('hello '), 3) = '$upper_repeat'<br><br>";

echo "<strong>组合3：sprintf + str_repeat（格式化填充）</strong><br>";
$padded = sprintf("%s%03d", str_repeat("0", 2), 42);
echo "sprintf + str_repeat: '$padded'<br>";
echo "</div>";

// 7. 性能对比
echo "<h3>7. 性能对比</h3>";
echo "<div style='background: #f3e5f5; padding: 10px; margin: 10px 0;'>";
echo "<strong>不同实现方式的性能：</strong><br><br>";

// 方法1：str_repeat（推荐）
$start = microtime(true);
$result_method1 = str_repeat("A", 1000);
$time1 = microtime(true) - $start;

// 方法2：循环拼接
$start = microtime(true);
$result_method2 = "";
for($i = 0; $i < 1000; $i++) {
    $result_method2 .= "A";
}
$time2 = microtime(true) - $start;

echo "方法1 str_repeat('A', 1000): " . number_format($time1 * 1000000, 2) . " 微秒<br>";
echo "方法2 循环拼接: " . number_format($time2 * 1000000, 2) . " 微秒<br>";
echo "<strong>结论：str_repeat() 性能更优！</strong><br>";
echo "</div>";