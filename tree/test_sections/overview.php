<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">📊 数据概览</h2>";
echo "<div class=\"test-content\">";

echo "<h3>测试数据结构</h3>";
echo "<table class=\"data-table\">";
echo "<tr><th>ID</th><th>父级ID</th><th>名称</th><th>图标</th></tr>";
foreach($testData as $id => $item) {
    echo "<tr><td>{$id}</td><td>{$item['parentid']}</td><td>{$item['name']}</td><td>{$item['icon']}</td></tr>";
}
echo "</table>";

echo "<div class=\"stats-grid\">";
echo "<div class=\"stat-card\"><div class=\"stat-number\">" . count($testData) . "</div><div class=\"stat-label\">总节点数</div></div>";

$rootCount = count($tree->get_child(0));
echo "<div class=\"stat-card\"><div class=\"stat-number\">{$rootCount}</div><div class=\"stat-label\">根节点数</div></div>";

$maxDepth = 0;
foreach($testData as $item) {
    $path = array();
    $positions = $tree->get_pos($item['id'], $path);
    $depth = count($positions);
    if($depth > $maxDepth) $maxDepth = $depth;
}
echo "<div class=\"stat-card\"><div class=\"stat-number\">{$maxDepth}</div><div class=\"stat-label\">最大深度</div></div>";

echo "<div class=\"stat-card\"><div class=\"stat-number\">10</div><div class=\"stat-label\">功能方法</div></div>";
echo "</div>";

echo "<h3>🎯 主要特性</h3>";
echo "<ul class=\"feature-list\">";
echo "<li>支持无限层级的树型结构处理</li>";
echo "<li>灵活的模板机制，可生成任意HTML格式</li>";
echo "<li>高效的递归算法，O(n)时间复杂度</li>";
echo "<li>支持多种输出格式（HTML、TreeView、JSON）</li>";
echo "<li>内置选中状态管理和图标系统</li>";
echo "<li>兼容jQuery TreeView插件</li>";
echo "</ul>";

echo "</div></div>";
?>