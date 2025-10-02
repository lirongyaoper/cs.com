<?php
/**
 * 示例2：get_tree() 方法深度解析
 * 
 * 这个示例详细讲解：
 * 1. get_tree() 的每个参数的作用
 * 2. 模板字符串的各种用法
 * 3. 选中状态的处理
 * 4. 分组模板的使用
 */

require_once dirname(__DIR__) . '/tree.class.php';

echo "=====================================\n";
echo "   get_tree() 方法深度解析\n";
echo "=====================================\n\n";

// 准备数据
$categories = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '电子产品', 'url' => '/electronics', 'icon' => '📱'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '图书', 'url' => '/books', 'icon' => '📚'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => '手机', 'url' => '/phone', 'icon' => '📱', 'count' => 120],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '电脑', 'url' => '/computer', 'icon' => '💻', 'count' => 85],
    5 => ['id' => 5, 'parentid' => 3, 'name' => '苹果手机', 'url' => '/iphone', 'icon' => '🍎', 'count' => 50],
    6 => ['id' => 6, 'parentid' => 3, 'name' => '安卓手机', 'url' => '/android', 'icon' => '🤖', 'count' => 70],
    7 => ['id' => 7, 'parentid' => 2, 'name' => '小说', 'url' => '/novel', 'icon' => '📖', 'count' => 200],
    8 => ['id' => 8, 'parentid' => 4, 'name' => '笔记本', 'url' => '/laptop', 'icon' => '💻', 'count' => 45],
];


// ========================================
// 参数1: $myid - 起始节点ID
// ========================================
echo "【参数1】\$myid - 指定从哪个节点开始生成树\n";
echo "============================================\n\n";

$tree = new tree();
$tree->init($categories);

echo "示例 1-1: \$myid = 0，从根节点开始，生成整棵树\n";
echo "代码: \$tree->get_tree(0, \"\\\$spacer\\\$name\\n\");\n\n";
$tree->ret = '';
$result = $tree->get_tree(0, "\$spacer\$name\n");
echo $result;

echo "\n示例 1-2: \$myid = 1，只生成 id=1 (电子产品) 的子树\n";
echo "代码: \$tree->get_tree(1, \"\\\$spacer\\\$name\\n\");\n\n";
$tree->ret = '';
$result = $tree->get_tree(1, "\$spacer\$name\n");
echo $result;

echo "\n示例 1-3: \$myid = 3，只生成 id=3 (手机) 的子树\n";
echo "代码: \$tree->get_tree(3, \"\\\$spacer\\\$name\\n\");\n\n";
$tree->ret = '';
$result = $tree->get_tree(3, "\$spacer\$name\n");
echo $result;


// ========================================
// 参数2: $str - 模板字符串（核心参数）
// ========================================
echo "\n\n【参数2】\$str - 模板字符串（最重要的参数）\n";
echo "============================================\n\n";

echo "关键点：\n";
echo "1. 模板中可以使用数组的所有字段\n";
echo "2. 特殊变量：\$id, \$parentid, \$name, \$spacer, \$selected\n";
echo "3. 使用 eval() 执行，所以需要用引号包裹字符串\n\n";

echo "示例 2-1: 纯文本输出\n";
echo "代码: \$str = \"\\\$spacer\\\$name\\n\";\n\n";
$tree->ret = '';
$str = "\$spacer\$name\n";
echo $tree->get_tree(0, $str);


echo "\n示例 2-2: 使用自定义字段（icon 和 count）\n";
echo "代码: \$str = \"\\\$spacer\\\$icon \\\$name (\\\$count 件)\\n\";\n\n";
$tree->ret = '';
$str = "\$spacer\$icon \$name" . (isset($count) ? " (\$count 件)" : "") . "\n";
// 注意：因为顶级分类没有 count 字段，我们需要处理
$str = "\$spacer\$icon \$name\n";
$result = $tree->get_tree(0, $str);
echo $result;


echo "\n示例 2-3: 生成 HTML option 标签\n";
echo "代码: \$str = \"<option value='\\\$id'>\\\$spacer\\\$name</option>\\n\";\n\n";
$tree->ret = '';
$str = "<option value='\$id'>\$spacer\$name</option>\n";
$result = $tree->get_tree(0, $str);
echo "生成的 HTML：\n";
echo htmlspecialchars($result);
echo "\n实际效果（需要在浏览器中查看）：\n";
echo "<select style='width:300px; font-family:monospace;'>\n";
echo $result;
echo "</select>\n";


echo "\n示例 2-4: 生成带链接的 HTML\n";
echo "代码: \$str = \"<div><a href='\\\$url'>\\\$spacer\\\$name</a></div>\\n\";\n\n";
$tree->ret = '';
$str = "<div style='padding: 5px; font-family: monospace;'><a href='\$url'>\$spacer\$icon \$name</a></div>\n";
$result = $tree->get_tree(0, $str);
echo "生成的 HTML：\n";
echo htmlspecialchars($result);


echo "\n示例 2-5: 生成列表（带 data 属性）\n";
echo "代码: \$str = \"<li data-id='\\\$id' data-parent='\\\$parentid'>\\\$spacer\\\$name</li>\\n\";\n\n";
$tree->ret = '';
$str = "<li data-id='\$id' data-parent='\$parentid'>\$spacer\$name</li>\n";
$result = $tree->get_tree(0, $str);
echo "生成的 HTML：\n";
echo htmlspecialchars($result);


// ========================================
// 参数3: $sid - 选中状态
// ========================================
echo "\n\n【参数3】\$sid - 指定选中的节点\n";
echo "============================================\n\n";

echo "示例 3-1: 单个选中（\$sid = 5）\n";
echo "代码: \$tree->get_tree(0, \$str, 5);\n\n";
$tree->ret = '';
$str = "<option value='\$id' \$selected>\$spacer\$name</option>\n";
$result = $tree->get_tree(0, $str, 5);
echo "注意观察 id=5 的选项：\n";
echo htmlspecialchars($result);


echo "\n示例 3-2: 多个选中（\$sid = [3, 5, 7]）\n";
echo "代码: \$tree->get_tree(0, \$str, [3, 5, 7]);\n\n";
$tree->ret = '';
$str = "<option value='\$id' \$selected>\$spacer\$name</option>\n";
$result = $tree->get_tree(0, $str, [3, 5, 7]);
echo "注意观察 id=3, 5, 7 的选项：\n";
echo htmlspecialchars($result);


echo "\n示例 3-3: 配合 checkbox 使用\n";
echo "代码: \$str = \"<label><input type='checkbox' value='\\\$id' \\\$selected> \\\$spacer\\\$name</label><br>\\n\";\n\n";
$tree->ret = '';
$str = "<label><input type='checkbox' value='\$id' \$selected> \$spacer\$name</label><br>\n";
$result = $tree->get_tree(0, $str, [1, 3, 5]);
echo "生成的 HTML（在浏览器中查看）：\n";
echo $result;


// ========================================
// 参数5: $str_group - 分组模板
// ========================================
echo "\n\n【参数5】\$str_group - 为顶级分类使用不同的模板\n";
echo "============================================\n\n";

echo "示例 5-1: 顶级分类加粗显示\n";
echo "代码:\n";
echo "  \$str = \"<option value='\\\$id'>&nbsp;&nbsp;\\\$spacer\\\$name</option>\\n\";\n";
echo "  \$str_group = \"<option value='\\\$id' style='font-weight:bold'>\\\$name</option>\\n\";\n";
echo "  \$tree->get_tree(0, \$str, 0, '', \$str_group);\n\n";

$tree->ret = '';
$str = "<option value='\$id'>&nbsp;&nbsp;\$spacer\$name</option>\n";
$str_group = "<option value='\$id' style='font-weight:bold'>\$name</option>\n";
$result = $tree->get_tree(0, $str, 0, '', $str_group);

echo "生成的 HTML：\n";
echo "<select style='width:300px; font-family:monospace;'>\n";
echo $result;
echo "</select>\n\n";
echo htmlspecialchars($result);


echo "\n示例 5-2: 顶级分类添加背景色\n";
$tree->ret = '';
$str = "<option value='\$id'>&nbsp;&nbsp;\$spacer\$name</option>\n";
$str_group = "<option value='\$id' style='background-color:#f0f0f0; font-weight:bold'>\$name</option>\n";
$result = $tree->get_tree(0, $str, 0, '', $str_group);

echo "代码同上，只是修改了样式\n";
echo "生成的 HTML：\n";
echo "<select style='width:300px; font-family:monospace;'>\n";
echo $result;
echo "</select>\n";


// ========================================
// 综合示例
// ========================================
echo "\n\n【综合示例】组合使用多个参数\n";
echo "============================================\n\n";

echo "场景：生成一个分类选择器，当前选中 id=5，顶级分类加粗\n\n";

$tree->ret = '';
$str = "<option value='\$id' \$selected>\$spacer\$icon \$name</option>\n";
$str_group = "<option value='\$id' \$selected style='font-weight:bold'>\$icon \$name [顶级]</option>\n";
$current_category = 5;
$result = $tree->get_tree(0, $str, $current_category, '', $str_group);

echo "代码：\n";
echo "  \$str = \"<option value='\\\$id' \\\$selected>\\\$spacer\\\$icon \\\$name</option>\\n\";\n";
echo "  \$str_group = \"<option value='\\\$id' \\\$selected style='font-weight:bold'>\\\$icon \\\$name [顶级]</option>\\n\";\n";
echo "  \$tree->get_tree(0, \$str, 5, '', \$str_group);\n\n";

echo "生成的效果：\n";
echo "<select name='category' style='width:400px; font-family:monospace;'>\n";
echo "<option value=''>请选择分类</option>\n";
echo $result;
echo "</select>\n";


// ========================================
// 缩进符号自定义
// ========================================
echo "\n\n【高级技巧】自定义缩进符号\n";
echo "============================================\n\n";

echo "示例：使用自定义符号\n";
echo "代码：\n";
echo "  \$tree->icon = ['|', '+--', '`--'];\n";
echo "  \$tree->nbsp = '  ';\n\n";

$tree->ret = '';
$tree->icon = ['|', '+--', '`--'];
$tree->nbsp = '  ';
$result = $tree->get_tree(0, "\$spacer\$name\n");
echo $result;


// ========================================
// 总结
// ========================================
echo "\n\n=====================================\n";
echo "   get_tree() 方法总结\n";
echo "=====================================\n\n";

echo "方法签名：\n";
echo "  public function get_tree(\$myid, \$str, \$sid = 0, \$adds = '', \$str_group = '')\n\n";

echo "参数说明：\n";
echo "  \$myid      - 起始节点ID（0=从根开始）\n";
echo "  \$str       - 模板字符串（必需，定义输出格式）\n";
echo "  \$sid       - 选中的节点ID（可选，单个或数组）\n";
echo "  \$adds      - 内部使用，外部调用时留空\n";
echo "  \$str_group - 顶级分类的模板（可选）\n\n";

echo "模板变量：\n";
echo "  \$id        - 节点ID\n";
echo "  \$parentid  - 父节点ID\n";
echo "  \$name      - 节点名称\n";
echo "  \$spacer    - 自动生成的缩进符号\n";
echo "  \$selected  - 选中状态（'selected' 或 ''）\n";
echo "  其他字段    - 数组中的任何字段都可以使用\n\n";

echo "使用技巧：\n";
echo "  1. 每次调用前重置 \$tree->ret = ''\n";
echo "  2. 模板字符串中的变量要用 \\\$ 转义\n";
echo "  3. 可以在模板中使用 HTML 标签\n";
echo "  4. 通过 \$tree->icon 自定义缩进符号\n";
echo "  5. 通过 \$str_group 为顶级分类设置特殊样式\n\n";

echo "下一步：查看 example3_step_by_step.php 了解执行过程\n\n";
?>

