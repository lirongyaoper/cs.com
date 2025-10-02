# Tree 类快速上手指南

## 5分钟快速入门

### 第一步：理解核心概念

Tree 类的作用：**将扁平的数组转换为树形结构**

```
输入：扁平数组
[
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'A'],
    2 => ['id'=>2, 'parentid'=>1, 'name'=>'B'],
]

输出：树形显示
A
└── B
```

### 第二步：准备数据

数据必须包含三个字段：

```php
$data = [
    // 数组的键 => [必须字段]
    1 => [
        'id'       => 1,    // 节点唯一ID
        'parentid' => 0,    // 父节点ID（0表示顶级）
        'name'     => 'A',  // 显示名称
    ],
];
```

### 第三步：基本使用

```php
// 1. 引入类文件
require_once 'tree.class.php';

// 2. 实例化
$tree = new tree();

// 3. 初始化数据
$tree->init($data);

// 4. 生成树形结构
$html = $tree->get_tree(0, "\$spacer\$name\n");

// 5. 输出
echo $html;
```

### 第四步：常用场景

#### 场景1：生成下拉列表

```php
$str = "<option value='\$id'>\$spacer\$name</option>\n";
$html = $tree->get_tree(0, $str);
echo "<select>{$html}</select>";
```

#### 场景2：带选中状态

```php
$current_id = 5;  // 当前选中的ID
$str = "<option value='\$id' \$selected>\$spacer\$name</option>\n";
$html = $tree->get_tree(0, $str, $current_id);
```

#### 场景3：自定义字段

```php
// 数据中添加自定义字段
$data = [
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'分类A', 'icon'=>'📁', 'count'=>10],
];

// 模板中使用自定义字段
$str = "<div>\$spacer\$icon \$name (\$count)</div>\n";
```

---

## 常见错误及解决

### ❌ 错误1：树形结构显示不正确

**原因**：
- 数组的键名不是节点的 ID
- 缺少 `id` 或 `parentid` 字段

**解决**：
```php
// ❌ 错误写法
$data = [
    ['id'=>1, 'parentid'=>0, 'name'=>'A'],
];

// ✅ 正确写法
$data = [
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'A'],
];
```

### ❌ 错误2：多次调用结果叠加

**原因**：没有重置 `$tree->ret`

**解决**：
```php
// ✅ 每次调用前重置
$tree->ret = '';
$html = $tree->get_tree(0, $str);
```

### ❌ 错误3：模板变量不生效

**原因**：模板字符串中变量没有转义

**解决**：
```php
// ❌ 错误写法
$str = "<option>$spacer$name</option>";  // 会被PHP立即解析

// ✅ 正确写法
$str = "<option>\$spacer\$name</option>";  // 使用 \$ 转义
// 或者使用单引号
$str = '<option>$spacer$name</option>';
```

---

## get_tree() 方法速查

### 方法签名
```php
get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '')
```

### 参数说明

| 参数 | 类型 | 必需 | 说明 | 常用值 |
|------|------|------|------|--------|
| `$myid` | int | ✅ | 起始节点ID | `0` (从根开始) |
| `$str` | string | ✅ | 输出模板 | `"<option>\$spacer\$name</option>"` |
| `$sid` | int/array | ❌ | 选中的ID | `5` 或 `[3,5,7]` |
| `$adds` | string | ❌ | 内部使用 | `''` (留空) |
| `$str_group` | string | ❌ | 顶级分类模板 | 可选 |

### 模板变量

| 变量 | 说明 | 示例值 |
|------|------|--------|
| `$id` | 节点ID | `1` |
| `$parentid` | 父节点ID | `0` |
| `$name` | 节点名称 | `"分类A"` |
| `$spacer` | 缩进符号 | `"├──"` |
| `$selected` | 选中状态 | `"selected"` 或 `""` |
| 自定义字段 | 数组中的其他字段 | `$url`, `$icon`, `$count` |

---

## 实用代码片段

### 片段1：从数据库查询数据

```php
// 假设从数据库查询分类
$sql = "SELECT id, parentid, name FROM categories ORDER BY sort ASC";
$result = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['id']] = $row;
}

$tree = new tree();
$tree->init($data);
```

### 片段2：生成 JSON 数据

```php
function buildTreeArray($tree, $myid) {
    $result = [];
    $children = $tree->get_child($myid);
    if ($children) {
        foreach ($children as $id => $item) {
            $node = $item;
            $node['children'] = buildTreeArray($tree, $id);
            $result[] = $node;
        }
    }
    return $result;
}

$json = json_encode(buildTreeArray($tree, 0));
```

### 片段3：获取面包屑导航

```php
$pos_array = [];
$position = $tree->get_pos($current_id, $pos_array);

$breadcrumb = [];
foreach ($position as $item) {
    $breadcrumb[] = "<a href='{$item['url']}'>{$item['name']}</a>";
}
echo implode(' &gt; ', $breadcrumb);
```

### 片段4：只显示某个分类的子树

```php
// 显示 id=3 分类下的所有子分类
$tree->ret = '';
$html = $tree->get_tree(3, $str);  // 从 id=3 开始
```

---

## 学习路径建议

1. ✅ **阅读本文档** - 理解基本概念（5分钟）
2. ✅ **运行 example1_basic.php** - 看基本效果（10分钟）
3. ✅ **运行 example2_get_tree.php** - 理解参数（15分钟）
4. ✅ **运行 example3_step_by_step.php** - 理解执行过程（20分钟）
5. ✅ **运行 example4_real_world.php** - 看实际应用（10分钟）
6. ✅ **完成 exercises.md 中的练习** - 动手实践（30分钟）
7. ✅ **阅读 tutorial.md** - 深入理解（30分钟）

---

## 下一步

- 📖 详细教程：查看 `tutorial.md`
- 💻 运行示例：查看 `examples/` 目录
- ✏️ 动手练习：查看 `exercises.md`
- 🌐 在浏览器查看：运行 `php -S localhost:8000`

**祝学习愉快！** 🎉

