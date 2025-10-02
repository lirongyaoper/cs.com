<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree 类学习项目 - 导航页面</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }
        .content {
            padding: 40px;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h2 {
            color: #667eea;
            font-size: 1.8em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 25px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            border-color: #667eea;
        }
        .card h3 {
            color: #333;
            font-size: 1.3em;
            margin-bottom: 10px;
        }
        .card p {
            color: #666;
            font-size: 0.95em;
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .card a {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        .card a:hover {
            background: #764ba2;
        }
        .feature-list {
            list-style: none;
            padding: 0;
        }
        .feature-list li {
            padding: 12px 0;
            padding-left: 30px;
            position: relative;
            color: #555;
        }
        .feature-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #667eea;
            font-weight: bold;
            font-size: 1.2em;
        }
        .quick-start {
            background: #f0f7ff;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .quick-start h3 {
            color: #667eea;
            margin-bottom: 15px;
        }
        .code-block {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-family: 'Courier New', monospace;
            margin: 15px 0;
            line-height: 1.6;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            color: #666;
            border-top: 1px solid #e0e0e0;
        }
        .badge {
            display: inline-block;
            background: #ffc107;
            color: #000;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.75em;
            font-weight: bold;
            margin-left: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🌲 Tree 类学习项目</h1>
            <p>深入理解 PHP Tree 类，掌握树形数据结构处理</p>
        </div>

        <div class="content">
            <!-- 快速开始 -->
            <div class="section">
                <h2>🚀 快速开始</h2>
                <div class="quick-start">
                    <h3>5分钟快速入门</h3>
                    <div class="code-block">// 1. 引入类文件<br>
require_once 'tree.class.php';<br><br>
// 2. 准备数据<br>
$data = [<br>
&nbsp;&nbsp;&nbsp;&nbsp;1 => ['id'=>1, 'parentid'=>0, 'name'=>'A'],<br>
&nbsp;&nbsp;&nbsp;&nbsp;2 => ['id'=>2, 'parentid'=>1, 'name'=>'B'],<br>
];<br><br>
// 3. 使用 Tree 类<br>
$tree = new tree();<br>
$tree->init($data);<br>
$html = $tree->get_tree(0, "\$spacer\$name\n");</div>
                </div>
            </div>

            <!-- 文档资源 -->
            <div class="section">
                <h2>📚 学习文档</h2>
                <div class="card-grid">
                    <div class="card">
                        <h3>快速上手指南 <span class="badge">推荐</span></h3>
                        <p>5分钟快速了解 Tree 类的基本使用方法，包含常见错误和解决方案。</p>
                        <a href="quick_start.md" target="_blank">开始学习 →</a>
                    </div>
                    <div class="card">
                        <h3>完整教程文档</h3>
                        <p>深入讲解 get_tree() 方法原理、递归过程、参数详解等核心内容。</p>
                        <a href="tutorial.md" target="_blank">查看教程 →</a>
                    </div>
                    <div class="card">
                        <h3>项目说明</h3>
                        <p>了解项目结构、学习路径、应用场景等总体介绍。</p>
                        <a href="README.md" target="_blank">查看详情 →</a>
                    </div>
                </div>
            </div>

            <!-- 示例代码 -->
            <div class="section">
                <h2>💻 示例代码</h2>
                <div class="card-grid">
                    <div class="card">
                        <h3>示例1：基础使用</h3>
                        <p>了解 Tree 类的实例化、初始化和基本方法。</p>
                        <a href="examples/example1_basic.php">运行示例 →</a>
                    </div>
                    <div class="card">
                        <h3>示例2：get_tree() 详解 <span class="badge">重点</span></h3>
                        <p>深入理解 get_tree() 方法的每个参数和使用技巧。</p>
                        <a href="examples/example2_get_tree.php">运行示例 →</a>
                    </div>
                    <div class="card">
                        <h3>示例3：逐步执行演示 <span class="badge">重点</span></h3>
                        <p>通过调试信息观察 get_tree() 的递归执行过程。</p>
                        <a href="examples/example3_step_by_step.php">运行示例 →</a>
                    </div>
                    <div class="card">
                        <h3>示例4：实际应用案例</h3>
                        <p>5个真实项目场景：商品分类、导航菜单、权限管理等。</p>
                        <a href="examples/example4_real_world.php">运行示例 →</a>
                    </div>
                </div>
            </div>

            <!-- 练习题 -->
            <div class="section">
                <h2>✏️ 动手练习</h2>
                <div class="card">
                    <h3>10道练习题 - 从入门到精通</h3>
                    <p>通过10道精心设计的练习题，从基础到高级，全面掌握 Tree 类的使用。每题都有详细答案和解析。</p>
                    <ul class="feature-list">
                        <li>基础：数据结构理解、get_child() 方法、模板字符串</li>
                        <li>进阶：递归过程、缩进符号生成</li>
                        <li>实战：商品分类、评论系统、权限管理</li>
                        <li>高级：自定义符号、综合挑战项目</li>
                    </ul>
                    <a href="exercises.md" target="_blank">开始练习 →</a>
                </div>
            </div>

            <!-- 学习路径 -->
            <div class="section">
                <h2>🎯 推荐学习路径</h2>
                <ul class="feature-list">
                    <li><strong>第1步</strong>：阅读 quick_start.md（5分钟）- 快速了解基本概念</li>
                    <li><strong>第2步</strong>：运行 example1_basic.php（10分钟）- 看基本效果</li>
                    <li><strong>第3步</strong>：运行 example2_get_tree.php（15分钟）- 理解参数用法</li>
                    <li><strong>第4步</strong>：运行 example3_step_by_step.php（20分钟）- 理解递归过程</li>
                    <li><strong>第5步</strong>：运行 example4_real_world.php（10分钟）- 学习实际应用</li>
                    <li><strong>第6步</strong>：完成 exercises.md 练习题（30分钟）- 动手实践</li>
                    <li><strong>第7步</strong>：阅读 tutorial.md（30分钟）- 深入理解原理</li>
                </ul>
            </div>

            <!-- 核心知识点 -->
            <div class="section">
                <h2>🔑 核心知识点</h2>
                <div class="card-grid">
                    <div class="card">
                        <h3>树形结构基础</h3>
                        <p>理解节点、父节点、子节点、叶子节点等基本概念。</p>
                    </div>
                    <div class="card">
                        <h3>递归算法</h3>
                        <p>掌握递归调用的原理和执行流程。</p>
                    </div>
                    <div class="card">
                        <h3>数据结构设计</h3>
                        <p>学习如何设计扁平数组表示树形关系。</p>
                    </div>
                    <div class="card">
                        <h3>实际应用</h3>
                        <p>在真实项目中应用树形结构处理数据。</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <p><strong>Tree 类学习项目</strong></p>
            <p>原作者：袁志蒙 | 教学项目整理：2025年10月</p>
            <p style="margin-top: 15px; font-size: 0.9em;">
                💡 提示：建议使用 PHP 内置服务器运行示例<br>
                命令：<code style="background: #e0e0e0; padding: 2px 8px; border-radius: 3px;">php -S localhost:8000</code>
            </p>
        </div>
    </div>
</body>
</html>
