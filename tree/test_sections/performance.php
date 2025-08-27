<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">⚡ 性能测试</h2>";
echo "<div class=\"test-content\">";

echo "<h3>基准测试</h3>";

// 测试get_tree性能
$iterations = 1000;
$start = microtime(true);
for($i = 0; $i < $iterations; $i++) {
    $tree->ret = '';
    $tree->get_tree(0, '\$spacer\$name');
}
$end = microtime(true);
$getTreeTime = ($end - $start) * 1000;

// 测试get_child性能
$start = microtime(true);
for($i = 0; $i < $iterations; $i++) {
    $tree->get_child(0);
}
$end = microtime(true);
$getChildTime = ($end - $start) * 1000;

// 测试get_treeview性能
$start = microtime(true);
for($i = 0; $i < 100; $i++) {
    $tree->str = '';
    $tree->get_treeview(0, 'test', '\$name', '\$name');
}
$end = microtime(true);
$treeviewTime = ($end - $start) * 1000;

echo "<div class=\"stats-grid\">";
echo "<div class=\"stat-card\">";
echo "<div class=\"stat-number\">" . round($getTreeTime, 2) . "</div>";
echo "<div class=\"stat-label\">get_tree() {$iterations}次 (ms)</div>";
echo "</div>";

echo "<div class=\"stat-card\">";
echo "<div class=\"stat-number\">" . round($getChildTime, 2) . "</div>";
echo "<div class=\"stat-label\">get_child() {$iterations}次 (ms)</div>";
echo "</div>";

echo "<div class=\"stat-card\">";
echo "<div class=\"stat-number\">" . round($treeviewTime, 2) . "</div>";
echo "<div class=\"stat-label\">get_treeview() 100次 (ms)</div>";
echo "</div>";

echo "<div class=\"stat-card\">";
echo "<div class=\"stat-number\">" . round(memory_get_usage() / 1024, 1) . "</div>";
echo "<div class=\"stat-label\">内存使用 (KB)</div>";
echo "</div>";
echo "</div>";

echo "<h3>复杂度分析</h3>";
echo "<ul class=\"feature-list\">";
echo "<li><strong>get_child():</strong> O(n) - 需要遍历所有节点查找子级</li>";
echo "<li><strong>get_tree():</strong> O(n) - 每个节点访问一次</li>";
echo "<li><strong>get_pos():</strong> O(h) - h为树的高度</li>";
echo "<li><strong>空间复杂度:</strong> O(h) - 递归调用栈的深度</li>";
echo "</ul>";

echo "</div></div>";
?>