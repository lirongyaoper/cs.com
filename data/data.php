<?php
$treeData = [
    // 第1层：顶级分类（parentid=0）
    ['id' => 1, 'name' => '前端开发', 'parentid' => 0, 'sort' => 1],
    ['id' => 2, 'name' => '后端开发', 'parentid' => 0, 'sort' => 2],
    ['id' => 3, 'name' => '移动开发', 'parentid' => 0, 'sort' => 3],
    ['id' => 4, 'name' => '数据库技术', 'parentid' => 0, 'sort' => 4],
    ['id' => 5, 'name' => '运维部署', 'parentid' => 0, 'sort' => 5],
    ['id' => 6, 'name' => '测试技术', 'parentid' => 0, 'sort' => 6],

    // 第2层：前端开发子分类（parentid=1）
    ['id' => 7, 'name' => 'HTML/CSS', 'parentid' => 1, 'sort' => 1],
    ['id' => 8, 'name' => 'JavaScript', 'parentid' => 1, 'sort' => 2],
    ['id' => 9, 'name' => '前端框架', 'parentid' => 1, 'sort' => 3],
    ['id' => 10, 'name' => '前端工程化', 'parentid' => 1, 'sort' => 4],

    // 第2层：后端开发子分类（parentid=2）
    ['id' => 11, 'name' => 'PHP开发', 'parentid' => 2, 'sort' => 1],
    ['id' => 12, 'name' => 'Java开发', 'parentid' => 2, 'sort' => 2],
    ['id' => 13, 'name' => 'Python开发', 'parentid' => 2, 'sort' => 3],
    ['id' => 14, 'name' => 'Go开发', 'parentid' => 2, 'sort' => 4],

    // 第2层：移动开发子分类（parentid=3）
    ['id' => 15, 'name' => 'iOS开发', 'parentid' => 3, 'sort' => 1],
    ['id' => 16, 'name' => 'Android开发', 'parentid' => 3, 'sort' => 2],

    // 第2层：数据库技术子分类（parentid=4）
    ['id' => 17, 'name' => 'MySQL', 'parentid' => 4, 'sort' => 1],
    ['id' => 18, 'name' => 'Redis', 'parentid' => 4, 'sort' => 2],

    // 第3层：HTML/CSS子分类（parentid=7）
    ['id' => 19, 'name' => 'HTML5新特性', 'parentid' => 7, 'sort' => 1],
    ['id' => 20, 'name' => 'CSS3动画', 'parentid' => 7, 'sort' => 2],
    ['id' => 21, 'name' => '响应式布局', 'parentid' => 7, 'sort' => 3],

    // 第3层：JavaScript子分类（parentid=8）
    ['id' => 22, 'name' => 'ES6+语法', 'parentid' => 8, 'sort' => 1],
    ['id' => 23, 'name' => 'DOM操作', 'parentid' => 8, 'sort' => 2],
    ['id' => 24, 'name' => 'Ajax请求', 'parentid' => 8, 'sort' => 3],

    // 第3层：前端框架子分类（parentid=9）
    ['id' => 25, 'name' => 'Vue.js', 'parentid' => 9, 'sort' => 1],
    ['id' => 26, 'name' => 'React', 'parentid' => 9, 'sort' => 2],
    ['id' => 27, 'name' => 'Angular', 'parentid' => 9, 'sort' => 3],

    // 第3层：PHP开发子分类（parentid=11）
    ['id' => 28, 'name' => 'Laravel框架', 'parentid' => 11, 'sort' => 1],
    ['id' => 29, 'name' => 'ThinkPHP框架', 'parentid' => 11, 'sort' => 2],
    ['id' => 30, 'name' => 'PHP性能优化', 'parentid' => 11, 'sort' => 3]
];
