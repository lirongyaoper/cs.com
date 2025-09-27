#!/bin/bash

# Claude Code 国内安装脚本
# 自动检测环境并安装 Claude Code

# 颜色定义
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo -e "${CYAN}Claude Code 国内安装脚本 v1.0${NC}"
echo "=========================================="

# 检查操作系统
check_os() {
    if [[ "$OSTYPE" == "linux-gnu"* ]]; then
        OS="linux"
    elif [[ "$OSTYPE" == "darwin"* ]]; then
        OS="macos"
    elif [[ "$OSTYPE" == "msys" ]] || [[ "$OSTYPE" == "cygwin" ]]; then
        OS="windows"
    else
        OS="unknown"
    fi
    
    echo -e "${BLUE}检测到操作系统：${OS}${NC}"
}

# 检查网络连接
check_network() {
    echo -e "${BLUE}检查网络连接...${NC}"
    
    # 检查是否能访问 Anthropic 官网
    if curl -s --connect-timeout 5 https://www.anthropic.com > /dev/null; then
        echo -e "${GREEN}✓ 可以访问 Anthropic 官网${NC}"
        DIRECT_ACCESS=true
    else
        echo -e "${YELLOW}⚠ 无法直接访问 Anthropic 官网${NC}"
        DIRECT_ACCESS=false
    fi
    
    # 检查是否能访问 npm
    if curl -s --connect-timeout 5 https://registry.npmjs.org > /dev/null; then
        echo -e "${GREEN}✓ 可以访问 npm 仓库${NC}"
        NPM_ACCESS=true
    else
        echo -e "${YELLOW}⚠ 无法访问 npm 仓库${NC}"
        NPM_ACCESS=false
    fi
}

# 安装 Node.js
install_nodejs() {
    echo -e "${BLUE}检查 Node.js 安装...${NC}"
    
    if command -v node &> /dev/null; then
        NODE_VERSION=$(node --version)
        echo -e "${GREEN}✓ Node.js 已安装：${NODE_VERSION}${NC}"
        
        # 检查版本是否满足要求
        if [[ "$NODE_VERSION" =~ v([0-9]+) ]]; then
            MAJOR_VERSION=${BASH_REMATCH[1]}
            if [ "$MAJOR_VERSION" -ge 18 ]; then
                echo -e "${GREEN}✓ Node.js 版本满足要求${NC}"
                return 0
            else
                echo -e "${YELLOW}⚠ Node.js 版本过低，需要 18 或更高版本${NC}"
            fi
        fi
    else
        echo -e "${YELLOW}⚠ Node.js 未安装${NC}"
    fi
    
    echo -e "${BLUE}安装 Node.js...${NC}"
    
    # 使用 nvm 安装 Node.js
    if ! command -v nvm &> /dev/null; then
        echo -e "${BLUE}安装 nvm...${NC}"
        curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
        
        # 重新加载 shell 配置
        if [ -f ~/.bashrc ]; then
            source ~/.bashrc
        fi
        if [ -f ~/.zshrc ]; then
            source ~/.zshrc
        fi
    fi
    
    # 安装 Node.js 18
    nvm install 18
    nvm use 18
    nvm alias default 18
    
    echo -e "${GREEN}✓ Node.js 安装完成${NC}"
}

# 配置 npm 镜像（如果需要）
configure_npm() {
    if [ "$NPM_ACCESS" = false ]; then
        echo -e "${BLUE}配置 npm 镜像...${NC}"
        
        # 使用淘宝镜像
        npm config set registry https://registry.npmmirror.com
        
        echo -e "${GREEN}✓ npm 镜像配置完成${NC}"
    fi
}

# 安装 Claude Code
install_claude_code() {
    echo -e "${BLUE}安装 Claude Code...${NC}"
    
    # 全局安装 Claude Code
    npm install -g @anthropic-ai/claude-code
    
    if [ $? -eq 0 ]; then
        echo -e "${GREEN}✓ Claude Code 安装完成${NC}"
    else
        echo -e "${RED}✗ Claude Code 安装失败${NC}"
        return 1
    fi
}

# 配置 API 密钥
configure_api_key() {
    echo -e "${BLUE}配置 API 密钥...${NC}"
    
    echo -e "${YELLOW}请选择配置方式：${NC}"
    echo "1. 现在配置 API 密钥"
    echo "2. 稍后手动配置"
    
    read -p "请输入选择 (1-2): " choice
    
    case $choice in
        1)
            read -p "请输入您的 Claude API 密钥: " api_key
            if [ -n "$api_key" ]; then
                # 设置环境变量
                export ANTHROPIC_API_KEY="$api_key"
                
                # 添加到 shell 配置文件
                if [ -f ~/.bashrc ]; then
                    echo "export ANTHROPIC_API_KEY=\"$api_key\"" >> ~/.bashrc
                fi
                if [ -f ~/.zshrc ]; then
                    echo "export ANTHROPIC_API_KEY=\"$api_key\"" >> ~/.zshrc
                fi
                
                echo -e "${GREEN}✓ API 密钥配置完成${NC}"
            else
                echo -e "${YELLOW}⚠ 未输入 API 密钥，请稍后手动配置${NC}"
            fi
            ;;
        2)
            echo -e "${YELLOW}请稍后手动配置 API 密钥${NC}"
            ;;
        *)
            echo -e "${YELLOW}⚠ 无效选择，请稍后手动配置${NC}"
            ;;
    esac
}

# 显示使用说明
show_usage() {
    echo -e "${CYAN}Claude Code 使用说明${NC}"
    echo "=========================================="
    echo ""
    echo -e "${BLUE}基本使用：${NC}"
    echo "  claude                    # 启动 Claude Code"
    echo "  claude --help            # 显示帮助信息"
    echo "  claude --version         # 显示版本信息"
    echo ""
    echo -e "${BLUE}常用命令：${NC}"
    echo "  claude generate --prompt '创建 Python 函数'"
    echo "  claude explain --file main.py"
    echo "  claude refactor --file main.py"
    echo "  claude debug --file main.py --error 'error message'"
    echo ""
    echo -e "${BLUE}配置文件：${NC}"
    echo "  配置文件位置：~/.claude/config.json"
    echo "  日志文件位置：~/.claude/logs/"
    echo ""
    echo -e "${BLUE}环境变量：${NC}"
    echo "  ANTHROPIC_API_KEY       # Claude API 密钥"
    echo "  CLAUDE_DEBUG=1          # 启用调试模式"
    echo ""
    echo -e "${BLUE}获取 API 密钥：${NC}"
    echo "  访问：https://console.anthropic.com/"
    echo "  登录您的账号"
    echo "  创建新的 API 密钥"
    echo ""
    
    if [ "$DIRECT_ACCESS" = false ]; then
        echo -e "${YELLOW}网络访问提示：${NC}"
        echo "由于网络限制，您可能需要："
        echo "1. 使用科学上网工具"
        echo "2. 使用国内代理服务"
        echo "3. 配置代理环境变量"
        echo ""
        echo -e "${BLUE}代理配置示例：${NC}"
        echo "  export HTTP_PROXY=http://proxy:port"
        echo "  export HTTPS_PROXY=http://proxy:port"
        echo "  export ALL_PROXY=http://proxy:port"
        echo ""
    fi
    
    echo -e "${BLUE}故障排除：${NC}"
    echo "  claude --debug           # 启用调试模式"
    echo "  claude init              # 重新初始化配置"
    echo "  claude config --reset    # 重置配置"
    echo ""
    echo -e "${GREEN}安装完成！现在可以开始使用 Claude Code 了。${NC}"
}

# 主函数
main() {
    check_os
    check_network
    
    echo ""
    echo -e "${BLUE}开始安装 Claude Code...${NC}"
    echo ""
    
    # 安装步骤
    install_nodejs
    configure_npm
    install_claude_code
    
    if [ $? -eq 0 ]; then
        echo ""
        configure_api_key
        echo ""
        show_usage
    else
        echo -e "${RED}安装失败，请检查错误信息${NC}"
        exit 1
    fi
}

# 显示帮助信息
show_help() {
    echo -e "${CYAN}Claude Code 国内安装脚本${NC}"
    echo ""
    echo "用法："
    echo "  $0                    # 自动安装 Claude Code"
    echo "  $0 --help            # 显示帮助信息"
    echo "  $0 --check           # 检查环境"
    echo ""
    echo "功能："
    echo "  1. 自动检测操作系统"
    echo "  2. 检查网络连接"
    echo "  3. 安装 Node.js 18+"
    echo "  4. 配置 npm 镜像（如需要）"
    echo "  5. 安装 Claude Code"
    echo "  6. 配置 API 密钥"
    echo "  7. 显示使用说明"
    echo ""
    echo "环境要求："
    echo "  - 操作系统：Linux, macOS, Windows"
    echo "  - 网络：能访问 npm 仓库"
    echo "  - 权限：sudo 权限（如需要）"
    echo ""
    echo "注意事项："
    echo "  - 需要有效的 Claude API 密钥"
    echo "  - 可能需要科学上网工具"
    echo "  - 建议使用稳定的网络环境"
}

# 检查环境
check_environment() {
    echo -e "${CYAN}环境检查${NC}"
    echo "=========================================="
    
    check_os
    check_network
    
    echo ""
    echo -e "${BLUE}软件检查：${NC}"
    
    # 检查 Node.js
    if command -v node &> /dev/null; then
        echo -e "${GREEN}✓ Node.js: $(node --version)${NC}"
    else
        echo -e "${RED}✗ Node.js: 未安装${NC}"
    fi
    
    # 检查 npm
    if command -v npm &> /dev/null; then
        echo -e "${GREEN}✓ npm: $(npm --version)${NC}"
    else
        echo -e "${RED}✗ npm: 未安装${NC}"
    fi
    
    # 检查 Claude Code
    if command -v claude &> /dev/null; then
        echo -e "${GREEN}✓ Claude Code: $(claude --version)${NC}"
    else
        echo -e "${RED}✗ Claude Code: 未安装${NC}"
    fi
    
    # 检查 API 密钥
    if [ -n "$ANTHROPIC_API_KEY" ]; then
        echo -e "${GREEN}✓ API 密钥: 已配置${NC}"
    else
        echo -e "${YELLOW}⚠ API 密钥: 未配置${NC}"
    fi
    
    echo ""
    echo -e "${BLUE}网络测试：${NC}"
    
    # 测试 Anthropic API
    if curl -s --connect-timeout 5 https://api.anthropic.com > /dev/null; then
        echo -e "${GREEN}✓ Anthropic API: 可访问${NC}"
    else
        echo -e "${YELLOW}⚠ Anthropic API: 无法访问${NC}"
    fi
    
    # 测试 npm 仓库
    if curl -s --connect-timeout 5 https://registry.npmjs.org > /dev/null; then
        echo -e "${GREEN}✓ npm 仓库: 可访问${NC}"
    else
        echo -e "${YELLOW}⚠ npm 仓库: 无法访问${NC}"
    fi
}

# 检查参数
case "$1" in
    "--help"|"-h")
        show_help
        exit 0
        ;;
    "--check"|"-c")
        check_environment
        exit 0
        ;;
    "")
        main
        ;;
    *)
        echo -e "${RED}未知参数：$1${NC}"
        show_help
        exit 1
        ;;
esac
