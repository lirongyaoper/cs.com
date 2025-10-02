<?php
/**
 * 示例3：get_tree() 方法逐步执行演示
 * 
 * 这个示例详细展示：
 * 1. get_tree() 的递归执行过程
 * 2. 每一步的变量值
 * 3. 缩进符号的生成逻辑
 * 4. 递归调用栈的变化
 */

require_once dirname(__DIR__) . '/tree.class.php';

echo "=====================================\n";
echo "   get_tree() 逐步执行演示\n";
echo "=====================================\n\n";

// 使用一个简单的数据结构，便于理解
$categories = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => 'A'],
    2 => ['id' => 2, 'parentid' => 1, 'name' => 'B'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => 'C'],
    4 => ['id' => 4, 'parentid' => 2, 'name' => 'D'],
];

echo "使用的数据结构：\n";
echo "-------------------------\n";
print_r($categories);

echo "\n树形关系：\n";
echo "-------------------------\n";
echo "A (id=1, parentid=0)\n";
echo "├── B (id=2, parentid=1)\n";
echo "│   └── D (id=4, parentid=2)\n";
echo "└── C (id=3, parentid=1)\n\n";


// ========================================
// 创建一个带调试信息的 Tree 类
// ========================================

class DebugTree extends tree {
    public $level = 0;  // 记录递归层级
    public $step = 0;   // 记录执行步骤
    
    public function get_tree_debug($myid, $str, $sid = 0, $adds = '', $str_group = '') {
        $this->level++;
        $indent = str_repeat('  ', $this->level - 1);
        
        echo "{$indent}┌─ 第 " . (++$this->step) . " 步 ─────────────────────\n";
        echo "{$indent}│ 调用: get_tree(myid={$myid})\n";
        echo "{$indent}│ 当前层级: {$this->level}\n";
        echo "{$indent}│ 当前 adds: '" . htmlspecialchars($adds) . "'\n";
        
        $number = 1;
        $child = $this->get_child($myid);
        
        if(is_array($child)) {
            $total = count($child);
            echo "{$indent}│ 找到子节点: {$total} 个\n";
            echo "{$indent}│ 子节点ID: [" . implode(', ', array_keys($child)) . "]\n";
            echo "{$indent}└─────────────────────────\n\n";
            
            foreach($child as $id => $value) {
                echo "{$indent}  → 处理节点 id={$id} ('{$value['name']}'), 第 {$number}/{$total} 个\n";
                
                $j = $k = '';
                
                // 判断是否为最后一个
                if($number == $total) {
                    $j .= $this->icon[2];
                    echo "{$indent}    • 是最后一个节点，使用符号: '{$this->icon[2]}'\n";
                } else {
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                    echo "{$indent}    • 不是最后一个，使用符号: '{$this->icon[1]}'\n";
                    echo "{$indent}    • k = '" . htmlspecialchars($k) . "'\n";
                }
                
                $spacer = $adds ? $adds.$j : '';
                echo "{$indent}    • spacer = '" . htmlspecialchars($spacer) . "'\n";
                
                $selected = '';
                if(is_array($sid)) {
                    $selected = in_array($id, $sid) ? 'selected' : '';
                } else {
                    $selected = $id == $sid ? 'selected' : '';
                }
                
                if(!is_array($value)) return false;
                @extract($value);
                
                $parentid == 0 && $str_group ? eval("\$nstr = \"$str_group\";") : eval("\$nstr = \"$str\";");
                
                echo "{$indent}    • 生成输出: " . trim($nstr) . "\n";
                $this->ret .= $nstr;
                
                // 递归调用
                $next_adds = $adds.$k.$this->nbsp;
                echo "{$indent}    • 准备递归: get_tree({$id})\n";
                echo "{$indent}    • 传递 adds: '" . htmlspecialchars($next_adds) . "'\n\n";
                
                $this->get_tree_debug($id, $str, $sid, $next_adds, $str_group);
                $number++;
            }
        } else {
            echo "{$indent}│ 没有子节点（叶子节点）\n";
            echo "{$indent}└─────────────────────────\n\n";
        }
        
        $this->level--;
        return $this->ret;
    }
}


// ========================================
// 执行演示
// ========================================
echo "\n=====================================\n";
echo "   开始执行演示\n";
echo "=====================================\n\n";

$tree = new DebugTree();
$tree->init($categories);

echo "调用: \$tree->get_tree_debug(0, \"\\\$spacer\\\$name\\n\");\n\n";
echo "═══════════════════════════════════════\n\n";

$result = $tree->get_tree_debug(0, "\$spacer\$name\n");

echo "═══════════════════════════════════════\n\n";
echo "执行完成！\n\n";

echo "最终结果：\n";
echo "-------------------------\n";
echo $result;

echo "\n\n";


// ========================================
// 详细解释递归过程
// ========================================
echo "=====================================\n";
echo "   递归过程详细解释\n";
echo "=====================================\n\n";

echo "调用栈变化：\n";
echo "-------------------------\n\n";

echo "1. get_tree(0) - 层级1\n";
echo "   ├─ 找到子节点: [1]\n";
echo "   ├─ 处理节点1 (A)\n";
echo "   │  ├─ spacer = ''\n";
echo "   │  ├─ 输出: 'A'\n";
echo "   │  └─ 递归调用 get_tree(1)\n";
echo "   │\n";
echo "   └─> 进入 get_tree(1) - 层级2\n";
echo "       ├─ 找到子节点: [2, 3]\n";
echo "       ├─ 处理节点2 (B) - 第1个，共2个\n";
echo "       │  ├─ 不是最后一个，j='├', k='│'\n";
echo "       │  ├─ spacer = '├'\n";
echo "       │  ├─ 输出: '├B'\n";
echo "       │  └─ 递归调用 get_tree(2, adds='│ ')\n";
echo "       │\n";
echo "       └─> 进入 get_tree(2) - 层级3\n";
echo "           ├─ 找到子节点: [4]\n";
echo "           ├─ 处理节点4 (D) - 第1个，共1个\n";
echo "           │  ├─ 是最后一个，j='└'\n";
echo "           │  ├─ spacer = '│ └'\n";
echo "           │  ├─ 输出: '│ └D'\n";
echo "           │  └─ 递归调用 get_tree(4, adds='│  ')\n";
echo "           │\n";
echo "           └─> 进入 get_tree(4) - 层级4\n";
echo "               └─ 没有子节点，返回\n";
echo "           <── 返回到 get_tree(2)\n";
echo "       <── 返回到 get_tree(1)\n";
echo "       │\n";
echo "       ├─ 处理节点3 (C) - 第2个，共2个\n";
echo "       │  ├─ 是最后一个，j='└'\n";
echo "       │  ├─ spacer = '└'\n";
echo "       │  ├─ 输出: '└C'\n";
echo "       │  └─ 递归调用 get_tree(3)\n";
echo "       │\n";
echo "       └─> 进入 get_tree(3) - 层级3\n";
echo "           └─ 没有子节点，返回\n";
echo "       <── 返回到 get_tree(1)\n";
echo "   <── 返回到 get_tree(0)\n\n";


// ========================================
// 变量追踪表
// ========================================
echo "\n变量值追踪表：\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "步骤 | 层级 | myid | id | number | total | j  | k  | adds   | spacer\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo " 1   |  1   |  0   | 1  |   1    |   1   | ├  |    |        |       \n";
echo " 2   |  2   |  1   | 2  |   1    |   2   | ├  | │  |        | ├     \n";
echo " 3   |  3   |  2   | 4  |   1    |   1   | └  |    | │      | │ └   \n";
echo " 4   |  2   |  1   | 3  |   2    |   2   | └  |    |        | └     \n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";


// ========================================
// 关键点总结
// ========================================
echo "\n关键点总结：\n";
echo "-------------------------\n";
echo "1. 递归原理：\n";
echo "   - 对每个节点，先输出自己，再递归输出所有子节点\n";
echo "   - 通过 get_child() 获取子节点列表\n";
echo "   - 对每个子节点递归调用 get_tree()\n\n";

echo "2. 缩进符号生成：\n";
echo "   - 根据是否为最后一个节点，选择 ├ 或 └\n";
echo "   - 通过 \$adds 累积上层的缩进\n";
echo "   - \$spacer = \$adds + \$j\n\n";

echo "3. \$adds 的传递：\n";
echo "   - 不是最后一个: \$adds + '│' + '&nbsp;'\n";
echo "   - 是最后一个: \$adds + '' + '&nbsp;'\n";
echo "   - 这样可以保证上层的竖线正确延续\n\n";

echo "4. 循环变量：\n";
echo "   - \$number: 当前是第几个子节点\n";
echo "   - \$total: 子节点总数\n";
echo "   - 通过比较判断是否为最后一个\n\n";


// ========================================
// 自己动手练习
// ========================================
echo "\n=====================================\n";
echo "   自己动手练习\n";
echo "=====================================\n\n";

echo "练习1: 添加一个新节点 E (id=5, parentid=3)\n";
echo "预测：树的形状会变成什么样？\n\n";

$categories2 = $categories;
$categories2[5] = ['id' => 5, 'parentid' => 3, 'name' => 'E'];

$tree2 = new tree();
$tree2->init($categories2);
$tree2->ret = '';
$result2 = $tree2->get_tree(0, "\$spacer\$name\n");

echo "答案：\n";
echo $result2;
echo "\n";

echo "练习2: 如果从 id=1 开始调用 get_tree(1)，会输出什么？\n\n";
$tree3 = new tree();
$tree3->init($categories);
$tree3->ret = '';
$result3 = $tree3->get_tree(1, "\$spacer\$name\n");

echo "答案：\n";
echo $result3;
echo "\n";


echo "\n下一步：查看 example4_real_world.php 了解实际应用\n\n";
?>

