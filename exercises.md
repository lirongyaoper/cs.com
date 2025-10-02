# Tree 类练习题

通过以下练习题，巩固对 Tree 类和 get_tree() 方法的理解。

---

## 练习1：基础数据结构理解 ⭐

### 题目
给定以下数据，请画出对应的树形结构图：

```php
$data = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => 'A'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => 'B'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => 'C'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => 'D'],
    5 => ['id' => 5, 'parentid' => 3, 'name' => 'E'],
];
```

### 答案
<details>
<summary>点击查看答案</summary>

```
A (id=1, parentid=0)
├── C (id=3, parentid=1)
│   └── E (id=5, parentid=3)
└── D (id=4, parentid=1)
B (id=2, parentid=0)
```

</details>

---

## 练习2：get_child() 方法 ⭐

### 题目
使用练习1的数据，回答以下问题：

1. `$tree->get_child(0)` 会返回什么？
2. `$tree->get_child(1)` 会返回什么？
3. `$tree->get_child(3)` 会返回什么？
4. `$tree->get_child(5)` 会返回什么？

### 答案
<details>
<summary>点击查看答案</summary>

1. `[1 => [...], 2 => [...]]` - 返回 A 和 B（顶级节点）
2. `[3 => [...], 4 => [...]]` - 返回 C 和 D（A 的子节点）
3. `[5 => [...]]` - 返回 E（C 的子节点）
4. `false` - 没有子节点（叶子节点）

</details>

---

## 练习3：模板字符串编写 ⭐⭐

### 题目
根据要求编写相应的模板字符串 `$str`：

1. 生成纯文本输出：`├─ 分类名`
2. 生成 HTML select 的 option 标签
3. 生成带链接的列表项：`<li><a href="URL">名称</a></li>`
4. 生成带图标和数量的 div：`<div>📁 名称 (10件)</div>`

### 答案
<details>
<summary>点击查看答案</summary>

```php
// 1. 纯文本
$str = "\$spacer \$name\n";

// 2. option 标签
$str = "<option value='\$id'>\$spacer\$name</option>\n";

// 3. 带链接的列表
$str = "<li><a href='\$url'>\$spacer\$name</a></li>\n";

// 4. 带图标和数量
$str = "<div>\$spacer\$icon \$name (\$count件)</div>\n";
```

</details>

---

## 练习4：选中状态 ⭐⭐

### 题目
使用以下代码，回答问题：

```php
$tree->get_tree(0, $str, 5);
```

1. 哪个节点会被标记为选中？
2. 如果要选中多个节点（id=3 和 id=5），应该怎么写？
3. 如果不需要选中功能，第三个参数应该怎么写？

### 答案
<details>
<summary>点击查看答案</summary>

1. id=5 的节点会被标记为 `selected`
2. `$tree->get_tree(0, $str, [3, 5]);`
3. `$tree->get_tree(0, $str, 0);` 或 `$tree->get_tree(0, $str);`

</details>

---

## 练习5：递归执行过程 ⭐⭐⭐

### 题目
给定以下数据：

```php
$data = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => 'A'],
    2 => ['id' => 2, 'parentid' => 1, 'name' => 'B'],
];
```

执行 `$tree->get_tree(0, "\$spacer\$name\n")`，请写出：
1. 第一次调用时 `$myid` 的值
2. 第二次调用（递归）时 `$myid` 的值
3. 最终输出结果

### 答案
<details>
<summary>点击查看答案</summary>

1. 第一次调用：`$myid = 0`
2. 第二次调用：`$myid = 1`（处理节点1的子节点）
3. 最终输出：
   ```
   A
   └B
   ```

</details>

---

## 练习6：缩进符号生成 ⭐⭐⭐

### 题目
给定以下树形结构：

```
A
├── B
│   └── C
└── D
```

回答以下问题：
1. 节点 B 的 `$spacer` 是什么？
2. 节点 C 的 `$spacer` 是什么？
3. 节点 D 的 `$spacer` 是什么？

### 答案
<details>
<summary>点击查看答案</summary>

1. B: `├` (第一个子节点，不是最后一个)
2. C: `│&nbsp;└` (继承父级的 `│`，加上 `└`)
3. D: `└` (最后一个子节点)

</details>

---

## 练习7：实战 - 商品分类 ⭐⭐⭐⭐

### 题目
创建一个电商网站的商品分类系统，要求：

1. 定义至少3级分类（例如：电子产品 > 手机 > 智能手机）
2. 每个分类包含：id, parentid, name, url
3. 生成一个 HTML 下拉选择框
4. 默认选中某个三级分类

### 参考答案
<details>
<summary>点击查看参考答案</summary>

```php
<?php
require_once 'tree.class.php';

// 1. 定义分类数据
$categories = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '电子产品', 'url' => '/electronics'],
    2 => ['id' => 2, 'parentid' => 0, 'name' => '服装', 'url' => '/clothing'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => '手机', 'url' => '/phone'],
    4 => ['id' => 4, 'parentid' => 1, 'name' => '电脑', 'url' => '/computer'],
    5 => ['id' => 5, 'parentid' => 3, 'name' => '智能手机', 'url' => '/smartphone'],
    6 => ['id' => 6, 'parentid' => 3, 'name' => '老人机', 'url' => '/seniorphone'],
];

// 2. 初始化
$tree = new tree();
$tree->init($categories);

// 3. 生成选择框
$str = "<option value='\$id' \$selected>\$spacer\$name</option>\n";
$current = 5;  // 默认选中"智能手机"

echo "<select name='category'>\n";
echo "<option value=''>请选择分类</option>\n";
echo $tree->get_tree(0, $str, $current);
echo "</select>";
?>
```

</details>

---

## 练习8：实战 - 无限级评论 ⭐⭐⭐⭐

### 题目
创建一个评论回复系统，要求：

1. 支持无限层级回复
2. 每条评论包含：id, parentid, author, content, time
3. 生成 HTML 显示评论和回复
4. 回复的评论有缩进效果

### 参考答案
<details>
<summary>点击查看参考答案</summary>

```php
<?php
require_once 'tree.class.php';

// 1. 评论数据
$comments = [
    1 => ['id' => 1, 'parentid' => 0, 'author' => '张三', 'content' => '文章很棒！', 'time' => '2025-10-01 10:00'],
    2 => ['id' => 2, 'parentid' => 1, 'author' => '李四', 'content' => '同意！', 'time' => '2025-10-01 10:30'],
    3 => ['id' => 3, 'parentid' => 2, 'author' => '王五', 'content' => '我也是', 'time' => '2025-10-01 11:00'],
    4 => ['id' => 4, 'parentid' => 0, 'author' => '赵六', 'content' => '学到了', 'time' => '2025-10-01 11:30'],
];

// 2. 初始化
$tree = new tree();
$tree->init($comments);

// 3. 生成评论 HTML
$str = "
<div style='margin-left: 20px; padding: 10px; border-left: 2px solid #ddd;'>
    <strong>\$author</strong> <span style='color: #999;'>\$time</span>
    <p>\$content</p>
</div>\n";

$str_group = "
<div style='padding: 10px; background: #f5f5f5;'>
    <strong>\$author</strong> <span style='color: #999;'>\$time</span>
    <p>\$content</p>
</div>\n";

echo $tree->get_tree(0, $str, 0, '', $str_group);
?>
```

</details>

---

## 练习9：高级 - 自定义缩进符号 ⭐⭐⭐⭐⭐

### 题目
修改 Tree 类的缩进符号，实现以下效果：

```
Root
|-- Level1-A
|   |-- Level2-A
|   `-- Level2-B
`-- Level1-B
```

### 提示
修改 `$tree->icon` 和 `$tree->nbsp` 属性

### 参考答案
<details>
<summary>点击查看参考答案</summary>

```php
<?php
require_once 'tree.class.php';

$data = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => 'Root'],
    2 => ['id' => 2, 'parentid' => 1, 'name' => 'Level1-A'],
    3 => ['id' => 3, 'parentid' => 1, 'name' => 'Level1-B'],
    4 => ['id' => 4, 'parentid' => 2, 'name' => 'Level2-A'],
    5 => ['id' => 5, 'parentid' => 2, 'name' => 'Level2-B'],
];

$tree = new tree();
$tree->init($data);

// 自定义符号
$tree->icon = ['|', '|--', '`--'];
$tree->nbsp = '   ';

$result = $tree->get_tree(0, "\$spacer\$name\n");
echo "<pre>{$result}</pre>";
?>
```

</details>

---

## 练习10：综合挑战 ⭐⭐⭐⭐⭐

### 题目
创建一个完整的权限管理系统，要求：

1. 定义多级权限（系统管理 > 用户管理 > 查看/添加/编辑/删除）
2. 使用复选框显示所有权限
3. 已选中的权限默认勾选
4. 使用 JavaScript 实现：勾选父级时，自动勾选所有子级
5. 提交时获取所有选中的权限 ID

### 提示
需要结合 HTML、JavaScript 和 PHP

### 参考答案
<details>
<summary>点击查看参考答案</summary>

```php
<?php
require_once 'tree.class.php';

// 1. 权限数据
$permissions = [
    1 => ['id' => 1, 'parentid' => 0, 'name' => '系统管理'],
    2 => ['id' => 2, 'parentid' => 1, 'name' => '用户管理'],
    3 => ['id' => 3, 'parentid' => 2, 'name' => '查看用户'],
    4 => ['id' => 4, 'parentid' => 2, 'name' => '添加用户'],
    5 => ['id' => 5, 'parentid' => 2, 'name' => '编辑用户'],
    6 => ['id' => 6, 'parentid' => 2, 'name' => '删除用户'],
    7 => ['id' => 7, 'parentid' => 1, 'name' => '角色管理'],
    8 => ['id' => 8, 'parentid' => 0, 'name' => '内容管理'],
];

// 2. 当前角色已有权限
$role_permissions = [3, 4, 5];

// 3. 生成权限树
$tree = new tree();
$tree->init($permissions);

$str = "<label style='display: block; padding: 3px 0;'>
    <input type='checkbox' name='permissions[]' value='\$id' \$selected data-parent='\$parentid'> 
    \$spacer\$name
</label>\n";

// 将 selected 替换为 checked
$str = str_replace('selected', 'checked', $str);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>权限管理</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .permission-box { background: #f9f9f9; padding: 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>角色权限设置</h2>
    <form method="POST" action="save_permissions.php">
        <div class="permission-box">
            <?php echo $tree->get_tree(0, $str, $role_permissions); ?>
        </div>
        <button type="submit" style="margin-top: 20px; padding: 10px 30px;">保存权限</button>
    </form>

    <script>
        // 获取所有复选框
        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
        
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const permId = this.value;
                const isChecked = this.checked;
                
                // 如果勾选，则勾选所有子级
                if (isChecked) {
                    checkboxes.forEach(cb => {
                        if (cb.dataset.parent == permId) {
                            cb.checked = true;
                            cb.dispatchEvent(new Event('change'));
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
```

</details>

---

## 练习完成清单

完成以下练习后，打勾 ✅：

- [ ] 练习1：基础数据结构理解
- [ ] 练习2：get_child() 方法
- [ ] 练习3：模板字符串编写
- [ ] 练习4：选中状态
- [ ] 练习5：递归执行过程
- [ ] 练习6：缩进符号生成
- [ ] 练习7：实战 - 商品分类
- [ ] 练习8：实战 - 无限级评论
- [ ] 练习9：高级 - 自定义缩进符号
- [ ] 练习10：综合挑战

---

## 进阶挑战

完成以上练习后，可以尝试：

1. **优化性能**：为大量数据（1000+节点）优化 get_tree() 方法
2. **添加功能**：实现节点排序功能
3. **扩展应用**：结合数据库实现动态分类管理
4. **前端集成**：结合 Vue.js 或 React 实现树形组件
5. **源码改进**：改进 Tree 类，添加更多实用方法

**加油！** 💪

