<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">🔧 基础方法测试</h2>";
echo "<div class=\"test-content\">";

echo "<h3>1. get_child() - 获取子级节点</h3>";
echo "<div class=\"code-block\">\$tree->get_child(0); // 获取根级节点</div>";
echo "<div class=\"result-block\">";
$children = $tree->get_child(0);
echo "<strong>根级节点：</strong><br>";
foreach($children as $id => $child) {
    echo "{$child['icon']} ID:{$id} - {$child['name']}<br>";
}
echo "</div>";

echo "<h3>2. get_child() - 获取指定节点的子级</h3>";
echo "<div class=\"code-block\">\$tree->get_child(1); // 获取ID=1的子级</div>";
echo "<div class=\"result-block\">";
$children = $tree->get_child(1);
if($children) {
    echo "<strong>ID=1的子级：</strong><br>";
    foreach($children as $id => $child) {
        echo "{$child['icon']} ID:{$id} - {$child['name']}<br>";
    }
} else {
    echo "无子级节点";
}
echo "</div>";

echo "<h3>3. get_pos() - 获取节点路径</h3>";
echo "<div class=\"code-block\">\$tree->get_pos(5, \$path); // 获取ID=5的完整路径</div>";
echo "<div class=\"result-block\">";
$path = array();
$positions = $tree->get_pos(5, $path);
echo "<strong>ID=5的路径：</strong><br>";
foreach($positions as $pos) {
    echo "{$pos['icon']} {$pos['name']} → ";
}
echo "<br><em>（面包屑导航示例）</em>";
echo "</div>";

echo "<h3>4. get_parent() - 获取父级同级节点</h3>";
echo "<div class=\"code-block\">\$tree->get_parent(5); // 获取ID=5的父级同级节点</div>";
echo "<div class=\"result-block\">";
$parents = $tree->get_parent(5);
if($parents) {
    echo "<strong>父级同级节点：</strong><br>";
    foreach($parents as $id => $parent) {
        echo "{$parent['icon']} ID:{$id} - {$parent['name']}<br>";
    }
} else {
    echo "无父级同级节点";
}
echo "</div>";

echo "</div></div>";
?>