<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">🚀 实际应用示例</h2>";
echo "<div class=\"test-content\">";

echo "<h3>1. 导航菜单生成</h3>";
echo "<div class=\"code-block\">// 生成网站导航菜单
\$html = \$tree->get_tree(0, '&lt;li&gt;&lt;a href=\"#\"&gt;\$icon \$spacer\$name&lt;/a&gt;&lt;/li&gt;');
echo '&lt;ul class=\"nav-menu\"&gt;' . \$html . '&lt;/ul&gt;';</div>";
echo "<div class=\"result-block\">";
$tree->ret = '';
$navHtml = $tree->get_tree(0, '<li style="list-style: none; margin: 5px 0;"><a href="#" style="text-decoration: none; color: #333; display: block; padding: 8px;">\$icon \$spacer\$name</a></li>');
echo "<ul style=\"padding: 0; margin: 0;\">" . $navHtml . "</ul>";
echo "</div>";

echo "<h3>2. 下拉选择框</h3>";
echo "<div class=\"code-block\">// 生成分类选择下拉框
\$options = \$tree->get_tree(0, '&lt;option value=\"\$id\"&gt;\$spacer\$name&lt;/option&gt;');
echo '&lt;select&gt;' . \$options . '&lt;/select&gt;';</div>";
echo "<div class=\"result-block\">";
$tree->ret = '';
$options = $tree->get_tree(0, '<option value="\$id">\$spacer\$name</option>');
echo "<select style=\"width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;\">";
echo "<option value=\"\">请选择分类...</option>";
echo $options;
echo "</select>";
echo "</div>";

echo "<h3>3. 后台管理菜单</h3>";
echo "<div class=\"code-block\">// 生成后台管理左侧菜单
\$tree->get_treeview(0, 'admin-menu', 
    '&lt;span class=\"menu-item\"&gt;\$icon \$name&lt;/span&gt;',
    '&lt;span class=\"menu-folder\"&gt;\$icon \$name&lt;/span&gt;'
);</div>";
echo "<div class=\"result-block\">";
$tree->str = '';
$adminMenu = $tree->get_treeview(0, 'admin-menu',
    '<span style="padding: 5px 10px; display: block; color: #666;">\$icon \$name</span>',
    '<span style="padding: 5px 10px; display: block; font-weight: bold; color: #333; cursor: pointer;">\$icon \$name</span>'
);
echo "<div style=\"border: 1px solid #ddd; border-radius: 4px; max-height: 300px; overflow-y: auto;\">";
echo $adminMenu;
echo "</div>";
echo "</div>";

echo "<h3>4. 面包屑导航</h3>";
echo "<div class=\"code-block\">// 生成面包屑导航
\$path = array();
\$positions = \$tree->get_pos(5, \$path);
foreach(\$positions as \$pos) {
    echo \$pos['name'] . ' &raquo; ';
}</div>";
echo "<div class=\"result-block\">";
$path = array();
$positions = $tree->get_pos(5, $path);
echo "<nav style=\"padding: 10px; background: #f8f9fa; border-radius: 4px;\">";
echo "<span style=\"color: #666;\">当前位置：</span>";
foreach($positions as $pos) {
    echo "<a href=\"#\" style=\"color: #007bff; text-decoration: none; margin: 0 5px;\">{$pos['icon']} {$pos['name']}</a>";
    if(end($positions) !== $pos) echo " <span style=\"color: #6c757d;\">›</span> ";
}
echo "</nav>";
echo "</div>";

echo "</div></div>";
?>