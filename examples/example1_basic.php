<?php
/**
 * 示例1：Tree 类基础使用
 * 
 * 这个示例展示：
 * 1. 如何实例化 Tree 类
 * 2. 如何初始化数据
 * 3. Tree 类的基本方法
 * 4. 简单的 get_tree() 使用
 */

// 引入 Tree 类
require_once dirname(__DIR__) . '/tree.class.php';

echo "=====================================\n";
echo "   Tree 类基础使用示例\n";
echo "=====================================\n\n";

// ========================================
// 第一步：准备数据
// ========================================
echo "【第一步】准备树形数据\n";
echo "-------------------------------------\n";

$categories = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '电子产品'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '图书'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => '手机'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '电脑'],
    5 => ['id' => 5, 'parentid' => 3, 'name' => '苹果手机'],
    6 => ['id' => 6, 'parentid' => 3, 'name' => '安卓手机'],
    7 => ['id' => 7, 'parentid' => 2, 'name' => '小说'],
    8 => ['id' => 8, 'parentid' => 2, 'name' => '教材'],
    9 => ['id' => 9, 'parentid' => 7, 'name' => '科幻小说'],
];

echo "原始数据结构（扁平数组）：\n";
print_r($categories);

echo "\n这些数据的树形关系：\n";
echo "电子产品 (id=1, parentid=0)\n";
echo "├── 手机 (id=3, parentid=1)\n";
echo "│   ├── 苹果手机 (id=5, parentid=3)\n";
echo "│   └── 安卓手机 (id=6, parentid=3)\n";
echo "└── 电脑 (id=4, parentid=1)\n";
echo "图书 (id=2, parentid=0)\n";
echo "├── 小说 (id=7, parentid=2)\n";
echo "│   └── 科幻小说 (id=9, parentid=7)\n";
echo "└── 教材 (id=8, parentid=2)\n\n";


// ========================================
// 第二步：实例化并初始化 Tree 类
// ========================================
echo "【第二步】实例化 Tree 类\n";
echo "-------------------------------------\n";

$tree = new tree();
echo "✓ 已创建 Tree 对象\n\n";

echo "初始化数据到 Tree 对象：\n";
$result = $tree->init($categories);
if ($result) {
    echo "✓ 数据初始化成功\n\n";
} else {
    echo "✗ 数据初始化失败\n\n";
}


// ========================================
// 第三步：使用 get_child() 方法
// ========================================
echo "【第三步】使用 get_child() 获取子节点\n";
echo "-------------------------------------\n";

echo "获取 id=0 的子节点（即顶级分类）：\n";
$children = $tree->get_child(0);
print_r($children);

echo "\n获取 id=1 (电子产品) 的子节点：\n";
$children = $tree->get_child(1);
print_r($children);

echo "\n获取 id=3 (手机) 的子节点：\n";
$children = $tree->get_child(3);
print_r($children);

echo "\n获取 id=5 (苹果手机) 的子节点：\n";
$children = $tree->get_child(5);
if ($children === false) {
    echo "该节点没有子节点（叶子节点）\n";
}


// ========================================
// 第四步：使用 get_tree() 生成树形结构
// ========================================
echo "\n\n【第四步】使用 get_tree() 生成树形结构\n";
echo "-------------------------------------\n";

// 4.1 最简单的用法：纯文本输出
echo "4.1 纯文本输出：\n\n";
$tree->ret = '';  // 重置结果
$str = "\$spacer\$name\n";
$result = $tree->get_tree(0, $str);
echo $result;


// 4.2 生成 HTML 下拉列表
echo "\n4.2 生成 HTML 下拉列表：\n\n";
$tree->ret = '';  // 重置结果
$str = "<option value='\$id'>\$spacer\$name</option>\n";
$result = $tree->get_tree(0, $str);
echo "<select name='category' style='width: 300px; font-family: monospace;'>\n";
echo $result;
echo "</select>\n\n";
echo "HTML 代码：\n";
echo htmlspecialchars($result);


// 4.3 生成带选中状态的下拉列表
echo "\n\n4.3 生成带选中状态的下拉列表（选中 id=5）：\n\n";
$tree->ret = '';  // 重置结果
$str = "<option value='\$id' \$selected>\$spacer\$name</option>\n";
$result = $tree->get_tree(0, $str, 5);  // 第三个参数指定选中的 id
echo "HTML 代码：\n";
echo htmlspecialchars($result);


// 4.4 只生成某个节点的子树
echo "\n\n4.4 只生成 id=1 (电子产品) 的子树：\n\n";
$tree->ret = '';  // 重置结果
$str = "\$spacer\$name\n";
$result = $tree->get_tree(1, $str);  // 第一个参数改为 1
echo $result;


// ========================================
// 第五步：使用 get_pos() 获取面包屑导航
// ========================================
echo "\n【第五步】使用 get_pos() 获取面包屑导航\n";
echo "-------------------------------------\n";

echo "获取 id=5 (苹果手机) 的位置路径：\n";
$pos = [];
$position = $tree->get_pos(5, $pos);
print_r($position);

echo "\n生成面包屑导航：\n";
$breadcrumb = [];
foreach ($position as $item) {
    $breadcrumb[] = $item['name'];
}
echo implode(' > ', $breadcrumb) . "\n";


// ========================================
// 总结
// ========================================
echo "\n\n=====================================\n";
echo "   总结\n";
echo "=====================================\n";
echo "1. Tree 类需要的数据格式：id, parentid, name 三个字段\n";
echo "2. init() 方法用于初始化数据\n";
echo "3. get_child() 获取指定节点的直接子节点\n";
echo "4. get_tree() 生成完整的树形结构（递归）\n";
echo "5. get_pos() 获取指定节点的路径（面包屑）\n";
echo "6. 使用 \$tree->ret = '' 来重置结果\n\n";

echo "下一步：查看 example2_get_tree.php 深入了解 get_tree() 方法\n\n";
?>

