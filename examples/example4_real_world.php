<?php
/**
 * 示例4：Tree 类实际应用案例
 * 
 * 这个示例展示：
 * 1. 电商网站商品分类
 * 2. 网站导航菜单
 * 3. 权限管理系统
 * 4. 评论回复系统
 * 5. 组织架构图
 */

require_once dirname(__DIR__) . '/tree.class.php';

echo "<!DOCTYPE html>\n";
echo "<html>\n";
echo "<head>\n";
echo "    <meta charset='UTF-8'>\n";
echo "    <title>Tree 类实际应用案例</title>\n";
echo "    <style>\n";
echo "        body { font-family: Arial, sans-serif; max-width: 1200px; margin: 20px auto; padding: 0 20px; }\n";
echo "        h1 { color: #333; border-bottom: 3px solid #4CAF50; padding-bottom: 10px; }\n";
echo "        h2 { color: #4CAF50; margin-top: 40px; }\n";
echo "        .case { background: #f9f9f9; padding: 20px; margin: 20px 0; border-radius: 5px; }\n";
echo "        .code { background: #2d2d2d; color: #f8f8f2; padding: 15px; border-radius: 5px; overflow-x: auto; margin: 10px 0; }\n";
echo "        .result { background: white; padding: 15px; border: 1px solid #ddd; border-radius: 5px; margin: 10px 0; }\n";
echo "        select { width: 100%; max-width: 500px; padding: 8px; font-size: 14px; }\n";
echo "        .menu { list-style: none; padding: 0; }\n";
echo "        .menu li { padding: 5px 0; }\n";
echo "        .menu a { text-decoration: none; color: #333; }\n";
echo "        .menu a:hover { color: #4CAF50; }\n";
echo "        .permission-list label { display: block; padding: 5px 0; }\n";
echo "        .comment { margin-left: 0; padding: 10px; border-left: 3px solid #ddd; }\n";
echo "        .comment.reply { margin-left: 40px; border-left-color: #4CAF50; }\n";
echo "        .org-chart { font-family: 'Courier New', monospace; }\n";
echo "    </style>\n";
echo "</head>\n";
echo "<body>\n";

echo "<h1>Tree 类实际应用案例</h1>\n";
echo "<p>以下展示 Tree 类在真实项目中的各种应用场景</p>\n";


// ========================================
// 案例1：电商网站商品分类
// ========================================
echo "<div class='case'>\n";
echo "<h2>案例1：电商网站商品分类选择器</h2>\n";
echo "<p><strong>场景</strong>：在添加/编辑商品时，需要选择商品所属分类</p>\n";

$product_categories = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '电子产品'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '服装鞋包'],
    3 => ['id' => 3, 'parentid' => 0, 'name' => '图书音像'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '手机通讯'],
    5 => ['id' => 5, 'parentid' => 1, 'name' => '电脑办公'],
    6 => ['id' => 6, 'parentid' => 1, 'name' => '数码配件'],
    7 => ['id' => 7, 'parentid' => 4, 'name' => '智能手机'],
    8 => ['id' => 8, 'parentid' => 4, 'name' => '老人机'],
    9 => ['id' => 9, 'parentid' => 5, 'name' => '笔记本电脑'],
    10 => ['id' => 10, 'parentid' => 5, 'name' => '台式机'],
    11 => ['id' => 11, 'parentid' => 2, 'name' => '男装'],
    12 => ['id' => 12, 'parentid' => 2, 'name' => '女装'],
    13 => ['id' => 13, 'parentid' => 2, 'name' => '童装'],
    14 => ['id' => 14, 'parentid' => 3, 'name' => '小说'],
    15 => ['id' => 15, 'parentid' => 3, 'name' => '教材'],
];

$tree = new tree();
$tree->init($product_categories);

echo "<div class='code'>";
echo htmlspecialchars('$str = "<option value=\'$id\' $selected>$spacer$name</option>\n";
$str_group = "<option value=\'$id\' $selected style=\'font-weight:bold\'>【$name】</option>\n";
$current_category = 7; // 假设当前商品属于"智能手机"分类
$html = $tree->get_tree(0, $str, $current_category, \'\', $str_group);');
echo "</div>\n";

echo "<div class='result'>\n";
echo "<label><strong>选择商品分类：</strong></label><br>\n";
echo "<select name='category_id'>\n";
echo "<option value=''>请选择分类</option>\n";

$tree->ret = '';
$str = "<option value='\$id' \$selected>\$spacer\$name</option>\n";
$str_group = "<option value='\$id' \$selected style='font-weight:bold'>【\$name】</option>\n";
$current_category = 7;
echo $tree->get_tree(0, $str, $current_category, '', $str_group);

echo "</select>\n";
echo "<p style='color: #666; font-size: 12px;'>当前选中：智能手机 (id=7)</p>\n";
echo "</div>\n";
echo "</div>\n";


// ========================================
// 案例2：网站导航菜单
// ========================================
echo "<div class='case'>\n";
echo "<h2>案例2：网站后台导航菜单</h2>\n";
echo "<p><strong>场景</strong>：生成后台管理系统的左侧导航菜单</p>\n";

$admin_menu = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '系统管理', 'url' => '#', 'icon' => '⚙️'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '内容管理', 'url' => '#', 'icon' => '📝'],
    3 => ['id' => 3, 'parentid' => 0, 'name' => '用户管理', 'url' => '#', 'icon' => '👥'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '系统设置', 'url' => '/admin/settings', 'icon' => ''],
    5 => ['id' => 5, 'parentid' => 1, 'name' => '菜单管理', 'url' => '/admin/menu', 'icon' => ''],
    6 => ['id' => 6, 'parentid' => 1, 'name' => '日志查看', 'url' => '/admin/logs', 'icon' => ''],
    7 => ['id' => 7, 'parentid' => 2, 'name' => '文章管理', 'url' => '/admin/articles', 'icon' => ''],
    8 => ['id' => 8, 'parentid' => 2, 'name' => '分类管理', 'url' => '/admin/categories', 'icon' => ''],
    9 => ['id' => 9, 'parentid' => 3, 'name' => '用户列表', 'url' => '/admin/users', 'icon' => ''],
    10 => ['id' => 10, 'parentid' => 3, 'name' => '角色权限', 'url' => '/admin/roles', 'icon' => ''],
];

$tree2 = new tree();
$tree2->init($admin_menu);

echo "<div class='code'>";
echo htmlspecialchars('$str = "<li><a href=\'$url\'>$spacer$name</a></li>\n";
$str_group = "<li style=\'font-weight:bold; margin-top:10px;\'><a href=\'$url\'>$icon $name</a></li>\n";
$html = $tree->get_tree(0, $str, 0, \'\', $str_group);');
echo "</div>\n";

echo "<div class='result'>\n";
echo "<ul class='menu'>\n";

$tree2->ret = '';
$str = "<li><a href='\$url'>\$spacer\$name</a></li>\n";
$str_group = "<li style='font-weight:bold; margin-top:10px;'><a href='\$url'>\$icon \$name</a></li>\n";
echo $tree2->get_tree(0, $str, 0, '', $str_group);

echo "</ul>\n";
echo "</div>\n";
echo "</div>\n";


// ========================================
// 案例3：权限管理系统
// ========================================
echo "<div class='case'>\n";
echo "<h2>案例3：角色权限分配</h2>\n";
echo "<p><strong>场景</strong>：在编辑角色时，分配该角色拥有的权限</p>\n";

$permissions = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '系统管理'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '内容管理'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => '用户管理'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '角色管理'],
    5 => ['id' => 5, 'parentid' => 3, 'name' => '查看用户'],
    6 => ['id' => 6, 'parentid' => 3, 'name' => '添加用户'],
    7 => ['id' => 7, 'parentid' => 3, 'name' => '编辑用户'],
    8 => ['id' => 8, 'parentid' => 3, 'name' => '删除用户'],
    9 => ['id' => 9, 'parentid' => 2, 'name' => '文章管理'],
    10 => ['id' => 10, 'parentid' => 9, 'name' => '发布文章'],
    11 => ['id' => 11, 'parentid' => 9, 'name' => '编辑文章'],
];

$tree3 = new tree();
$tree3->init($permissions);

// 假设该角色已经拥有的权限
$role_permissions = [5, 6, 7, 10];

echo "<div class='code'>";
echo htmlspecialchars('$str = "<label><input type=\'checkbox\' name=\'permissions[]\' value=\'$id\' $selected> $spacer$name</label><br>\n";
$current_permissions = [5, 6, 7, 10]; // 当前角色已有的权限
$html = $tree->get_tree(0, $str, $current_permissions);');
echo "</div>\n";

echo "<div class='result'>\n";
echo "<form>\n";
echo "<div class='permission-list'>\n";

$tree3->ret = '';
$str = "<label><input type='checkbox' name='permissions[]' value='\$id' \$selected> \$spacer\$name</label><br>\n";
// 将 selected 转换为 checked
$str = str_replace('selected', 'checked', $str);
echo $tree3->get_tree(0, $str, $role_permissions);

echo "</div>\n";
echo "<button type='submit' style='margin-top: 15px; padding: 8px 20px; background: #4CAF50; color: white; border: none; border-radius: 3px; cursor: pointer;'>保存权限</button>\n";
echo "</form>\n";
echo "</div>\n";
echo "</div>\n";


// ========================================
// 案例4：评论回复系统
// ========================================
echo "<div class='case'>\n";
echo "<h2>案例4：文章评论回复系统</h2>\n";
echo "<p><strong>场景</strong>：显示文章评论及其回复（树形结构）</p>\n";

$comments = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '张三', 'content' => '这篇文章写得很好！', 'time' => '2025-10-01 10:00'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '李四', 'content' => '学到了很多知识，感谢分享', 'time' => '2025-10-01 11:00'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => '作者', 'content' => '谢谢支持！', 'time' => '2025-10-01 10:30'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '王五', 'content' => '同意楼主观点', 'time' => '2025-10-01 11:30'],
    5 => ['id' => 5, 'parentid' => 3, 'name' => '张三', 'content' => '期待更多精彩内容', 'time' => '2025-10-01 12:00'],
    6 => ['id' => 6, 'parentid' => 2, 'name' => '赵六', 'content' => '我也觉得很棒', 'time' => '2025-10-01 12:30'],
];

$tree4 = new tree();
$tree4->init($comments);

echo "<div class='code'>";
echo htmlspecialchars('$str = "<div class=\'comment reply\'>
    <strong>$name</strong> <span style=\'color:#999; font-size:12px;\'>$time</span>
    <p>$content</p>
</div>\n";
$str_group = "<div class=\'comment\'>
    <strong>$name</strong> <span style=\'color:#999; font-size:12px;\'>$time</span>
    <p>$content</p>
</div>\n";');
echo "</div>\n";

echo "<div class='result'>\n";

$tree4->ret = '';
$str = "<div class='comment reply'>
    <strong>\$name</strong> <span style='color:#999; font-size:12px;'>\$time</span>
    <p>\$content</p>
</div>\n";
$str_group = "<div class='comment'>
    <strong>\$name</strong> <span style='color:#999; font-size:12px;'>\$time</span>
    <p>\$content</p>
</div>\n";
echo $tree4->get_tree(0, $str, 0, '', $str_group);

echo "</div>\n";
echo "</div>\n";


// ========================================
// 案例5：组织架构图
// ========================================
echo "<div class='case'>\n";
echo "<h2>案例5：公司组织架构图</h2>\n";
echo "<p><strong>场景</strong>：显示公司的组织架构</p>\n";

$organization = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => 'CEO - 张总', 'position' => '首席执行官'],
    2 => ['id' => 2, 'parentid' => 1, 'name' => '技术部 - 李经理', 'position' => '技术总监'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => '市场部 - 王经理', 'position' => '市场总监'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '财务部 - 赵经理', 'position' => '财务总监'],
    5 => ['id' => 5, 'parentid' => 2, 'name' => '开发组 - 小李', 'position' => '开发组长'],
    6 => ['id' => 6, 'parentid' => 2, 'name' => '测试组 - 小王', 'position' => '测试组长'],
    7 => ['id' => 7, 'parentid' => 5, 'name' => '前端工程师 - 小张', 'position' => '高级工程师'],
    8 => ['id' => 8, 'parentid' => 5, 'name' => '后端工程师 - 小刘', 'position' => '高级工程师'],
    9 => ['id' => 9, 'parentid' => 3, 'name' => '推广专员 - 小周', 'position' => '推广专员'],
];

$tree5 = new tree();
$tree5->init($organization);
$tree5->icon = ['│', '├─', '└─'];
$tree5->nbsp = '──';

echo "<div class='code'>";
echo htmlspecialchars('$tree->icon = [\'│\', \'├─\', \'└─\'];
$tree->nbsp = \'──\';
$str = "$spacer $name ($position)\n";');
echo "</div>\n";

echo "<div class='result org-chart'>\n";
echo "<pre style='font-family: \"Courier New\", monospace; line-height: 1.8;'>\n";

$tree5->ret = '';
$str = "\$spacer \$name (\$position)\n";
echo $tree5->get_tree(0, $str);

echo "</pre>\n";
echo "</div>\n";
echo "</div>\n";


// ========================================
// 总结
// ========================================
echo "<div class='case' style='background: #e8f5e9;'>\n";
echo "<h2>应用场景总结</h2>\n";
echo "<table style='width: 100%; border-collapse: collapse;'>\n";
echo "<tr style='background: #4CAF50; color: white;'>\n";
echo "    <th style='padding: 10px; text-align: left;'>场景</th>\n";
echo "    <th style='padding: 10px; text-align: left;'>适用情况</th>\n";
echo "    <th style='padding: 10px; text-align: left;'>关键特性</th>\n";
echo "</tr>\n";

$cases = [
    ['商品分类', '电商、CMS系统', '多级分类、选中状态'],
    ['导航菜单', '后台管理系统', '层级菜单、图标支持'],
    ['权限管理', '用户权限系统', '多选、树形权限'],
    ['评论回复', '社区、博客', '无限层级回复'],
    ['组织架构', '企业管理系统', '人员层级关系'],
];

foreach ($cases as $i => $case) {
    $bg = $i % 2 == 0 ? '#f1f8e9' : 'white';
    echo "<tr style='background: {$bg};'>\n";
    echo "    <td style='padding: 10px;'>{$case[0]}</td>\n";
    echo "    <td style='padding: 10px;'>{$case[1]}</td>\n";
    echo "    <td style='padding: 10px;'>{$case[2]}</td>\n";
    echo "</tr>\n";
}

echo "</table>\n";
echo "</div>\n";


echo "<div style='margin: 40px 0; padding: 20px; background: #fff3cd; border-left: 4px solid #ffc107;'>\n";
echo "<h3 style='margin-top: 0;'>💡 开发建议</h3>\n";
echo "<ol>\n";
echo "<li>在实际项目中，通常从数据库查询分类数据，然后传给 Tree 类</li>\n";
echo "<li>可以将生成的 HTML 缓存起来，避免每次都重新生成</li>\n";
echo "<li>对于大量数据，考虑使用 AJAX 延迟加载子节点</li>\n";
echo "<li>可以结合 JavaScript 插件（如 zTree、jsTree）实现更丰富的交互效果</li>\n";
echo "<li>建议在数组中添加 'sort' 字段，用于控制节点的排序</li>\n";
echo "</ol>\n";
echo "</div>\n";

echo "</body>\n";
echo "</html>\n";
?>

