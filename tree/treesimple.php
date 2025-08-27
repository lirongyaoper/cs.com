<?php
/**
 * 简化的 tree.class.php 测试文件
 * 避免模板字符串的转义问题
 */

// 引入tree类
require_once 'yzmphp/core/class/tree.class.php';

// 创建测试数据
function getTestData() {
    return array(
        1 => array('id'=>'1','parentid'=>0,'name'=>'根目录','url'=>'/root/'),
        2 => array('id'=>'2','parentid'=>0,'name'=>'系统管理','url'=>'/system/'),
        3 => array('id'=>'3','parentid'=>1,'name'=>'用户管理','url'=>'/root/user/'),
        4 => array('id'=>'4','parentid'=>1,'name'=>'权限管理','url'=>'/root/auth/'),
        5 => array('id'=>'5','parentid'=>2,'name'=>'系统设置','url'=>'/system/config/'),
        6 => array('id'=>'6','parentid'=>3,'name'=>'添加用户','url'=>'/root/user/add/'),
        7 => array('id'=>'7','parentid'=>3,'name'=>'编辑用户','url'=>'/root/user/edit/')
    );
}

echo "<!DOCTYPE html>\n";
echo "<html><head><meta charset='UTF-8'><title>Tree类测试</title></head><body>\n";
echo "<h1>Tree类测试结果</h1>\n";

// 初始化
$tree = new tree();
$data = getTestData();
$tree->init($data);

echo "<h2>1. 测试数据</h2>\n";
echo "<pre>\n";
foreach($data as $id => $item) {
    echo "ID:{$id} => parentid:{$item['parentid']}, name:{$item['name']}\n";
}
echo "</pre>\n";

echo "<h2>2. 基础方法测试</h2>\n";

echo "<h3>get_child(0) - 获取根级节点</h3>\n";
$children = $tree->get_child(0);
echo "<ul>\n";
foreach($children as $id => $child) {
    echo "<li>ID:{$id} - {$child['name']}</li>\n";
}
echo "</ul>\n";

echo "<h3>get_child(1) - 获取ID=1的子级</h3>\n";
$children = $tree->get_child(1);
if($children) {
    echo "<ul>\n";
    foreach($children as $id => $child) {
        echo "<li>ID:{$id} - {$child['name']}</li>\n";
    }
    echo "</ul>\n";
} else {
    echo "<p>无子级</p>\n";
}

echo "<h3>get_pos() - 获取路径</h3>\n";
$path = array();
$positions = $tree->get_pos(6, $path);
echo "<p>ID=6的路径：";
foreach($positions as $pos) {
    echo $pos['name'] . " → ";
}
echo "</p>\n";

echo "<h2>3. 树型结构测试</h2>\n";

echo "<h3>简单的HTML列表</h3>\n";
$tree->ret = '';
// 使用简单的模板避免转义问题
$template = '<li>$spacer$name</li>';
$result = $tree->get_tree(0, $template);
echo "<ul style='list-style: none;'>\n";
echo $result;
echo "</ul>\n";

echo "<h3>带值的HTML列表</h3>\n";
$tree->ret = '';
$template = '<li>$spacer$name (ID:$id)</li>';
$result = $tree->get_tree(0, $template);
echo "<ul style='list-style: none;'>\n";
echo $result;
echo "</ul>\n";

echo "<h3>TreeView格式测试</h3>\n";
$tree->str = '';
$treeview = $tree->get_treeview(0, 'demo', '<span>📄 $name</span>', '<span>📁 $name</span>');
echo $treeview;

echo "<h2>4. 性能测试</h2>\n";
$start = microtime(true);
$tree->ret = '';
$result = $tree->get_tree(0, '<option value="'.'$id'.'">$spacer$name</option>');
$end = microtime(true);

echo "<p>执行时间：" . round(($end - $start) * 1000, 3) . " ms</p>\n";
echo "<p>数据节点数：" . count($data) . "</p>\n";
echo "<p>生成HTML长度：" . strlen($result) . " 字符</p>\n";

echo "<h2>5. 生成的下拉菜单HTML</h2>\n";
echo "<select>\n";
echo "<option value=''>请选择...</option>\n";
echo $result;
echo "</select>\n";

echo "<h2>6. 原始HTML代码</h2>\n";
echo "<textarea rows='10' cols='80'>\n";
echo htmlspecialchars($result);
echo "</textarea>\n";

echo "</body></html>\n";
?>
