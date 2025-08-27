<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">🌳 树型结构生成测试</h2>";
echo "<div class=\"test-content\">";

echo "<h3>1. get_tree() - 简单列表格式</h3>";
echo "<div class=\"code-block\">\$tree->get_tree(0, '\$icon \$spacer\$name'); // 生成带图标的树型列表</div>";
echo "<div class=\"result-block\">";
$tree->ret = '';
$result = $tree->get_tree(0, '\$icon \$spacer\$name' . PHP_EOL);
echo "<div class=\"tree-display\">" . htmlspecialchars($result) . "</div>";
echo "</div>";

echo "<h3>2. TreeView格式</h3>";
echo "<div class=\"code-block\">\$tree->get_treeview(0, 'demo', '叶子节点模板', '分支节点模板');</div>";
echo "<div class=\"result-block\">";
$tree->str = '';
$treeview = $tree->get_treeview(0, 'demo', 
    '<span class="file">\$icon \$name</span>', 
    '<span class="folder">\$icon \$name</span>'
);
echo $treeview;
echo "</div>";

echo "<h3>3. 自定义HTML格式</h3>";
echo "<div class=\"code-block\">\$tree->get_tree(0, '&lt;div class=\"menu-item\"&gt;\$icon \$spacer\$name&lt;/div&gt;');</div>";
echo "<div class=\"result-block\">";
$tree->ret = '';
$result = $tree->get_tree(0, '<div class="menu-item" style="padding-left: 20px; margin: 5px 0; border-left: 2px solid #ddd;">\$icon \$spacer\$name</div>');
echo $result;
echo "</div>";

echo "</div></div>";
?>