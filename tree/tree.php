<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree类完整测试界面</title>
    <style>
        body { 
            font-family: 'Microsoft YaHei', Arial, sans-serif; 
            margin: 0; padding: 20px; 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container { 
            max-width: 1200px; margin: 0 auto; 
            background: white; border-radius: 15px; 
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white; padding: 30px; text-align: center;
        }
        .header h1 { margin: 0; font-size: 2.5em; }
        .header p { margin: 10px 0 0 0; opacity: 0.9; }
        
        .nav {
            background: #f8f9fa; padding: 20px;
            border-bottom: 1px solid #dee2e6;
        }
        .nav a {
            display: inline-block; padding: 10px 20px; margin: 5px;
            background: #007bff; color: white; text-decoration: none;
            border-radius: 25px; transition: all 0.3s;
        }
        .nav a:hover { background: #0056b3; transform: translateY(-2px); }
        .nav a.active { background: #28a745; }
        
        .content { padding: 30px; }
        
        .test-section {
            margin-bottom: 40px; border: 1px solid #e9ecef;
            border-radius: 10px; overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .test-title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 20px; margin: 0;
            font-size: 1.3em; font-weight: bold;
        }
        .test-content { padding: 25px; }
        
        .code-block {
            background: #2d3748; color: #e2e8f0; padding: 20px;
            border-radius: 8px; margin: 15px 0;
            font-family: 'Courier New', monospace;
            border-left: 4px solid #4299e1;
            overflow-x: auto;
        }
        .result-block {
            background: #f0fff4; border: 2px solid #68d391;
            padding: 20px; border-radius: 8px; margin: 15px 0;
            position: relative;
        }
        .result-block::before {
            content: "✅ 运行结果";
            position: absolute; top: -10px; left: 15px;
            background: #68d391; color: white; padding: 2px 10px;
            border-radius: 15px; font-size: 12px;
        }
        
        .data-table {
            width: 100%; border-collapse: collapse; margin: 15px 0;
        }
        .data-table th, .data-table td {
            border: 1px solid #dee2e6; padding: 12px; text-align: left;
        }
        .data-table th {
            background: #f8f9fa; font-weight: bold;
        }
        .data-table tr:nth-child(even) { background: #f8f9fa; }
        
        .tree-display {
            background: #1a202c; color: #e2e8f0; padding: 20px;
            border-radius: 8px; font-family: monospace;
            white-space: pre-wrap; margin: 15px 0;
        }
        
        .stats-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px; margin: 20px 0;
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 20px; border-radius: 10px;
            text-align: center;
        }
        .stat-number { font-size: 2em; font-weight: bold; }
        .stat-label { opacity: 0.9; margin-top: 5px; }
        
        .feature-list {
            list-style: none; padding: 0;
        }
        .feature-list li {
            padding: 10px 0; border-bottom: 1px solid #e9ecef;
            position: relative; padding-left: 30px;
        }
        .feature-list li::before {
            content: "🌟"; position: absolute; left: 0; top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌳 Tree类功能测试中心</h1>
            <p>PHP树型数据结构处理类完整测试界面</p>
        </div>
        
        <div class="nav">
            <a href="?test=overview" class="<?php echo !isset($_GET['test']) || $_GET['test'] == 'overview' ? 'active' : ''; ?>">概览</a>
            <a href="?test=basic" class="<?php echo isset($_GET['test']) && $_GET['test'] == 'basic' ? 'active' : ''; ?>">基础功能</a>
            <a href="?test=tree" class="<?php echo isset($_GET['test']) && $_GET['test'] == 'tree' ? 'active' : ''; ?>">树型生成</a>
            <a href="?test=performance" class="<?php echo isset($_GET['test']) && $_GET['test'] == 'performance' ? 'active' : ''; ?>">性能测试</a>
            <a href="?test=examples" class="<?php echo isset($_GET['test']) && $_GET['test'] == 'examples' ? 'active' : ''; ?>">实际应用</a>
        </div>
        
        <div class="content">
            <?php
            require_once './tree.class.php';
            
            // 测试数据
            $testData = array(
                1 => array('id'=>'1','parentid'=>0,'name'=>'企业管理','icon'=>'🏢'),
                2 => array('id'=>'2','parentid'=>0,'name'=>'系统管理','icon'=>'⚙️'),
                3 => array('id'=>'3','parentid'=>1,'name'=>'用户管理','icon'=>'👥'),
                4 => array('id'=>'4','parentid'=>1,'name'=>'部门管理','icon'=>'🏛️'),
                5 => array('id'=>'5','parentid'=>3,'name'=>'添加用户','icon'=>'➕'),
                6 => array('id'=>'6','parentid'=>3,'name'=>'用户列表','icon'=>'📋'),
                7 => array('id'=>'7','parentid'=>2,'name'=>'系统配置','icon'=>'🔧'),
                8 => array('id'=>'8','parentid'=>2,'name'=>'日志管理','icon'=>'📝'),
                9 => array('id'=>'9','parentid'=>8,'name'=>'操作日志','icon'=>'📊'),
                10 => array('id'=>'10','parentid'=>8,'name'=>'错误日志','icon'=>'❌')
            );
            
            $tree = new tree();
            $tree->init($testData);
            
            $test = isset($_GET['test']) ? $_GET['test'] : 'overview';
            
            switch($test) {
                case 'overview':
                    include 'test_sections/overview.php';
                    break;
                case 'basic':
                    include 'test_sections/basic.php';
                    break;
                case 'tree':
                    include 'test_sections/tree.php';
                    break;
                case 'performance':
                    include 'test_sections/performance.php';
                    break;
                case 'examples':
                    include 'test_sections/examples.php';
                    break;
                default:
                    include 'test_sections/overview.php';
            }
            ?>
        </div>
    </div>
    
    <script>
        // 添加一些交互效果
        document.addEventListener('DOMContentLoaded', function() {
            // 代码块点击复制功能
            document.querySelectorAll('.code-block').forEach(block => {
                block.style.cursor = 'pointer';
                block.title = '点击复制代码';
                block.addEventListener('click', function() {
                    navigator.clipboard.writeText(this.textContent);
                    this.style.background = '#2d5a2d';
                    setTimeout(() => {
                        this.style.background = '#2d3748';
                    }, 500);
                });
            });
            
            // 为统计卡片添加动画
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animation = 'slideInUp 0.6s ease forwards';
                    }
                });
            }, observerOptions);
            
            document.querySelectorAll('.stat-card').forEach(card => {
                observer.observe(card);
            });
        });
    </script>
    
    <style>
        @keyframes slideInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</body>
</html>

<?php
// 创建测试章节目录
if (!file_exists('test_sections')) {
    mkdir('test_sections', 0755, true);
}

// 概览页面
if (!file_exists('test_sections/overview.php')) {
    file_put_contents('test_sections/overview.php', '<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">📊 数据概览</h2>";
echo "<div class=\"test-content\">";

echo "<h3>测试数据结构</h3>";
echo "<table class=\"data-table\">";
echo "<tr><th>ID</th><th>父级ID</th><th>名称</th><th>图标</th></tr>";
foreach($testData as $id => $item) {
    echo "<tr><td>{$id}</td><td>{$item[\'parentid\']}</td><td>{$item[\'name\']}</td><td>{$item[\'icon\']}</td></tr>";
}
echo "</table>";

echo "<div class=\"stats-grid\">";
echo "<div class=\"stat-card\"><div class=\"stat-number\">" . count($testData) . "</div><div class=\"stat-label\">总节点数</div></div>";

$rootCount = count($tree->get_child(0));
echo "<div class=\"stat-card\"><div class=\"stat-number\">{$rootCount}</div><div class=\"stat-label\">根节点数</div></div>";

$maxDepth = 0;
foreach($testData as $item) {
    $path = array();
    $positions = $tree->get_pos($item[\'id\'], $path);
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
?>');
}

// 基础功能页面
if (!file_exists('test_sections/basic.php')) {
    file_put_contents('test_sections/basic.php', '<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">🔧 基础方法测试</h2>";
echo "<div class=\"test-content\">";

echo "<h3>1. get_child() - 获取子级节点</h3>";
echo "<div class=\"code-block\">\$tree->get_child(0); // 获取根级节点</div>";
echo "<div class=\"result-block\">";
$children = $tree->get_child(0);
echo "<strong>根级节点：</strong><br>";
foreach($children as $id => $child) {
    echo "{$child[\'icon\']} ID:{$id} - {$child[\'name\']}<br>";
}
echo "</div>";

echo "<h3>2. get_child() - 获取指定节点的子级</h3>";
echo "<div class=\"code-block\">\$tree->get_child(1); // 获取ID=1的子级</div>";
echo "<div class=\"result-block\">";
$children = $tree->get_child(1);
if($children) {
    echo "<strong>ID=1的子级：</strong><br>";
    foreach($children as $id => $child) {
        echo "{$child[\'icon\']} ID:{$id} - {$child[\'name\']}<br>";
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
    echo "{$pos[\'icon\']} {$pos[\'name\']} → ";
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
        echo "{$parent[\'icon\']} ID:{$id} - {$parent[\'name\']}<br>";
    }
} else {
    echo "无父级同级节点";
}
echo "</div>";

echo "</div></div>";
?>');
}

// 树型生成页面
if (!file_exists('test_sections/tree.php')) {
    file_put_contents('test_sections/tree.php', '<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">🌳 树型结构生成测试</h2>";
echo "<div class=\"test-content\">";

echo "<h3>1. get_tree() - 简单列表格式</h3>";
echo "<div class=\"code-block\">\$tree->get_tree(0, \'\$icon \$spacer\$name\'); // 生成带图标的树型列表</div>";
echo "<div class=\"result-block\">";
$tree->ret = \'\';
$result = $tree->get_tree(0, \'\$icon \$spacer\$name\' . PHP_EOL);
echo "<div class=\"tree-display\">" . htmlspecialchars($result) . "</div>";
echo "</div>";

echo "<h3>2. TreeView格式</h3>";
echo "<div class=\"code-block\">\$tree->get_treeview(0, \'demo\', \'叶子节点模板\', \'分支节点模板\');</div>";
echo "<div class=\"result-block\">";
$tree->str = \'\';
$treeview = $tree->get_treeview(0, \'demo\', 
    \'<span class="file">\$icon \$name</span>\', 
    \'<span class="folder">\$icon \$name</span>\'
);
echo $treeview;
echo "</div>";

echo "<h3>3. 自定义HTML格式</h3>";
echo "<div class=\"code-block\">\$tree->get_tree(0, \'&lt;div class=\"menu-item\"&gt;\$icon \$spacer\$name&lt;/div&gt;\');</div>";
echo "<div class=\"result-block\">";
$tree->ret = \'\';
$result = $tree->get_tree(0, \'<div class="menu-item" style="padding-left: 20px; margin: 5px 0; border-left: 2px solid #ddd;">\$icon \$spacer\$name</div>\');
echo $result;
echo "</div>";

echo "</div></div>";
?>');
}

// 性能测试页面
if (!file_exists('test_sections/performance.php')) {
    file_put_contents('test_sections/performance.php', '<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">⚡ 性能测试</h2>";
echo "<div class=\"test-content\">";

echo "<h3>基准测试</h3>";

// 测试get_tree性能
$iterations = 1000;
$start = microtime(true);
for($i = 0; $i < $iterations; $i++) {
    $tree->ret = \'\';
    $tree->get_tree(0, \'\$spacer\$name\');
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
    $tree->str = \'\';
    $tree->get_treeview(0, \'test\', \'\$name\', \'\$name\');
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
?>');
}

// 实际应用页面
if (!file_exists('test_sections/examples.php')) {
    file_put_contents('test_sections/examples.php', '<?php
echo "<div class=\"test-section\">";
echo "<h2 class=\"test-title\">🚀 实际应用示例</h2>";
echo "<div class=\"test-content\">";

echo "<h3>1. 导航菜单生成</h3>";
echo "<div class=\"code-block\">// 生成网站导航菜单
\$html = \$tree->get_tree(0, \'&lt;li&gt;&lt;a href=\"#\"&gt;\$icon \$spacer\$name&lt;/a&gt;&lt;/li&gt;\');
echo \'&lt;ul class=\"nav-menu\"&gt;\' . \$html . \'&lt;/ul&gt;\';</div>";
echo "<div class=\"result-block\">";
$tree->ret = \'\';
$navHtml = $tree->get_tree(0, \'<li style="list-style: none; margin: 5px 0;"><a href="#" style="text-decoration: none; color: #333; display: block; padding: 8px;">\$icon \$spacer\$name</a></li>\');
echo "<ul style=\"padding: 0; margin: 0;\">" . $navHtml . "</ul>";
echo "</div>";

echo "<h3>2. 下拉选择框</h3>";
echo "<div class=\"code-block\">// 生成分类选择下拉框
\$options = \$tree->get_tree(0, \'&lt;option value=\"\$id\"&gt;\$spacer\$name&lt;/option&gt;\');
echo \'&lt;select&gt;\' . \$options . \'&lt;/select&gt;\';</div>";
echo "<div class=\"result-block\">";
$tree->ret = \'\';
$options = $tree->get_tree(0, \'<option value="\$id">\$spacer\$name</option>\');
echo "<select style=\"width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;\">";
echo "<option value=\"\">请选择分类...</option>";
echo $options;
echo "</select>";
echo "</div>";

echo "<h3>3. 后台管理菜单</h3>";
echo "<div class=\"code-block\">// 生成后台管理左侧菜单
\$tree->get_treeview(0, \'admin-menu\', 
    \'&lt;span class=\"menu-item\"&gt;\$icon \$name&lt;/span&gt;\',
    \'&lt;span class=\"menu-folder\"&gt;\$icon \$name&lt;/span&gt;\'
);</div>";
echo "<div class=\"result-block\">";
$tree->str = \'\';
$adminMenu = $tree->get_treeview(0, \'admin-menu\',
    \'<span style="padding: 5px 10px; display: block; color: #666;">\$icon \$name</span>\',
    \'<span style="padding: 5px 10px; display: block; font-weight: bold; color: #333; cursor: pointer;">\$icon \$name</span>\'
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
    echo \$pos[\'name\'] . \' &raquo; \';
}</div>";
echo "<div class=\"result-block\">";
$path = array();
$positions = $tree->get_pos(5, $path);
echo "<nav style=\"padding: 10px; background: #f8f9fa; border-radius: 4px;\">";
echo "<span style=\"color: #666;\">当前位置：</span>";
foreach($positions as $pos) {
    echo "<a href=\"#\" style=\"color: #007bff; text-decoration: none; margin: 0 5px;\">{$pos[\'icon\']} {$pos[\'name\']}</a>";
    if(end($positions) !== $pos) echo " <span style=\"color: #6c757d;\">›</span> ";
}
echo "</nav>";
echo "</div>";

echo "</div></div>";
?>');
}
?>
