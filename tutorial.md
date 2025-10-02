# Tree 类完整教程 - 深入理解 get_tree() 方法

## 目录
1. [Tree 类基础概念](#1-tree-类基础概念)
2. [数据结构准备](#2-数据结构准备)
3. [Tree 类的主要方法](#3-tree-类的主要方法)
4. [get_tree() 方法深度解析](#4-get_tree-方法深度解析)
5. [get_tree() 执行流程图解](#5-get_tree-执行流程图解)
6. [参数详解与实例](#6-参数详解与实例)
7. [常见应用场景](#7-常见应用场景)
8. [常见问题解答](#8-常见问题解答)

---

## 1. Tree 类基础概念

### 1.1 什么是树形结构？

树形结构是一种特殊的数据组织方式，具有以下特点：

```
顶级分类（parentid=0）
├── 子分类1（parentid指向顶级）
│   ├── 子分类1-1（parentid指向子分类1）
│   └── 子分类1-2（parentid指向子分类1）
└── 子分类2（parentid指向顶级）
    └── 子分类2-1（parentid指向子分类2）
```

**关键概念：**
- **节点（Node）**: 树中的每个元素
- **根节点（Root）**: 最顶层的节点，parentid 通常为 0
- **父节点（Parent）**: 某个节点的上一层节点
- **子节点（Child）**: 某个节点的下一层节点
- **叶子节点（Leaf）**: 没有子节点的节点

### 1.2 Tree 类能做什么？

Tree 类将扁平的数组数据转换为树形结构展示：

**输入（扁平数组）：**
```php
[
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'电子产品'],
    2 => ['id'=>2, 'parentid'=>0, 'name'=>'服装'],
    3 => ['id'=>3, 'parentid'=>1, 'name'=>'手机'],
    4 => ['id'=>4, 'parentid'=>1, 'name'=>'电脑'],
]
```

**输出（树形HTML）：**
```
电子产品
├─ 手机
└─ 电脑
服装
```

---

## 2. 数据结构准备

### 2.1 标准数据格式

Tree 类要求输入的数组必须具备以下字段：

```php
$data = [
    键名 => [
        'id'       => 节点的唯一标识,
        'parentid' => 父节点的ID（顶级节点为0）,
        'name'     => 节点显示名称,
        // ... 其他自定义字段
    ]
];
```

### 2.2 示例数据

```php
$categories = [
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'电子产品', 'url'=>'/electronics'],
    2 => ['id'=>2, 'parentid'=>0, 'name'=>'图书', 'url'=>'/books'],
    3 => ['id'=>3, 'parentid'=>1, 'name'=>'手机', 'url'=>'/phone'],
    4 => ['id'=>4, 'parentid'=>1, 'name'=>'电脑', 'url'=>'/computer'],
    5 => ['id'=>5, 'parentid'=>3, 'name'=>'苹果手机', 'url'=>'/iphone'],
    6 => ['id'=>6, 'parentid'=>3, 'name'=>'安卓手机', 'url'=>'/android'],
    7 => ['id'=>7, 'parentid'=>2, 'name'=>'小说', 'url'=>'/novel'],
];
```

这个数据表示的树形结构：
```
电子产品 (id=1)
├── 手机 (id=3)
│   ├── 苹果手机 (id=5)
│   └── 安卓手机 (id=6)
└── 电脑 (id=4)
图书 (id=2)
└── 小说 (id=7)
```

---

## 3. Tree 类的主要方法

### 3.1 方法概览

| 方法名 | 功能 | 常用程度 |
|--------|------|----------|
| `init()` | 初始化数据 | ⭐⭐⭐⭐⭐ |
| `get_child()` | 获取子节点 | ⭐⭐⭐⭐⭐ |
| `get_tree()` | 生成树形结构 | ⭐⭐⭐⭐⭐ |
| `get_parent()` | 获取父级的兄弟节点 | ⭐⭐⭐ |
| `get_pos()` | 获取当前位置的面包屑 | ⭐⭐⭐⭐ |

### 3.2 基本使用流程

```php
// 1. 实例化
$tree = new tree();

// 2. 初始化数据
$tree->init($categories);

// 3. 调用方法生成树形结构
$html = $tree->get_tree(0, $template);
```

---

## 4. get_tree() 方法深度解析

### 4.1 方法签名

```php
public function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '')
```

### 4.2 参数详解

#### 参数1: `$myid` (整数)
- **作用**: 指定从哪个节点开始生成树
- **常用值**: 
  - `0` - 从根节点开始，生成整棵树
  - `具体ID` - 从指定节点开始，只生成该节点的子树

**示例：**
```php
// 生成整棵树
$tree->get_tree(0, $str);

// 只生成 id=1 节点下的子树
$tree->get_tree(1, $str);
```

#### 参数2: `$str` (字符串) - **核心参数**
- **作用**: HTML模板字符串，定义每个节点的输出格式
- **可用变量**: 数组中的所有字段都可以使用（通过 `extract()` 提取）
- **特殊变量**:
  - `$id` - 节点ID
  - `$parentid` - 父节点ID
  - `$name` - 节点名称
  - `$spacer` - 缩进符号（自动生成）
  - `$selected` - 选中状态（'selected' 或 ''）

**示例：**
```php
// 简单文本
$str = "\$spacer\$name\n";

// HTML option 标签
$str = "<option value='\$id' \$selected>\$spacer\$name</option>";

// HTML 列表
$str = "<li data-id='\$id'>\$spacer\$name</li>";

// 复杂 HTML
$str = "<div class='item'><a href='\$url'>\$spacer\$name</a></div>";
```

#### 参数3: `$sid` (整数或数组) - 可选
- **作用**: 指定哪些节点应该被标记为选中状态
- **用途**: 在编辑表单中预选某个分类

**示例：**
```php
// 单个选中
$tree->get_tree(0, $str, 3);  // id=3 的节点会被标记为 selected

// 多个选中
$tree->get_tree(0, $str, [3, 5, 7]);  // 多个节点被标记
```

#### 参数4: `$adds` (字符串) - 内部使用
- **作用**: 递归时累积的缩进前缀
- **注意**: 第一次调用时应该为空字符串 ''
- **原理**: 每深入一层，就会添加一个缩进符号

#### 参数5: `$str_group` (字符串) - 可选
- **作用**: 为顶级分类（parentid=0）提供不同的模板
- **用途**: 顶级和子级使用不同的样式

**示例：**
```php
$str = "<option value='\$id'>&nbsp;&nbsp;\$spacer\$name</option>";
$str_group = "<option value='\$id' style='font-weight:bold'>\$name</option>";
$tree->get_tree(0, $str, 0, '', $str_group);
```

### 4.3 返回值

- **类型**: 字符串
- **内容**: 按树形结构组织的 HTML 代码

---

## 5. get_tree() 执行流程图解

### 5.1 整体流程图

```
开始 get_tree($myid=0)
    │
    ├─→ 调用 get_child($myid) 获取子节点
    │       │
    │       └─→ 返回所有 parentid=$myid 的节点
    │
    ├─→ 遍历每个子节点
    │       │
    │       ├─→ 判断是否为最后一个节点
    │       │       ├─ 是 → 使用 └ 符号
    │       │       └─ 否 → 使用 ├ 符号
    │       │
    │       ├─→ 构建缩进符号 $spacer
    │       │
    │       ├─→ 判断是否选中
    │       │
    │       ├─→ 使用 extract() 提取数组字段
    │       │
    │       ├─→ 使用 eval() 执行模板字符串
    │       │
    │       ├─→ 将结果追加到 $this->ret
    │       │
    │       └─→ 递归调用 get_tree(子节点ID)  ← 关键！
    │
    └─→ 返回 $this->ret
```

### 5.2 递归过程详解

假设有以下数据：
```php
1 => ['id'=>1, 'parentid'=>0, 'name'=>'A'],
2 => ['id'=>2, 'parentid'=>1, 'name'=>'B'],
3 => ['id'=>3, 'parentid'=>1, 'name'=>'C'],
4 => ['id'=>4, 'parentid'=>2, 'name'=>'D'],
```

树形结构：
```
A (1)
├── B (2)
│   └── D (4)
└── C (3)
```

**执行步骤：**

```
第1次调用: get_tree(0)
    获取子节点: [1]
    处理节点1 (A)
        spacer = ''
        输出: "A"
        
        第2次调用: get_tree(1, adds='│ ')
            获取子节点: [2, 3]
            处理节点2 (B) - 不是最后一个
                spacer = '├'
                输出: "├B"
                
                第3次调用: get_tree(2, adds='│ │ ')
                    获取子节点: [4]
                    处理节点4 (D) - 是最后一个
                        spacer = '│ │ └'
                        输出: "│ │ └D"
                        
                        第4次调用: get_tree(4)
                            获取子节点: [] (空)
                            返回
            
            处理节点3 (C) - 是最后一个
                spacer = '│ └'
                输出: "│ └C"
                
                第5次调用: get_tree(3)
                    获取子节点: [] (空)
                    返回
```

### 5.3 缩进符号的构建逻辑

```php
// 当前是否为最后一个节点？
if($number == $total) {
    $j = '└';  // 是 → 使用 └
} else {
    $j = '├';  // 否 → 使用 ├
    $k = $adds ? '│' : '';  // 如果有前缀，添加竖线
}

// 构建完整的缩进
$spacer = $adds ? $adds.$j : '';
```

**示例：**

```
层级1: $adds='',      $j='├'  →  $spacer = '├'
层级2: $adds='│ ',    $j='└'  →  $spacer = '│ └'
层级3: $adds='│ │ ', $j='├'  →  $spacer = '│ │ ├'
```

### 5.4 关键代码逐行解析

```php
public function get_tree($myid, $str, $sid = 0, $adds = '', $str_group = '') {
    $number = 1;  // 计数器，用于判断是否为最后一个节点
    
    // ① 获取当前节点的所有子节点
    $child = $this->get_child($myid);
    
    // ② 如果有子节点
    if(is_array($child)) {
        $total = count($child);  // 子节点总数
        
        // ③ 遍历每个子节点
        foreach($child as $id => $value) {
            $j = $k = '';
            
            // ④ 判断是否为最后一个节点，决定使用什么符号
            if($number == $total) {
                $j .= $this->icon[2];  // └
            } else {
                $j .= $this->icon[1];  // ├
                $k = $adds ? $this->icon[0] : '';  // │
            }
            
            // ⑤ 构建缩进符号
            $spacer = $adds ? $adds.$j : '';
            
            // ⑥ 处理选中状态
            $selected = '';
            if(is_array($sid)) {
                $selected = in_array($id, $sid) ? 'selected' : '';
            } else {
                $selected = $id == $sid ? 'selected' : '';
            }
            
            // ⑦ 提取数组字段为变量
            // 例如: ['id'=>3, 'name'=>'手机'] 
            // 会生成: $id=3, $name='手机'
            @extract($value);
            
            // ⑧ 根据是否为顶级分类选择模板
            $parentid == 0 && $str_group 
                ? eval("\$nstr = \"$str_group\";") 
                : eval("\$nstr = \"$str\";");
            
            // ⑨ 追加到结果字符串
            $this->ret .= $nstr;
            
            // ⑩ 递归调用，处理子节点的子节点
            $nbsp = $this->nbsp;
            $this->get_tree($id, $str, $sid, $adds.$k.$nbsp, $str_group);
            
            $number++;  // 计数器加1
        }
    }
    
    return $this->ret;  // 返回最终结果
}
```

---

## 6. 参数详解与实例

### 6.1 模板字符串 `$str` 的使用

#### 实例1: 生成下拉列表

```php
$str = "<option value='\$id' \$selected>\$spacer\$name</option>";
$html = $tree->get_tree(0, $str);
```

**输出：**
```html
<option value='1'>电子产品</option>
<option value='3'>├手机</option>
<option value='5'>│&nbsp;├苹果手机</option>
<option value='6'>│&nbsp;└安卓手机</option>
<option value='4'>└电脑</option>
```

#### 实例2: 生成无序列表

```php
$str = "<li data-id='\$id' class='\$selected'>\$spacer\$name</li>";
$html = $tree->get_tree(0, $str);
```

#### 实例3: 生成链接菜单

```php
$str = "<div><a href='\$url'>\$spacer\$name</a></div>";
$html = $tree->get_tree(0, $str);
```

#### 实例4: 使用自定义字段

假设数据中有 `icon` 和 `count` 字段：
```php
$data = [
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'分类A', 'icon'=>'📁', 'count'=>10],
];

$str = "<div>\$spacer\$icon \$name (\$count)</div>";
```

**输出：**
```
📁 分类A (10)
```

### 6.2 选中状态 `$sid` 的使用

#### 场景: 编辑文章时选择分类

```php
// 当前文章属于 id=5 的分类
$current_category = 5;

$str = "<option value='\$id' \$selected>\$spacer\$name</option>";
$html = $tree->get_tree(0, $str, $current_category);
```

**结果：** id=5 的 option 会有 `selected` 属性

### 6.3 分组模板 `$str_group` 的使用

```php
// 普通子分类
$str = "<option value='\$id' \$selected>&nbsp;&nbsp;\$spacer\$name</option>";

// 顶级分类（加粗显示）
$str_group = "<option value='\$id' \$selected style='font-weight:bold'>\$name</option>";

$html = $tree->get_tree(0, $str, 0, '', $str_group);
```

**输出：**
```html
<option value='1' style='font-weight:bold'>电子产品</option>
<option value='3' selected>&nbsp;&nbsp;├手机</option>
<option value='5'>&nbsp;&nbsp;│&nbsp;├苹果手机</option>
```

---

## 7. 常见应用场景

### 7.1 场景1: 网站分类导航

```php
$tree = new tree();
$tree->init($categories);

// 生成下拉选择框
$str = "<option value='\$id' \$selected>\$spacer\$name</option>";
$html = '<select name="category">' . $tree->get_tree(0, $str) . '</select>';
```

### 7.2 场景2: 后台菜单

```php
$str = "<li><a href='\$url' data-id='\$id'>\$spacer\$name</a></li>";
$menu = '<ul class="menu">' . $tree->get_tree(0, $str) . '</ul>';
```

### 7.3 场景3: 权限管理

```php
// $user_permissions 是用户已有的权限ID数组
$str = "<label><input type='checkbox' name='perms[]' value='\$id' \$selected> \$spacer\$name</label><br>";
$html = $tree->get_tree(0, $str, $user_permissions);
```

### 7.4 场景4: 只显示某个分类的子树

```php
// 只显示 id=1 下的所有子分类
$html = $tree->get_tree(1, $str);
```

---

## 8. 常见问题解答

### Q1: 为什么我的树形结构显示不正确？

**A:** 检查以下几点：
1. 数据数组的键名必须是节点的 ID
2. 确保每个节点都有 `id` 和 `parentid` 字段
3. `parentid` 必须指向存在的节点（或为 0）
4. 不能有循环引用（A的父是B，B的父是A）

### Q2: 如何自定义缩进符号？

**A:** 修改 `$tree->icon` 属性：
```php
$tree = new tree();
$tree->icon = ['|', '+--', '`--'];  // 自定义符号
$tree->nbsp = '&nbsp;&nbsp;';        // 自定义空格
```

### Q3: eval() 是否有安全风险？

**A:** 
- 在此场景下，`$str` 是开发者自己定义的，不是用户输入，所以相对安全
- 如果 `$str` 来自用户输入，确实有风险，需要严格过滤

### Q4: 如何生成 JSON 格式而不是 HTML？

**A:** 不建议用 `get_tree()` 生成 JSON，而应该：
```php
// 使用递归函数自己构建数组
function buildTreeArray($tree, $myid) {
    $result = [];
    $children = $tree->get_child($myid);
    if ($children) {
        foreach ($children as $id => $item) {
            $item['children'] = buildTreeArray($tree, $id);
            $result[] = $item;
        }
    }
    return $result;
}

$treeArray = buildTreeArray($tree, 0);
$json = json_encode($treeArray);
```

### Q5: 如何处理大量数据的性能问题？

**A:** 
1. 使用缓存存储生成的 HTML
2. 考虑延迟加载（只加载顶级，点击时 AJAX 加载子级）
3. 对于超大树（1000+节点），考虑使用专门的树形组件库

### Q6: 如何添加节点属性（如 CSS class）？

**A:** 在数据中添加字段，然后在模板中使用：
```php
$data = [
    1 => ['id'=>1, 'parentid'=>0, 'name'=>'分类A', 'css_class'=>'important'],
];

$str = "<div class='\$css_class'>\$spacer\$name</div>";
```

---

## 总结

### get_tree() 方法的核心思想

1. **递归遍历**: 从指定节点开始，递归访问所有子节点
2. **动态缩进**: 根据层级自动生成缩进符号
3. **灵活模板**: 通过模板字符串自定义输出格式
4. **状态管理**: 支持选中状态的标记

### 学习建议

1. **理解递归**: get_tree() 的核心是递归，务必理解递归的原理
2. **调试输出**: 在学习时，可以在方法中添加 `echo` 语句观察执行流程
3. **动手实践**: 修改示例代码，尝试不同的模板和数据
4. **阅读源码**: 反复阅读 tree.class.php 的源码，理解每一行

### 进阶方向

1. 学习其他方法：`get_pos()`, `get_parent()`, `get_child()`
2. 研究 `get_tree_multi()` 和 `get_tree_category()` 的区别
3. 尝试修改源码，添加新功能
4. 结合前端框架（Vue、React）实现动态树

---

**下一步**: 运行 `examples/` 目录下的示例代码，观察实际效果！

