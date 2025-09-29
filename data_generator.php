<?php
/**
 * 测试数据生成器
 * 为 Tree Class 学习项目生成各种测试数据
 */

class TreeDataGenerator {

    /**
     * 生成电商分类数据
     */
    public static function generateEcommerceCategories() {
        return array(
            1 => array('id' => 1, 'parentid' => 0, 'name' => '电子产品', 'description' => '各种电子设备', 'sort' => 1, 'icon' => '📱'),
            2 => array('id' => 2, 'parentid' => 0, 'name' => '服装鞋包', 'description' => '时尚服饰', 'sort' => 2, 'icon' => '👕'),
            3 => array('id' => 3, 'parentid' => 0, 'name' => '家居生活', 'description' => '家居用品', 'sort' => 3, 'icon' => '🏠'),
            4 => array('id' => 4, 'parentid' => 0, 'name' => '运动户外', 'description' => '运动装备', 'sort' => 4, 'icon' => '⚽'),
            5 => array('id' => 5, 'parentid' => 0, 'name' => '美妆护肤', 'description' => '化妆品', 'sort' => 5, 'icon' => '💄'),

            // 电子产品子分类
            6 => array('id' => 6, 'parentid' => 1, 'name' => '手机', 'description' => '智能手机', 'sort' => 1, 'icon' => '📱'),
            7 => array('id' => 7, 'parentid' => 1, 'name' => '电脑', 'description' => '笔记本电脑', 'sort' => 2, 'icon' => '💻'),
            8 => array('id' => 8, 'parentid' => 1, 'name' => '平板', 'description' => '平板电脑', 'sort' => 3, 'icon' => '📟'),
            9 => array('id' => 9, 'parentid' => 1, 'name' => '数码配件', 'description' => '充电器、耳机等', 'sort' => 4, 'icon' => '🔌'),
            10 => array('id' => 10, 'parentid' => 1, 'name' => '智能穿戴', 'description' => '智能手表、手环', 'sort' => 5, 'icon' => '⌚'),

            // 服装鞋包子分类
            11 => array('id' => 11, 'parentid' => 2, 'name' => '男装', 'description' => '男士服装', 'sort' => 1, 'icon' => '👔'),
            12 => array('id' => 12, 'parentid' => 2, 'name' => '女装', 'description' => '女士服装', 'sort' => 2, 'icon' => '👗'),
            13 => array('id' => 13, 'parentid' => 2, 'name' => '童装', 'description' => '儿童服装', 'sort' => 3, 'icon' => '👶'),
            14 => array('id' => 14, 'parentid' => 2, 'name' => '鞋子', 'description' => '各种鞋类', 'sort' => 4, 'icon' => '👟'),
            15 => array('id' => 15, 'parentid' => 2, 'name' => '箱包', 'description' => '包包、行李箱', 'sort' => 5, 'icon' => '👜'),

            // 家居生活子分类
            16 => array('id' => 16, 'parentid' => 3, 'name' => '家具', 'description' => '客厅、卧室家具', 'sort' => 1, 'icon' => '🛋️'),
            17 => array('id' => 17, 'parentid' => 3, 'name' => '厨具', 'description' => '厨房用品', 'sort' => 2, 'icon' => '🍳'),
            18 => array('id' => 18, 'parentid' => 3, 'name' => '床上用品', 'description' => '床单、被子等', 'sort' => 3, 'icon' => '🛏️'),
            19 => array('id' => 19, 'parentid' => 3, 'name' => '家饰', 'description' => '装饰品、摆件', 'sort' => 4, 'icon' => '🖼️'),

            // 手机子分类
            20 => array('id' => 20, 'parentid' => 6, 'name' => 'iPhone', 'description' => '苹果手机', 'sort' => 1, 'icon' => '📱'),
            21 => array('id' => 21, 'parentid' => 6, 'name' => 'Android手机', 'description' => '安卓手机', 'sort' => 2, 'icon' => '📱'),
            22 => array('id' => 22, 'parentid' => 6, 'name' => '老人机', 'description' => '功能手机', 'sort' => 3, 'icon' => '📞'),

            // 电脑子分类
            23 => array('id' => 23, 'parentid' => 7, 'name' => '笔记本电脑', 'description' => '便携式电脑', 'sort' => 1, 'icon' => '💻'),
            24 => array('id' => 24, 'parentid' => 7, 'name' => '台式电脑', 'description' => '桌面电脑', 'sort' => 2, 'icon' => '🖥️'),
            25 => array('id' => 25, 'parentid' => 7, 'name' => '一体机', 'description' => '一体式电脑', 'sort' => 3, 'icon' => '💻'),

            // 男装子分类
            26 => array('id' => 26, 'parentid' => 11, 'name' => 'T恤', 'description' => '男士T恤衫', 'sort' => 1, 'icon' => '👕'),
            27 => array('id' => 27, 'parentid' => 11, 'name' => '衬衫', 'description' => '男士衬衫', 'sort' => 2, 'icon' => '👔'),
            28 => array('id' => 28, 'parentid' => 11, 'name' => '裤子', 'description' => '男士裤子', 'sort' => 3, 'icon' => '👖'),
            29 => array('id' => 29, 'parentid' => 11, 'name' => '外套', 'description' => '男士外套', 'sort' => 4, 'icon' => '🧥'),

            // 家具子分类
            30 => array('id' => 30, 'parentid' => 16, 'name' => '沙发', 'description' => '客厅沙发', 'sort' => 1, 'icon' => '🛋️'),
            31 => array('id' => 31, 'parentid' => 16, 'name' => '茶几', 'description' => '客厅茶几', 'sort' => 2, 'icon' => '☕'),
            32 => array('id' => 32, 'parentid' => 16, 'name' => '书柜', 'description' => '书架、书柜', 'sort' => 3, 'icon' => '📚'),
            33 => array('id' => 33, 'parentid' => 16, 'name' => '床', 'description' => '卧室床铺', 'sort' => 4, 'icon' => '🛏️')
        );
    }

    /**
     * 生成企业组织架构数据
     */
    public static function generateOrganizationStructure() {
        return array(
            1 => array('id' => 1, 'parentid' => 0, 'name' => '总经理办公室', 'description' => '公司最高管理层', 'manager' => '张总', 'icon' => '👨‍💼'),
            2 => array('id' => 2, 'parentid' => 0, 'name' => '董事会', 'description' => '公司决策机构', 'manager' => '李董事长', 'icon' => '🎯'),

            // 总经理办公室下属
            3 => array('id' => 3, 'parentid' => 1, 'name' => '行政部', 'description' => '负责行政事务', 'manager' => '王行政', 'icon' => '📋'),
            4 => array('id' => 4, 'parentid' => 1, 'name' => '财务部', 'description' => '负责财务管理', 'manager' => '刘财务', 'icon' => '💰'),
            5 => array('id' => 5, 'parentid' => 1, 'name' => '人力资源部', 'description' => '负责人力资源', 'manager' => '陈人事', 'icon' => '👥'),

            // 董事会下属
            6 => array('id' => 6, 'parentid' => 2, 'name' => '战略委员会', 'description' => '制定公司战略', 'manager' => '赵战略', 'icon' => '📊'),
            7 => array('id' => 7, 'parentid' => 2, 'name' => '审计委员会', 'description' => '监督审计工作', 'manager' => '孙审计', 'icon' => '🔍'),

            // 业务部门
            8 => array('id' => 8, 'parentid' => 0, 'name' => '技术部', 'description' => '负责技术研发', 'manager' => '李技术总监', 'icon' => '💻'),
            9 => array('id' => 9, 'parentid' => 0, 'name' => '市场部', 'description' => '负责市场营销', 'manager' => '王市场总监', 'icon' => '📢'),
            10 => array('id' => 10, 'parentid' => 0, 'name' => '销售部', 'description' => '负责产品销售', 'manager' => '孙销售总监', 'icon' => '🤝'),

            // 技术部下属
            11 => array('id' => 11, 'parentid' => 8, 'name' => '前端开发组', 'description' => 'Web前端开发', 'manager' => '赵前端', 'icon' => '🖥️'),
            12 => array('id' => 12, 'parentid' => 8, 'name' => '后端开发组', 'description' => '服务器端开发', 'manager' => '钱后端', 'icon' => '⚙️'),
            13 => array('id' => 13, 'parentid' => 8, 'name' => '移动开发组', 'description' => '移动应用开发', 'manager' => '孙移动', 'icon' => '📱'),
            14 => array('id' => 14, 'parentid' => 8, 'name' => '测试组', 'description' => '软件测试', 'manager' => '李测试', 'icon' => '🔬'),
            15 => array('id' => 15, 'parentid' => 8, 'name' => '运维组', 'description' => '系统运维', 'manager' => '周运维', 'icon' => '🛠️'),

            // 市场部下属
            16 => array('id' => 16, 'parentid' => 9, 'name' => '线上营销组', 'description' => '网络营销', 'manager' => '吴线上', 'icon' => '🌐'),
            17 => array('id' => 17, 'parentid' => 9, 'name' => '线下推广组', 'description' => '地面推广', 'manager' => '郑线下', 'icon' => '📢'),
            18 => array('id' => 18, 'parentid' => 9, 'name' => '品牌公关组', 'description' => '品牌宣传', 'manager' => '冯品牌', 'icon' => '🎭'),

            // 销售部下属
            19 => array('id' => 19, 'parentid' => 10, 'name' => '国内销售组', 'description' => '国内市场销售', 'manager' => '褚国内', 'icon' => '🇨🇳'),
            20 => array('id' => 20, 'parentid' => 10, 'name' => '国际销售组', 'description' => '国际市场销售', 'manager' => '卫国际', 'icon' => '🌍'),
            21 => array('id' => 21, 'parentid' => 10, 'name' => '客户服务组', 'description' => '客户服务支持', 'manager' => '蒋客服', 'icon' => '📞'),

            // 行政部下属
            22 => array('id' => 22, 'parentid' => 3, 'name' => '总务组', 'description' => '后勤保障', 'manager' => '沈总务', 'icon' => '🏢'),
            23 => array('id' => 23, 'parentid' => 3, 'name' => '安全组', 'description' => '安全保卫', 'manager' => '韩安全', 'icon' => '🔒'),
            24 => array('id' => 24, 'parentid' => 3, 'name' => '档案组', 'description' => '档案管理', 'manager' => '杨档案', 'icon' => '📁')
        );
    }

    /**
     * 生成地区数据（省市区县）
     */
    public static function generateRegionData() {
        return array(
            1 => array('id' => 1, 'parentid' => 0, 'name' => '北京市', 'description' => '直辖市', 'code' => '110000', 'type' => 'province', 'icon' => '🏙️'),
            2 => array('id' => 2, 'parentid' => 0, 'name' => '上海市', 'description' => '直辖市', 'code' => '310000', 'type' => 'province', 'icon' => '🏙️'),
            3 => array('id' => 3, 'parentid' => 0, 'name' => '广东省', 'description' => '省份', 'code' => '440000', 'type' => 'province', 'icon' => '🌆'),
            4 => array('id' => 4, 'parentid' => 0, 'name' => '江苏省', 'description' => '省份', 'code' => '320000', 'type' => 'province', 'icon' => '🌆'),
            5 => array('id' => 5, 'parentid' => 0, 'name' => '浙江省', 'description' => '省份', 'code' => '330000', 'type' => 'province', 'icon' => '🌆'),

            // 北京市辖区
            6 => array('id' => 6, 'parentid' => 1, 'name' => '朝阳区', 'description' => '北京市辖区', 'code' => '110105', 'type' => 'district', 'icon' => '🏘️'),
            7 => array('id' => 7, 'parentid' => 1, 'name' => '海淀区', 'description' => '北京市辖区', 'code' => '110108', 'type' => 'district', 'icon' => '🏘️'),
            8 => array('id' => 8, 'parentid' => 1, 'name' => '西城区', 'description' => '北京市辖区', 'code' => '110102', 'type' => 'district', 'icon' => '🏘️'),
            9 => array('id' => 9, 'parentid' => 1, 'name' => '东城区', 'description' => '北京市辖区', 'code' => '110101', 'type' => 'district', 'icon' => '🏘️'),

            // 上海市辖区
            10 => array('id' => 10, 'parentid' => 2, 'name' => '黄浦区', 'description' => '上海市辖区', 'code' => '310101', 'type' => 'district', 'icon' => '🏘️'),
            11 => array('id' => 11, 'parentid' => 2, 'name' => '徐汇区', 'description' => '上海市辖区', 'code' => '310104', 'type' => 'district', 'icon' => '🏘️'),
            12 => array('id' => 12, 'parentid' => 2, 'name' => '浦东新区', 'description' => '上海市辖区', 'code' => '310115', 'type' => 'district', 'icon' => '🏘️'),

            // 广东省城市
            13 => array('id' => 13, 'parentid' => 3, 'name' => '深圳市', 'description' => '计划单列市', 'code' => '440300', 'type' => 'city', 'icon' => '🌆'),
            14 => array('id' => 14, 'parentid' => 3, 'name' => '广州市', 'description' => '省会城市', 'code' => '440100', 'type' => 'city', 'icon' => '🌆'),
            15 => array('id' => 15, 'parentid' => 3, 'name' => '东莞市', 'description' => '地级市', 'code' => '441900', 'type' => 'city', 'icon' => '🌆'),

            // 江苏省城市
            16 => array('id' => 16, 'parentid' => 4, 'name' => '南京市', 'description' => '省会城市', 'code' => '320100', 'type' => 'city', 'icon' => '🌆'),
            17 => array('id' => 17, 'parentid' => 4, 'name' => '苏州市', 'description' => '地级市', 'code' => '320500', 'type' => 'city', 'icon' => '🌆'),
            18 => array('id' => 18, 'parentid' => 4, 'name' => '无锡市', 'description' => '地级市', 'code' => '320200', 'type' => 'city', 'icon' => '🌆'),

            // 朝阳区街道
            19 => array('id' => 19, 'parentid' => 6, 'name' => '三里屯街道', 'description' => '朝阳区街道', 'code' => '110105001', 'type' => 'street', 'icon' => '🏠'),
            20 => array('id' => 20, 'parentid' => 6, 'name' => '国贸街道', 'description' => '朝阳区街道', 'code' => '110105002', 'type' => 'street', 'icon' => '🏠'),
            21 => array('id' => 21, 'parentid' => 6, 'name' => '建外街道', 'description' => '朝阳区街道', 'code' => '110105003', 'type' => 'street', 'icon' => '🏠'),

            // 海淀区街道
            22 => array('id' => 22, 'parentid' => 7, 'name' => '中关村街道', 'description' => '海淀区街道', 'code' => '110108001', 'type' => 'street', 'icon' => '🏠'),
            23 => array('id' => 23, 'parentid' => 7, 'name' => '五道口街道', 'description' => '海淀区街道', 'code' => '110108002', 'type' => 'street', 'icon' => '🏠'),
            24 => array('id' => 24, 'parentid' => 7, 'name' => '学院路街道', 'description' => '海淀区街道', 'code' => '110108003', 'type' => 'street', 'icon' => '🏠'),

            // 深圳市辖区
            25 => array('id' => 25, 'parentid' => 13, 'name' => '南山区', 'description' => '深圳市辖区', 'code' => '440305', 'type' => 'district', 'icon' => '🏘️'),
            26 => array('id' => 26, 'parentid' => 13, 'name' => '福田区', 'description' => '深圳市辖区', 'code' => '440304', 'type' => 'district', 'icon' => '🏘️'),
            27 => array('id' => 27, 'parentid' => 13, 'name' => '罗湖区', 'description' => '深圳市辖区', 'code' => '440303', 'type' => 'district', 'icon' => '🏘️')
        );
    }

    /**
     * 生成简单的测试数据（少量数据，便于调试）
     */
    public static function generateSimpleData() {
        return array(
            1 => array('id' => 1, 'parentid' => 0, 'name' => '顶级分类1', 'description' => '第一个顶级分类', 'sort' => 1, 'icon' => '📁'),
            2 => array('id' => 2, 'parentid' => 0, 'name' => '顶级分类2', 'description' => '第二个顶级分类', 'sort' => 2, 'icon' => '📁'),
            3 => array('id' => 3, 'parentid' => 0, 'name' => '顶级分类3', 'description' => '第三个顶级分类', 'sort' => 3, 'icon' => '📁'),

            4 => array('id' => 4, 'parentid' => 1, 'name' => '子分类1-1', 'description' => '第一个子分类', 'sort' => 1, 'icon' => '📄'),
            5 => array('id' => 5, 'parentid' => 1, 'name' => '子分类1-2', 'description' => '第二个子分类', 'sort' => 2, 'icon' => '📄'),
            6 => array('id' => 6, 'parentid' => 1, 'name' => '子分类1-3', 'description' => '第三个子分类', 'sort' => 3, 'icon' => '📄'),

            7 => array('id' => 7, 'parentid' => 2, 'name' => '子分类2-1', 'description' => '分类2的第一个子分类', 'sort' => 1, 'icon' => '📄'),
            8 => array('id' => 8, 'parentid' => 2, 'name' => '子分类2-2', 'description' => '分类2的第二个子分类', 'sort' => 2, 'icon' => '📄'),

            9 => array('id' => 9, 'parentid' => 4, 'name' => '子分类1-1-1', 'description' => '三级分类', 'sort' => 1, 'icon' => '📃'),
            10 => array('id' => 10, 'parentid' => 4, 'name' => '子分类1-1-2', 'description' => '另一个三级分类', 'sort' => 2, 'icon' => '📃'),

            11 => array('id' => 11, 'parentid' => 9, 'name' => '子分类1-1-1-1', 'description' => '四级分类', 'sort' => 1, 'icon' => '📋'),
            12 => array('id' => 12, 'parentid' => 9, 'name' => '子分类1-1-1-2', 'description' => '另一个四级分类', 'sort' => 2, 'icon' => '📋')
        );
    }

    /**
     * 生成文档分类数据
     */
    public static function generateDocumentCategories() {
        return array(
            1 => array('id' => 1, 'parentid' => 0, 'name' => '技术文档', 'description' => '技术相关文档', 'type' => 'category', 'icon' => '💻'),
            2 => array('id' => 2, 'parentid' => 0, 'name' => '管理文档', 'description' => '管理相关文档', 'type' => 'category', 'icon' => '📋'),
            3 => array('id' => 3, 'parentid' => 0, 'name' => '学习资料', 'description' => '学习相关资料', 'type' => 'category', 'icon' => '📚'),

            4 => array('id' => 4, 'parentid' => 1, 'name' => '编程语言', 'description' => '各种编程语言', 'type' => 'subcategory', 'icon' => '💾'),
            5 => array('id' => 5, 'parentid' => 1, 'name' => '框架工具', 'description' => '开发框架和工具', 'type' => 'subcategory', 'icon' => '🔧'),
            6 => array('id' => 6, 'parentid' => 1, 'name' => '数据库', 'description' => '数据库相关', 'type' => 'subcategory', 'icon' => '🗄️'),

            7 => array('id' => 7, 'parentid' => 2, 'name' => '项目管理', 'description' => '项目管理文档', 'type' => 'subcategory', 'icon' => '📊'),
            8 => array('id' => 8, 'parentid' => 2, 'name' => '人力资源', 'description' => '人力资源文档', 'type' => 'subcategory', 'icon' => '👥'),
            9 => array('id' => 9, 'parentid' => 2, 'name' => '财务管理', 'description' => '财务管理文档', 'type' => 'subcategory', 'icon' => '💰'),

            10 => array('id' => 10, 'parentid' => 3, 'name' => '在线课程', 'description' => '在线学习课程', 'type' => 'subcategory', 'icon' => '🎓'),
            11 => array('id' => 11, 'parentid' => 3, 'name' => '电子书', 'description' => '电子书籍', 'type' => 'subcategory', 'icon' => '📖'),
            12 => array('id' => 12, 'parentid' => 3, 'name' => '视频教程', 'description' => '视频学习资料', 'type' => 'subcategory', 'icon' => '🎥'),

            13 => array('id' => 13, 'parentid' => 4, 'name' => 'PHP', 'description' => 'PHP编程语言', 'type' => 'language', 'icon' => '🐘'),
            14 => array('id' => 14, 'parentid' => 4, 'name' => 'JavaScript', 'description' => 'JavaScript编程语言', 'type' => 'language', 'icon' => '📜'),
            15 => array('id' => 15, 'parentid' => 4, 'name' => 'Python', 'description' => 'Python编程语言', 'type' => 'language', 'icon' => '🐍'),
            16 => array('id' => 16, 'parentid' => 4, 'name' => 'Java', 'description' => 'Java编程语言', 'type' => 'language', 'icon' => '☕'),

            17 => array('id' => 17, 'parentid' => 5, 'name' => 'Laravel', 'description' => 'Laravel框架', 'type' => 'framework', 'icon' => '🎼'),
            18 => array('id' => 18, 'parentid' => 5, 'name' => 'React', 'description' => 'React框架', 'type' => 'framework', 'icon' => '⚛️'),
            19 => array('id' => 19, 'parentid' => 5, 'name' => 'Vue.js', 'description' => 'Vue.js框架', 'type' => 'framework', 'icon' => '💚'),
            20 => array('id' => 20, 'parentid' => 5, 'name' => 'Docker', 'description' => 'Docker容器', 'type' => 'tool', 'icon' => '🐳'),

            21 => array('id' => 21, 'parentid' => 6, 'name' => 'MySQL', 'description' => 'MySQL数据库', 'type' => 'database', 'icon' => '🗄️'),
            22 => array('id' => 22, 'parentid' => 6, 'name' => 'MongoDB', 'description' => 'MongoDB数据库', 'type' => 'database', 'icon' => '🍃'),
            23 => array('id' => 23, 'parentid' => 6, 'name' => 'Redis', 'description' => 'Redis缓存', 'type' => 'database', 'icon' => '🔴'),

            24 => array('id' => 24, 'parentid' => 13, 'name' => 'PHP基础', 'description' => 'PHP基础语法', 'type' => 'topic', 'icon' => '📝'),
            25 => array('id' => 25, 'parentid' => 13, 'name' => '面向对象', 'description' => 'PHP面向对象编程', 'type' => 'topic', 'icon' => '🏗️'),
            26 => array('id' => 26, 'parentid' => 13, 'name' => '设计模式', 'description' => 'PHP设计模式', 'type' => 'topic', 'icon' => '🔧')
        );
    }

    /**
     * 打印数据结构，便于查看
     */
    public static function printDataStructure($data, $title = "数据结构") {
        echo "<div style='margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 6px; border-left: 4px solid #007bff;'>";
        echo "<h3 style='margin: 0 0 15px 0; color: #007bff;'>{$title}</h3>";
        echo "<div style='background: white; padding: 15px; border-radius: 4px; font-family: monospace; font-size: 12px; line-height: 1.4; overflow-x: auto;'>";
        echo "Array (\n";
        foreach ($data as $key => $value) {
            echo "    [{$key}] => Array (\n";
            foreach ($value as $k => $v) {
                $displayValue = is_string($v) ? "'{$v}'" : $v;
                echo "        [{$k}] => {$displayValue}\n";
            }
            echo "    )\n\n";
        }
        echo ")";
        echo "</div>";
        echo "</div>";
    }

    /**
     * 获取数据统计信息
     */
    public static function getDataStats($data) {
        $stats = array(
            'total_nodes' => count($data),
            'root_nodes' => 0,
            'max_depth' => 0,
            'total_levels' => 0
        );

        $levelCount = array();

        foreach ($data as $node) {
            $depth = 0;
            $parentid = $node['parentid'];

            // 计算节点深度
            while ($parentid > 0 && isset($data[$parentid])) {
                $depth++;
                $parentid = $data[$parentid]['parentid'];
            }

            $stats['max_depth'] = max($stats['max_depth'], $depth);
            $levelCount[$depth] = ($levelCount[$depth] ?? 0) + 1;

            if ($node['parentid'] == 0) {
                $stats['root_nodes']++;
            }
        }

        $stats['total_levels'] = count($levelCount);

        return $stats;
    }
}

// 生成演示页面
echo "<!DOCTYPE html>
<html lang='zh-CN'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Tree Class 测试数据生成器</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: #f8f9fa;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5em;
        }
        .stats {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .stat-item {
            text-align: center;
            background: rgba(255,255,255,0.1);
            padding: 15px;
            border-radius: 6px;
        }
        .stat-number {
            font-size: 2em;
            font-weight: bold;
            display: block;
        }
        .data-section {
            margin: 30px 0;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }
        .data-header {
            background: #007bff;
            color: white;
            padding: 15px 20px;
            font-size: 1.2em;
            font-weight: 500;
        }
        .data-content {
            padding: 0;
        }
        .code-block {
            background: #2d3748;
            color: #e2e8f0;
            padding: 20px;
            border-radius: 6px;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 13px;
            line-height: 1.5;
            overflow-x: auto;
            margin: 15px 0;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            color: #6c757d;
            border-top: 1px solid #dee2e6;
        }
        .nav {
            margin-bottom: 30px;
            text-align: center;
        }
        .nav a {
            display: inline-block;
            margin: 0 15px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>🌳 Tree Class 测试数据生成器</h1>

        <div class='nav'>
            <a href='#simple'>简单数据</a>
            <a href='#ecommerce'>电商分类</a>
            <a href='#organization'>组织架构</a>
            <a href='#region'>地区数据</a>
            <a href='#document'>文档分类</a>
        </div>";

echo "<h2>📊 数据概览</h2>";

// 生成各种测试数据并显示统计信息
$dataSets = array(
    'simple' => array('generator' => 'generateSimpleData', 'title' => '简单测试数据'),
    'ecommerce' => array('generator' => 'generateEcommerceCategories', 'title' => '电商分类数据'),
    'organization' => array('generator' => 'generateOrganizationStructure', 'title' => '组织架构数据'),
    'region' => array('generator' => 'generateRegionData', 'title' => '地区数据'),
    'document' => array('generator' => 'generateDocumentCategories', 'title' => '文档分类数据')
);

foreach ($dataSets as $key => $dataSet) {
    $data = call_user_func(array('TreeDataGenerator', $dataSet['generator']));
    $stats = TreeDataGenerator::getDataStats($data);

    echo "<div class='stats' id='{$key}'>
        <h3>{$dataSet['title']}</h3>
        <div class='stats-grid'>
            <div class='stat-item'>
                <span class='stat-number'>{$stats['total_nodes']}</span>
                <span>总节点数</span>
            </div>
            <div class='stat-item'>
                <span class='stat-number'>{$stats['root_nodes']}</span>
                <span>根节点数</span>
            </div>
            <div class='stat-item'>
                <span class='stat-number'>{$stats['max_depth']}</span>
                <span>最大深度</span>
            </div>
            <div class='stat-item'>
                <span class='stat-number'>{$stats['total_levels']}</span>
                <span>总层级数</span>
            </div>
        </div>
    </div>";
}

echo "<h2>📋 详细数据结构</h2>";

// 显示详细数据结构
foreach ($dataSets as $key => $dataSet) {
    $data = call_user_func(array('TreeDataGenerator', $dataSet['generator']));
    echo "<div class='data-section'>
        <div class='data-header'>{$dataSet['title']}</div>
        <div class='data-content'>";
    TreeDataGenerator::printDataStructure($data);
    echo "</div>
    </div>";
}

echo "<h2>💻 使用代码</h2>";
echo "<div class='code-block'>";
echo htmlspecialchars('<?php
// 包含数据生成器
require_once \'data_generator.php\';

// 生成简单测试数据
$data = TreeDataGenerator::generateSimpleData();

// 生成电商分类数据
$data = TreeDataGenerator::generateEcommerceCategories();

// 生成组织架构数据
$data = TreeDataGenerator::generateOrganizationStructure();

// 生成地区数据
$data = TreeDataGenerator::generateRegionData();

// 生成文档分类数据
$data = TreeDataGenerator::generateDocumentCategories();

// 使用Tree Class
require_once \'tree.class.php\';
$tree = new tree();
$tree->init($data);

// 生成树形结构
$html = $tree->get_tree(0, \'<option value="$id" $selected>$spacer$name</option>\', $selected_id);
?>');
echo "</div>";

echo "<div class='footer'>
    <p><strong>Tree Class 学习项目</strong> | 测试数据生成器</p>
    <p>为 get_tree() 方法学习提供丰富的测试数据和使用示例</p>
</div>
    </div>
</body>
</html>";

?>
