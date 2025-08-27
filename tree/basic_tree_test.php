<?php
/**
 * Tree类基础功能测试
 * 避免复杂的模板语法
 */

require_once 'yzmphp/core/class/tree.class.php';

// 测试数据
$data = array(
    1 => array('id'=>'1','parentid'=>0,'name'=>'根目录'),
    2 => array('id'=>'2','parentid'=>0,'name'=>'系统管理'),
    3 => array('id'=>'3','parentid'=>1,'name'=>'用户管理'),
    4 => array('id'=>'4','parentid'=>1,'name'=>'权限管理'),
    5 => array('id'=>'5','parentid'=>2,'name'=>'系统设置'),
    6 => array('id'=>'6','parentid'=>3,'name'=>'添加用户'),
    7 => array('id'=>'7','parentid'=>3,'name'=>'编辑用户')
);

$tree = new tree();
$tree->init($data);

echo "Tree类功能测试\n";
echo "================\n\n";

echo "1. 测试数据:\n";
foreach($data as $id => $item) {
    echo "  ID:{$id} => parentid:{$item['parentid']}, name:{$item['name']}\n";
}
echo "\n";

echo "2. get_child() 测试:\n";
echo "  根级节点 (parentid=0):\n";
$children = $tree->get_child(0);
foreach($children as $id => $child) {
    echo "    ID:{$id} - {$child['name']}\n";
}

echo "\n  ID=1的子级:\n";
$children = $tree->get_child(1);
if($children) {
    foreach($children as $id => $child) {
        echo "    ID:{$id} - {$child['name']}\n";
    }
} else {
    echo "    无子级\n";
}

echo "\n3. get_pos() 测试:\n";
$path = array();
$positions = $tree->get_pos(6, $path);
echo "  ID=6的完整路径: ";
foreach($positions as $pos) {
    echo $pos['name'] . " -> ";
}
echo "结束\n";

echo "\n4. get_tree() 测试:\n";
echo "  生成简单列表:\n";
$tree->ret = '';
$result = $tree->get_tree(0, '$spacer$name' . "\n");
echo $result;

echo "\n5. TreeView测试:\n";
$tree->str = '';
$treeview = $tree->get_treeview(0, 'demo', '$name', '$name');
echo "  生成的TreeView HTML (部分):\n";
echo "  " . substr(strip_tags($treeview), 0, 100) . "...\n";

echo "\n6. 性能测试:\n";
$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    $tree->ret = '';
    $tree->get_tree(0, '$name');
}
$end = microtime(true);
echo "  执行100次get_tree()耗时: " . round(($end - $start) * 1000, 2) . " ms\n";

echo "\n7. have() 方法测试:\n";
$reflection = new ReflectionClass($tree);
$haveMethod = $reflection->getMethod('have');
$haveMethod->setAccessible(true);

$test1 = $haveMethod->invoke($tree, array(1,3,5), 3);
$test2 = $haveMethod->invoke($tree, array(1,3,5), 4);
$test3 = $haveMethod->invoke($tree, '1,3,5', '3');

echo "  have([1,3,5], 3) = " . ($test1 ? 'true' : 'false') . "\n";
echo "  have([1,3,5], 4) = " . ($test2 ? 'true' : 'false') . "\n";
echo "  have('1,3,5', '3') = " . ($test3 ? 'true' : 'false') . "\n";

echo "\n测试完成!\n";
?>
