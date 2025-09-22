<?php
/**
 * SimpleTree 示例演示文件
 * 
 * 本文件演示了 SimpleTree 类中 generateTreeText 方法在不同场景下的应用
 */

// 包含 SimpleTree 类定义
require_once '/home/lirongyao0916/Projects/cs.com/library/core/SimpleTree.php';

echo "=== SimpleTree generateTreeText 方法演示 ===\n\n";

// 示例1: 基本树形结构
echo "1. 基本树形结构演示:\n";
$data1 = array(
    1 => array('id' => 1, 'parentid' => 0, 'name' => '公司组织架构'),
    2 => array('id' => 2, 'parentid' => 1, 'name' => '技术部'),
    3 => array('id' => 3, 'parentid' => 1, 'name' => '市场部'),
    4 => array('id' => 4, 'parentid' => 2, 'name' => '前端组'),
    5 => array('id' => 5, 'parentid' => 2, 'name' => '后端组'),
    6 => array('id' => 6, 'parentid' => 3, 'name' => '推广组')
);

$tree1 = new SimpleTree();
$tree1->init($data1);
echo $tree1->generateTreeText();

echo "\n" . str_repeat("-", 50) . "\n\n";

// 示例2: 深层嵌套结构
echo "2. 深层嵌套结构演示:\n";
$data2 = array(
    1 => array('id' => 1, 'parentid' => 0, 'name' => '学科分类'),
    2 => array('id' => 2, 'parentid' => 1, 'name' => '理工科'),
    3 => array('id' => 3, 'parentid' => 1, 'name' => '文科'),
    4 => array('id' => 4, 'parentid' => 2, 'name' => '计算机科学'),
    5 => array('id' => 5, 'parentid' => 2, 'name' => '数学'),
    6 => array('id' => 6, 'parentid' => 4, 'name' => '算法'),
    7 => array('id' => 7, 'parentid' => 4, 'name' => '数据结构'),
    8 => array('id' => 8, 'parentid' => 6, 'name' => '排序算法'),
    9 => array('id' => 9, 'parentid' => 6, 'name' => '搜索算法')
);

$tree2 = new SimpleTree();
$tree2->init($data2);
echo $tree2->generateTreeText();

echo "\n" . str_repeat("-", 50) . "\n\n";

// 示例3: 单节点和多节点对比
echo "3. 单节点与多节点对比演示:\n";
$data3_single = array(
    1 => array('id' => 1, 'parentid' => 0, 'name' => '根节点'),
    2 => array('id' => 2, 'parentid' => 1, 'name' => '唯一子节点')
);

$data3_multiple = array(
    1 => array('id' => 1, 'parentid' => 0, 'name' => '根节点'),
    2 => array('id' => 2, 'parentid' => 1, 'name' => '第一个子节点'),
    3 => array('id' => 3, 'parentid' => 1, 'name' => '第二个子节点')
);

$tree3_single = new SimpleTree();
$tree3_single->init($data3_single);
echo "单子节点结构:\n";
echo $tree3_single->generateTreeText();

echo "\n";

$tree3_multiple = new SimpleTree();
$tree3_multiple->init($data3_multiple);
echo "多子节点结构:\n";
echo $tree3_multiple->generateTreeText();

echo "\n" . str_repeat("-", 50) . "\n\n";

// 示例4: 详细分析演示
echo "4. 详细分析演示 - 展示 next_prefix 的作用:\n";
echo "我们将手动追踪 next_prefix 在递归中的传递过程:\n\n";

// 创建一个简单的分析函数来展示前缀传递过程
class SimpleTreeAnalyzer extends SimpleTree {
    public function generateTreeTextWithAnalysis($parent_id = 0, $prefix = '', $level = 0) {
        $result = '';
        $children = $this->getChildren($parent_id);
        
        if ($children) {
            $count = count($children);
            $index = 0;
            
            foreach ($children as $child_id => $child) {
                $index++;
                $is_last = ($index == $count);
                
                // 根据是否是最后一个子节点来确定前缀字符
                if ($is_last) {
                    $current_prefix = $prefix . '└── ';
                    $next_prefix = $prefix . '    '; // 关键：最后节点传递空格
                } else {
                    $current_prefix = $prefix . '├── ';
                    $next_prefix = $prefix . '│   '; // 关键：非最后节点传递垂直线
                }
                
                // 添加分析信息
                $indent = str_repeat("  ", $level);
                $result .= "{$indent}[分析] 处理节点: {$child['name']} (ID: {$child_id})\n";
                $result .= "{$indent}[分析] 是否最后节点: " . ($is_last ? "是" : "否") . "\n";
                $result .= "{$indent}[分析] current_prefix: '" . str_replace(' ', '·', $current_prefix) . "'\n";
                $result .= "{$indent}[分析] next_prefix: '" . str_replace(' ', '·', $next_prefix) . "'\n";
                $result .= "{$indent}[显示] " . $current_prefix . $child['name'] . "\n\n";
                
                // 递归处理子节点
                $result .= $this->generateTreeTextWithAnalysis($child_id, $next_prefix, $level + 1);
            }
        }
        
        return $result;
    }
}

$data4 = array(
    1 => array('id' => 1, 'parentid' => 0, 'name' => '根'),
    2 => array('id' => 2, 'parentid' => 1, 'name' => '分支A'),
    3 => array('id' => 3, 'parentid' => 1, 'name' => '分支B'),
    4 => array('id' => 4, 'parentid' => 2, 'name' => '叶节点1'),
    5 => array('id' => 5, 'parentid' => 2, 'name' => '叶节点2')
);

$tree4 = new SimpleTreeAnalyzer();
$tree4->init($data4);
echo $tree4->generateTreeTextWithAnalysis();

echo "\n" . str_repeat("=", 60) . "\n";
echo "最终生成的树形结构:\n";
echo (new SimpleTree())->init($data4) ? (new SimpleTree())->init($data4) && print((new SimpleTree())->generateTreeText()) : '';
$tree_final = new SimpleTree();
$tree_final->init($data4);
echo $tree_final->generateTreeText();

echo "\n=== 演示结束 ===\n";
?>