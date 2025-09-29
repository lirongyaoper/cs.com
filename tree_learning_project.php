<?php
/**
 * Tree Class 学习项目
 * 分析和演示 tree.class.php 的 get_tree() 方法
 */

// 包含树类
require_once 'tree.class.php';

// 测试数据：电商分类结构
$categories = array(
    1 => array('id' => 1, 'parentid' => 0, 'name' => '电子产品', 'description' => '各种电子设备', 'sort' => 1),
    2 => array('id' => 2, 'parentid' => 0, 'name' => '服装鞋包', 'description' => '时尚服饰', 'sort' => 2),
    3 => array('id' => 3, 'parentid' => 0, 'name' => '家居生活', 'description' => '家居用品', 'sort' => 3),
    4 => array('id' => 4, 'parentid' => 1, 'name' => '手机', 'description' => '智能手机', 'sort' => 1),
    5 => array('id' => 5, 'parentid' => 1, 'name' => '电脑', 'description' => '笔记本电脑', 'sort' => 2),
    6 => array('id' => 6, 'parentid' => 1, 'name' => '平板', 'description' => '平板电脑', 'sort' => 3),
    7 => array('id' => 7, 'parentid' => 2, 'name' => '男装', 'description' => '男士服装', 'sort' => 1),
    8 => array('id' => 8, 'parentid' => 2, 'name' => '女装', 'description' => '女士服装', 'sort' => 2),
    9 => array('id' => 9, 'parentid' => 2, 'name' => '鞋子', 'description' => '各种鞋类', 'sort' => 3),
    10 => array('id' => 10, 'parentid' => 3, 'name' => '家具', 'description' => '家居家具', 'sort' => 1),
    11 => array('id' => 11, 'parentid' => 3, 'name' => '厨具', 'description' => '厨房用品', 'sort' => 2),
    12 => array('id' => 12, 'parentid' => 4, 'name' => 'iPhone', 'description' => '苹果手机', 'sort' => 1),
    13 => array('id' => 13, 'parentid' => 4, 'name' => 'Android手机', 'description' => '安卓手机', 'sort' => 2),
    14 => array('id' => 14, 'parentid' => 5, 'name' => '笔记本', 'description' => '笔记本电脑', 'sort' => 1),
    15 => array('id' => 15, 'parentid' => 5, 'name' => '台式机', 'description' => '台式电脑', 'sort' => 2),
    16 => array('id' => 16, 'parentid' => 7, 'name' => 'T恤', 'description' => '男士T恤', 'sort' => 1),
    17 => array('id' => 17, 'parentid' => 7, 'name' => '衬衫', 'description' => '男士衬衫', 'sort' => 2),
    18 => array('id' => 18, 'parentid' => 8, 'name' => '连衣裙', 'description' => '女士连衣裙', 'sort' => 1),
    19 => array('id' => 19, 'parentid' => 8, 'name' => '上衣', 'description' => '女士上衣', 'sort' => 2),
    20 => array('id' => 20, 'parentid' => 10, 'name' => '沙发', 'description' => '客厅沙发', 'sort' => 1),
    21 => array('id' => 21, 'parentid' => 10, 'name' => '茶几', 'description' => '客厅茶几', 'sort' => 2)
);

// 初始化树对象
$tree = new tree();
$tree->init($categories);

// 生成不同类型的树形结构演示

// 1. 下拉选择框
$select_html = $tree->get_tree(0, '<option value="$id" $selected>$spacer$name</option>', 12);

// 2. 嵌套列表
$list_html = $tree->get_tree(0, '<li id="cat_$id">$spacer<strong>$name</strong><br><small>$description</small></li>', 0);

// 3. 带链接的导航菜单
$menu_html = $tree->get_tree(0, '<div class="menu-item" style="margin-left: ${spacer_count}px;"><a href="/category/$id" title="$description">$name</a></div>', 0);

// 4. 多选复选框（使用 get_tree_multi）
$checkbox_html = $tree->get_tree_multi(0, '<label><input type="checkbox" name="categories[]" value="$id" $selected> $spacer$name</label><br>', '<label><input type="checkbox" name="categories[]" value="$id" $selected disabled> $spacer$name (已禁用)</label><br>', array(1, 5, 9));

// 5. 分类专用版本（使用 get_tree_category）
$category_html = $tree->get_tree_category(0, '<div class="category-item" style="margin-left: ${spacer_count}px;"><span class="category-name">$name</span><span class="category-desc">$description</span></div>', '<div class="category-item disabled" style="margin-left: ${spacer_count}px;"><span class="category-name">$name</span><span class="category-desc">(已禁用)</span></div>', array(1, 2));

// 6. Treeview 版本（如果需要可展开的树）
$treeview_html = $tree->get_treeview(0, 'category-tree', '<span class="file">$name</span>', '<span class="folder">$name</span>');

?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Class - get_tree() 方法深度学习</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Microsoft YaHei', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            font-size: 1.2em;
            opacity: 0.9;
        }

        .demo-section {
            margin: 30px;
            padding: 25px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background: #fafafa;
        }

        .demo-section h3 {
            color: #333;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #667eea;
            font-size: 1.3em;
        }

        .demo-content {
            background: white;
            padding: 20px;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        .code-example {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 6px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 14px;
            line-height: 1.5;
            overflow-x: auto;
            margin: 10px 0;
        }

        .method-info {
            background: #e8f4fd;
            border: 1px solid #bee5eb;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
        }

        .method-info h4 {
            color: #0c5460;
            margin-bottom: 10px;
        }

        .method-info p {
            margin-bottom: 8px;
        }

        .method-info code {
            background: #d1ecf1;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Consolas', 'Monaco', monospace;
        }

        /* 菜单样式 */
        .menu-item {
            margin: 5px 0;
            padding: 8px 15px;
            background: #f8f9fa;
            border-left: 3px solid #667eea;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: #e3f2fd;
            transform: translateX(5px);
        }

        .menu-item a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        .menu-item a:hover {
            color: #667eea;
        }

        /* 分类项目样式 */
        .category-item {
            margin: 5px 0;
            padding: 10px 15px;
            background: #f0f8ff;
            border: 1px solid #e0e8ff;
            border-radius: 4px;
        }

        .category-item.disabled {
            background: #f5f5f5;
            color: #999;
        }

        .category-name {
            font-weight: bold;
            color: #333;
        }

        .category-desc {
            color: #666;
            font-size: 0.9em;
        }

        /* 下拉框样式 */
        select {
            padding: 8px 12px;
            border: 2px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            min-width: 200px;
        }

        select:focus {
            outline: none;
            border-color: #667eea;
        }

        /* 复选框样式 */
        input[type="checkbox"] {
            margin-right: 5px;
        }

        label {
            cursor: pointer;
            user-select: none;
        }

        /* 响应式设计 */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                margin: 0;
                border-radius: 0;
            }

            .header h1 {
                font-size: 2em;
            }

            .demo-section {
                margin: 15px;
                padding: 15px;
            }
        }

        .nav-links {
            position: sticky;
            top: 20px;
            float: right;
            width: 200px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-left: 20px;
        }

        .nav-links h4 {
            color: #333;
            margin-bottom: 10px;
        }

        .nav-links a {
            display: block;
            color: #667eea;
            text-decoration: none;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .nav-links a:hover {
            color: #764ba2;
        }

        .main-content {
            overflow: hidden;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌳 Tree Class 深度学习</h1>
            <p>掌握 get_tree() 方法的核心用法和高级技巧</p>
        </div>

        <div style="display: flex;">
            <div class="main-content" style="flex: 1; padding: 30px;">
                <!-- 方法概述 -->
                <div class="demo-section">
                    <h3>📖 get_tree() 方法详解</h3>
                    <div class="method-info">
                        <h4>方法签名</h4>
                        <p><code>get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '')</code></p>

                        <h4>参数说明</h4>
                        <ul style="margin-left: 20px;">
                            <li><strong>$myid</strong>: int - 要查询的父级ID（从此节点开始生成树）</li>
                            <li><strong>$str</strong>: string - 生成树形结构的HTML模板</li>
                            <li><strong>$sid</strong>: mixed - 被选中的ID（单个ID或数组）</li>
                            <li><strong>$adds</strong>: string - 前缀字符（用于缩进）</li>
                            <li><strong>$str_group</strong>: string - 分组样式模板</li>
                        </ul>
                    </div>
                </div>

                <!-- 演示1：下拉选择框 -->
                <div class="demo-section">
                    <h3>🎯 演示1：下拉选择框</h3>
                    <div class="demo-content">
                        <form>
                            <label for="category-select">选择商品分类：</label><br>
                            <select id="category-select" name="category">
                                <option value="0">请选择分类</option>
                                <?php echo $select_html; ?>
                            </select>
                        </form>
                    </div>

                    <div class="code-example">
<?php
echo htmlspecialchars('<?php
// 生成下拉选择框，选中ID为12的项目
$select_html = $tree->get_tree(0, \'<option value="$id" $selected>$spacer$name</option>\', 12);
?>');
?>
                    </div>
                </div>

                <!-- 演示2：嵌套列表 -->
                <div class="demo-section">
                    <h3>🎯 演示2：嵌套列表</h3>
                    <div class="demo-content">
                        <ul class="category-list">
                            <?php echo $list_html; ?>
                        </ul>
                    </div>

                    <div class="code-example">
<?php
echo htmlspecialchars('<?php
// 生成嵌套列表，包含名称和描述
$list_html = $tree->get_tree(0, \'<li id="cat_$id">$spacer<strong>$name</strong><br><small>$description</small></li>\', 0);
?>');
?>
                    </div>
                </div>

                <!-- 演示3：导航菜单 -->
                <div class="demo-section">
                    <h3>🎯 演示3：导航菜单</h3>
                    <div class="demo-content">
                        <div class="menu-container">
                            <?php echo $menu_html; ?>
                        </div>
                    </div>

                    <div class="code-example">
<?php
echo htmlspecialchars('<?php
// 生成带链接的导航菜单
$menu_html = $tree->get_tree(0, \'<div class="menu-item" style="margin-left: ${spacer_count}px;"><a href="/category/$id" title="$description">$name</a></div>\', 0);
?>');
?>
                    </div>
                </div>

                <!-- 演示4：多选复选框 -->
                <div class="demo-section">
                    <h3>🎯 演示4：多选复选框</h3>
                    <div class="demo-content">
                        <form>
                            <fieldset>
                                <legend>选择多个分类：</legend>
                                <?php echo $checkbox_html; ?>
                            </fieldset>
                        </form>
                    </div>

                    <div class="code-example">
<?php
echo htmlspecialchars('<?php
// 生成多选复选框，预选中指定项目
$checkbox_html = $tree->get_tree_multi(0, \'<label><input type="checkbox" name="categories[]" value="$id" $selected> $spacer$name</label><br>\', \'<label><input type="checkbox" name="categories[]" value="$id" $selected disabled> $spacer$name (已禁用)</label><br>\', array(1, 5, 9));
?>');
?>
                    </div>
                </div>

                <!-- 演示5：分类专用版本 -->
                <div class="demo-section">
                    <h3>🎯 演示5：分类专用版本</h3>
                    <div class="demo-content">
                        <div class="categories-container">
                            <?php echo $category_html; ?>
                        </div>
                    </div>

                    <div class="code-example">
<?php
echo htmlspecialchars('<?php
// 使用分类专用版本
$category_html = $tree->get_tree_category(0, \'<div class="category-item" style="margin-left: ${spacer_count}px;"><span class="category-name">$name</span><span class="category-desc">$description</span></div>\', \'<div class="category-item disabled" style="margin-left: ${spacer_count}px;"><span class="category-name">$name</span><span class="category-desc">(已禁用)</span></div>\', array(1, 2));
?>');
?>
                    </div>
                </div>

                <!-- 高级用法说明 -->
                <div class="demo-section">
                    <h3>🔧 高级用法</h3>
                    <div class="method-info">
                        <h4>模板变量说明</h4>
                        <p>在模板中使用以下变量：</p>
                        <ul style="margin-left: 20px;">
                            <li><code>$id</code> - 节点ID</li>
                            <li><code>$name</code> - 节点名称</li>
                            <li><code>$parentid</code> - 父节点ID</li>
                            <li><code>$spacer</code> - 自动生成的缩进字符串</li>
                            <li><code>$selected</code> - 选中状态（'selected' 或空）</li>
                            <li><code>${spacer_count}</code> - 缩进层级数（用于CSS）</li>
                        </ul>

                        <h4>自定义数据字段</h4>
                        <p>你可以在数据数组中添加自定义字段：</p>
                        <div class="code-example">
<?php
echo htmlspecialchars('<?php
$data = array(
    1 => array(
        \'id\' => 1,
        \'parentid\' => 0,
        \'name\' => \'电子产品\',
        \'icon\' => \'📱\',           // 自定义图标字段
        \'item_count\' => 150      // 自定义项目数量字段
    )
);

// 在模板中使用自定义字段
$template = \'<div class="item">$icon $spacer<strong>$name</strong> ($item_count 件商品)</div>\';
?>');
?>
                        </div>
                    </div>
                </div>

                <!-- 其他方法 -->
                <div class="demo-section">
                    <h3>📚 其他实用方法</h3>
                    <div class="method-info">
                        <h4>get_child($myid)</h4>
                        <p>获取指定节点的所有直接子节点：</p>
                        <div class="code-example">
<?php
$children = $tree->get_child(1);
echo "// 获取ID为1的子节点：\n";
echo "Array (\n";
foreach ($children as $child) {
    echo "    [{$child['id']}] => {$child['name']}\n";
}
echo ")";
?>
                        </div>

                        <h4>get_parent($myid)</h4>
                        <p>获取指定节点的父节点同级节点：</p>
                        <div class="code-example">
<?php
$parent_siblings = $tree->get_parent(4);
echo "// 获取ID为4的父节点的兄弟节点：\n";
echo "Array (\n";
foreach ($parent_siblings as $sibling) {
    echo "    [{$sibling['id']}] => {$sibling['name']}\n";
}
echo ")";
?>
                        </div>
                    </div>
                </div>

                <!-- 完整使用示例 -->
                <div class="demo-section">
                    <h3>💻 完整使用示例</h3>
                    <div class="code-example">
<?php
echo htmlspecialchars('<?php
// 1. 包含类文件
require_once \'tree.class.php\';

// 2. 准备数据
$data = array(
    1 => array(\'id\' => 1, \'parentid\' => 0, \'name\' => \'电子产品\', \'sort\' => 1),
    2 => array(\'id\' => 2, \'parentid\' => 0, \'name\' => \'服装鞋包\', \'sort\' => 2),
    3 => array(\'id\' => 3, \'parentid\' => 1, \'name\' => \'手机\', \'sort\' => 1),
    4 => array(\'id\' => 4, \'parentid\' => 1, \'name\' => \'电脑\', \'sort\' => 2),
    5 => array(\'id\' => 5, \'parentid\' => 3, \'name\' => \'iPhone\', \'sort\' => 1),
    6 => array(\'id\' => 6, \'parentid\' => 3, \'name\' => \'Android手机\', \'sort\' => 2)
);

// 3. 初始化树对象
$tree = new tree();
$tree->init($data);

// 4. 生成下拉选择框
$select_html = $tree->get_tree(0, \'<option value="$id" $selected>$spacer$name</option>\', 5);

// 5. 生成导航菜单
$menu_html = $tree->get_tree(0, \'<li><a href="/category/$id">$spacer$name</a></li>\', 0);

// 6. 生成多选复选框
$checkbox_html = $tree->get_tree_multi(0, \'<label><input type="checkbox" name="categories[]" value="$id" $selected> $spacer$name</label><br>\', \'<label><input type="checkbox" name="categories[]" value="$id" $selected disabled> $spacer$name (已禁用)</label><br>\', array(1, 3));

// 7. 输出HTML
echo $select_html;
echo $menu_html;
echo $checkbox_html;
?>');
?>
                    </div>
                </div>

                <!-- 实际应用场景 -->
                <div class="demo-section">
                    <h3>🚀 实际应用场景</h3>
                    <div class="method-info">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 15px; margin-top: 15px;">
                            <div style="background: #e8f5e8; padding: 15px; border-radius: 6px;">
                                <h5 style="color: #2e7d32; margin-bottom: 8px;">🏪 电商平台</h5>
                                <ul style="color: #388e3c; font-size: 0.9em;">
                                    <li>商品分类选择</li>
                                    <li>多级菜单导航</li>
                                    <li>筛选器选项</li>
                                </ul>
                            </div>
                            <div style="background: #fff3e0; padding: 15px; border-radius: 6px;">
                                <h5 style="color: #ef6c00; margin-bottom: 8px;">🏢 企业管理</h5>
                                <ul style="color: #e65100; font-size: 0.9em;">
                                    <li>组织架构图</li>
                                    <li>部门权限树</li>
                                    <li>员工层级结构</li>
                                </ul>
                            </div>
                            <div style="background: #e3f2fd; padding: 15px; border-radius: 6px;">
                                <h5 style="color: #1565c0; margin-bottom: 8px;">📝 内容管理</h5>
                                <ul style="color: #0d47a1; font-size: 0.9em;">
                                    <li>文章分类</li>
                                    <li>标签层级</li>
                                    <li>目录结构</li>
                                </ul>
                            </div>
                            <div style="background: #f3e5f5; padding: 15px; border-radius: 6px;">
                                <h5 style="color: #7b1fa2; margin-bottom: 8px;">🌍 地区选择</h5>
                                <ul style="color: #4a148c; font-size: 0.9em;">
                                    <li>省市区选择</li>
                                    <li>地址层级</li>
                                    <li>地理位置</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 总结 -->
                <div class="demo-section">
                    <h3>🎓 学习要点总结</h3>
                    <div class="method-info">
                        <h4>核心概念</h4>
                        <ol style="margin-left: 20px;">
                            <li><strong>数据结构</strong>：必须包含 id、parentid、name 字段的关联数组</li>
                            <li><strong>递归构建</strong>：通过递归函数构建树形结构</li>
                            <li><strong>模板引擎</strong>：使用 $变量名 引用数据字段，支持自定义模板</li>
                            <li><strong>缩进处理</strong>：$spacer 变量自动处理层级缩进</li>
                            <li><strong>选中状态</strong>：$selected 变量处理选中状态</li>
                        </ol>

                        <h4>使用技巧</h4>
                        <ul style="margin-left: 20px;">
                            <li>从根节点（ID=0）开始生成整棵树</li>
                            <li>灵活使用模板自定义输出格式</li>
                            <li>利用 $sid 参数处理选中状态</li>
                            <li>通过 $adds 参数控制缩进字符</li>
                            <li>合理使用其他辅助方法</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 导航菜单 -->
            <div class="nav-links">
                <h4>📍 快速导航</h4>
                <a href="#method-overview">方法概述</a>
                <a href="#demo1">演示1：下拉选择框</a>
                <a href="#demo2">演示2：嵌套列表</a>
                <a href="#demo3">演示3：导航菜单</a>
                <a href="#demo4">演示4：多选复选框</a>
                <a href="#demo5">演示5：分类版本</a>
                <a href="#advanced">高级用法</a>
                <a href="#other-methods">其他方法</a>
                <a href="#examples">完整示例</a>
                <a href="#scenarios">应用场景</a>
                <a href="#summary">学习总结</a>
            </div>
        </div>
    </div>

    <script>
        // 添加一些交互效果
        document.addEventListener('DOMContentLoaded', function() {
            // 为导航链接添加平滑滚动
            const navLinks = document.querySelectorAll('.nav-links a');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId) || document.querySelector(`[name="${targetId}"]`);
                    if (targetElement) {
                        targetElement.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            // 为菜单链接添加点击效果
            const menuLinks = document.querySelectorAll('.menu-item a');
            menuLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const categoryName = this.textContent;
                    alert(`点击了分类：${categoryName}\n链接：${this.href}`);
                });
            });

            // 为复选框添加全选功能
            const selectAllCheckbox = document.createElement('input');
            selectAllCheckbox.type = 'checkbox';
            selectAllCheckbox.id = 'select-all';
            selectAllCheckbox.style.marginRight = '5px';

            const selectAllLabel = document.createElement('label');
            selectAllLabel.htmlFor = 'select-all';
            selectAllLabel.textContent = '全选/取消全选';
            selectAllLabel.style.cursor = 'pointer';

            const checkboxForm = document.querySelector('.demo-content form fieldset');
            if (checkboxForm) {
                checkboxForm.insertBefore(document.createElement('br'), checkboxForm.firstChild);
                checkboxForm.insertBefore(selectAllLabel, checkboxForm.firstChild);
                checkboxForm.insertBefore(selectAllCheckbox, checkboxForm.firstChild);

                selectAllCheckbox.addEventListener('change', function() {
                    const checkboxes = checkboxForm.querySelectorAll('input[type="checkbox"]:not(#select-all)');
                    checkboxes.forEach(cb => cb.checked = this.checked);
                });
            }
        });
    </script>
</body>
</html>
