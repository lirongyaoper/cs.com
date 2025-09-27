#!/bin/bash

# Claude Code 配置脚本
# 用于快速配置 Claude Code 的各种设置

# 颜色定义
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
PURPLE='\033[0;35m'
CYAN='\033[0;36m'
NC='\033[0m' # No Color

echo -e "${CYAN}Claude Code 配置工具 v1.0${NC}"
echo "=========================================="

# 配置文件路径
CONFIG_DIR="$HOME/.claude"
CONFIG_FILE="$CONFIG_DIR/config.json"
LOG_DIR="$CONFIG_DIR/logs"

# 创建配置目录
create_config_dir() {
    echo -e "${BLUE}创建配置目录...${NC}"
    
    mkdir -p "$CONFIG_DIR"
    mkdir -p "$LOG_DIR"
    
    echo -e "${GREEN}✓ 配置目录创建完成${NC}"
}

# 配置 API 密钥
configure_api_key() {
    echo -e "${BLUE}配置 API 密钥...${NC}"
    
    # 检查是否已有 API 密钥
    if [ -n "$ANTHROPIC_API_KEY" ]; then
        echo -e "${GREEN}✓ 检测到环境变量中的 API 密钥${NC}"
        read -p "是否使用当前 API 密钥？(y/n): " use_current
        if [[ $use_current =~ ^[Yy]$ ]]; then
            return 0
        fi
    fi
    
    echo -e "${YELLOW}请选择配置方式：${NC}"
    echo "1. 输入新的 API 密钥"
    echo "2. 从文件读取 API 密钥"
    echo "3. 跳过配置"
    
    read -p "请输入选择 (1-3): " choice
    
    case $choice in
        1)
            read -p "请输入您的 Claude API 密钥: " api_key
            if [ -n "$api_key" ]; then
                export ANTHROPIC_API_KEY="$api_key"
                save_api_key "$api_key"
                echo -e "${GREEN}✓ API 密钥配置完成${NC}"
            else
                echo -e "${RED}✗ 未输入有效的 API 密钥${NC}"
            fi
            ;;
        2)
            read -p "请输入 API 密钥文件路径: " key_file
            if [ -f "$key_file" ]; then
                api_key=$(cat "$key_file" | tr -d '\n\r')
                export ANTHROPIC_API_KEY="$api_key"
                save_api_key "$api_key"
                echo -e "${GREEN}✓ API 密钥从文件加载完成${NC}"
            else
                echo -e "${RED}✗ 文件不存在：$key_file${NC}"
            fi
            ;;
        3)
            echo -e "${YELLOW}跳过 API 密钥配置${NC}"
            ;;
        *)
            echo -e "${RED}✗ 无效选择${NC}"
            ;;
    esac
}

# 保存 API 密钥到环境变量文件
save_api_key() {
    local api_key="$1"
    
    # 添加到 shell 配置文件
    local shell_configs=("$HOME/.bashrc" "$HOME/.zshrc" "$HOME/.profile")
    
    for config in "${shell_configs[@]}"; do
        if [ -f "$config" ]; then
            # 检查是否已经存在
            if ! grep -q "ANTHROPIC_API_KEY" "$config"; then
                echo "" >> "$config"
                echo "# Claude API Key" >> "$config"
                echo "export ANTHROPIC_API_KEY=\"$api_key\"" >> "$config"
                echo -e "${GREEN}✓ API 密钥已添加到 $config${NC}"
            else
                echo -e "${YELLOW}⚠ $config 中已存在 API 密钥配置${NC}"
            fi
        fi
    done
}

# 创建配置文件
create_config_file() {
    echo -e "${BLUE}创建配置文件...${NC}"
    
    cat > "$CONFIG_FILE" << 'EOF'
{
  "api": {
    "base_url": "https://api.anthropic.com",
    "timeout": 30,
    "max_retries": 3
  },
  "model": {
    "default": "claude-3-sonnet-20240229",
    "max_tokens": 4000,
    "temperature": 0.1
  },
  "editor": {
    "theme": "dark",
    "font_size": 14,
    "tab_size": 2,
    "line_wrapping": true
  },
  "features": {
    "auto_complete": true,
    "code_suggestions": true,
    "error_detection": true,
    "refactoring": true
  },
  "logging": {
    "level": "info",
    "file": "claude.log",
    "max_size": "10MB",
    "max_files": 5
  }
}
EOF

    echo -e "${GREEN}✓ 配置文件创建完成：$CONFIG_FILE${NC}"
}

# 配置代理设置
configure_proxy() {
    echo -e "${BLUE}配置代理设置...${NC}"
    
    echo -e "${YELLOW}是否需要配置代理？${NC}"
    read -p "请输入 (y/n): " need_proxy
    
    if [[ $need_proxy =~ ^[Yy]$ ]]; then
        echo -e "${YELLOW}请选择代理类型：${NC}"
        echo "1. HTTP 代理"
        echo "2. SOCKS 代理"
        echo "3. 自定义代理"
        
        read -p "请输入选择 (1-3): " proxy_type
        
        case $proxy_type in
            1)
                read -p "请输入 HTTP 代理地址 (如: http://proxy:8080): " http_proxy
                if [ -n "$http_proxy" ]; then
                    export HTTP_PROXY="$http_proxy"
                    export HTTPS_PROXY="$http_proxy"
                    echo -e "${GREEN}✓ HTTP 代理配置完成${NC}"
                fi
                ;;
            2)
                read -p "请输入 SOCKS 代理地址 (如: socks5://proxy:1080): " socks_proxy
                if [ -n "$socks_proxy" ]; then
                    export ALL_PROXY="$socks_proxy"
                    echo -e "${GREEN}✓ SOCKS 代理配置完成${NC}"
                fi
                ;;
            3)
                read -p "请输入自定义代理配置: " custom_proxy
                if [ -n "$custom_proxy" ]; then
                    eval "export $custom_proxy"
                    echo -e "${GREEN}✓ 自定义代理配置完成${NC}"
                fi
                ;;
            *)
                echo -e "${RED}✗ 无效选择${NC}"
                ;;
        esac
        
        # 保存代理设置到配置文件
        if [ -n "$HTTP_PROXY" ] || [ -n "$ALL_PROXY" ]; then
            cat >> "$CONFIG_FILE" << EOF
  "proxy": {
    "http": "$HTTP_PROXY",
    "https": "$HTTPS_PROXY",
    "all": "$ALL_PROXY"
  }
EOF
        fi
    else
        echo -e "${YELLOW}跳过代理配置${NC}"
    fi
}

# 配置 VS Code 集成
configure_vscode() {
    echo -e "${BLUE}配置 VS Code 集成...${NC}"
    
    if command -v code &> /dev/null; then
        echo -e "${GREEN}✓ 检测到 VS Code${NC}"
        
        echo -e "${YELLOW}是否安装 Claude Code 扩展？${NC}"
        read -p "请输入 (y/n): " install_extension
        
        if [[ $install_extension =~ ^[Yy]$ ]]; then
            # 安装 Claude Code 扩展
            code --install-extension anthropic.claude-code
            
            if [ $? -eq 0 ]; then
                echo -e "${GREEN}✓ Claude Code 扩展安装完成${NC}"
            else
                echo -e "${RED}✗ 扩展安装失败${NC}"
            fi
        fi
        
        # 配置 VS Code 设置
        echo -e "${YELLOW}是否配置 VS Code 设置？${NC}"
        read -p "请输入 (y/n): " configure_settings
        
        if [[ $configure_settings =~ ^[Yy]$ ]]; then
            VSCODE_SETTINGS="$HOME/.config/Code/User/settings.json"
            
            if [ -f "$VSCODE_SETTINGS" ]; then
                # 备份原设置
                cp "$VSCODE_SETTINGS" "$VSCODE_SETTINGS.backup"
                
                # 添加 Claude Code 设置
                cat >> "$VSCODE_SETTINGS" << 'EOF'
{
  "claude.apiKey": "${env:ANTHROPIC_API_KEY}",
  "claude.model": "claude-3-sonnet-20240229",
  "claude.maxTokens": 4000,
  "claude.temperature": 0.1,
  "claude.autoComplete": true,
  "claude.codeSuggestions": true
}
EOF
                echo -e "${GREEN}✓ VS Code 设置配置完成${NC}"
            else
                echo -e "${YELLOW}⚠ 未找到 VS Code 设置文件${NC}"
            fi
        fi
    else
        echo -e "${YELLOW}⚠ 未检测到 VS Code${NC}"
    fi
}

# 测试配置
test_configuration() {
    echo -e "${BLUE}测试配置...${NC}"
    
    # 测试 API 密钥
    if [ -n "$ANTHROPIC_API_KEY" ]; then
        echo -e "${GREEN}✓ API 密钥已配置${NC}"
        
        # 测试 API 连接
        echo -e "${BLUE}测试 API 连接...${NC}"
        response=$(curl -s -H "Authorization: Bearer $ANTHROPIC_API_KEY" \
                        -H "Content-Type: application/json" \
                        -d '{"model":"claude-3-sonnet-20240229","max_tokens":10,"messages":[{"role":"user","content":"Hello"}]}' \
                        https://api.anthropic.com/v1/messages)
        
        if echo "$response" | grep -q "error"; then
            echo -e "${RED}✗ API 连接测试失败${NC}"
            echo "错误信息：$response"
        else
            echo -e "${GREEN}✓ API 连接测试成功${NC}"
        fi
    else
        echo -e "${YELLOW}⚠ API 密钥未配置${NC}"
    fi
    
    # 测试 Claude Code 命令
    if command -v claude &> /dev/null; then
        echo -e "${GREEN}✓ Claude Code 命令可用${NC}"
        
        # 测试版本
        version=$(claude --version 2>/dev/null)
        if [ $? -eq 0 ]; then
            echo -e "${GREEN}✓ Claude Code 版本：$version${NC}"
        else
            echo -e "${YELLOW}⚠ 无法获取版本信息${NC}"
        fi
    else
        echo -e "${RED}✗ Claude Code 命令不可用${NC}"
    fi
}

# 显示配置信息
show_configuration() {
    echo -e "${CYAN}当前配置信息${NC}"
    echo "=========================================="
    
    echo -e "${BLUE}环境变量：${NC}"
    echo "  ANTHROPIC_API_KEY: ${ANTHROPIC_API_KEY:+已配置}"
    echo "  HTTP_PROXY: ${HTTP_PROXY:-未设置}"
    echo "  HTTPS_PROXY: ${HTTPS_PROXY:-未设置}"
    echo "  ALL_PROXY: ${ALL_PROXY:-未设置}"
    
    echo -e "${BLUE}配置文件：${NC}"
    echo "  配置目录: $CONFIG_DIR"
    echo "  配置文件: $CONFIG_FILE"
    echo "  日志目录: $LOG_DIR"
    
    if [ -f "$CONFIG_FILE" ]; then
        echo -e "${BLUE}配置内容：${NC}"
        cat "$CONFIG_FILE" | python3 -m json.tool 2>/dev/null || cat "$CONFIG_FILE"
    fi
    
    echo ""
    echo -e "${BLUE}使用说明：${NC}"
    echo "  启动 Claude Code: claude"
    echo "  查看帮助: claude --help"
    echo "  查看版本: claude --version"
    echo "  调试模式: CLAUDE_DEBUG=1 claude"
}

# 重置配置
reset_configuration() {
    echo -e "${YELLOW}警告：这将删除所有配置！${NC}"
    read -p "确定要重置配置吗？(y/n): " confirm
    
    if [[ $confirm =~ ^[Yy]$ ]]; then
        rm -rf "$CONFIG_DIR"
        echo -e "${GREEN}✓ 配置已重置${NC}"
    else
        echo -e "${YELLOW}取消重置${NC}"
    fi
}

# 主菜单
show_menu() {
    echo -e "${CYAN}Claude Code 配置菜单${NC}"
    echo "=========================================="
    echo "1. 配置 API 密钥"
    echo "2. 创建配置文件"
    echo "3. 配置代理设置"
    echo "4. 配置 VS Code 集成"
    echo "5. 测试配置"
    echo "6. 显示配置信息"
    echo "7. 重置配置"
    echo "8. 退出"
    echo ""
}

# 主函数
main() {
    create_config_dir
    
    while true; do
        show_menu
        read -p "请选择操作 (1-8): " choice
        
        case $choice in
            1)
                configure_api_key
                ;;
            2)
                create_config_file
                ;;
            3)
                configure_proxy
                ;;
            4)
                configure_vscode
                ;;
            5)
                test_configuration
                ;;
            6)
                show_configuration
                ;;
            7)
                reset_configuration
                ;;
            8)
                echo -e "${GREEN}退出配置工具${NC}"
                break
                ;;
            *)
                echo -e "${RED}无效选择，请重新输入${NC}"
                ;;
        esac
        
        echo ""
        read -p "按回车键继续..."
        echo ""
    done
}

# 显示帮助信息
show_help() {
    echo -e "${CYAN}Claude Code 配置工具${NC}"
    echo ""
    echo "用法："
    echo "  $0                    # 启动配置菜单"
    echo "  $0 --help            # 显示帮助信息"
    echo "  $0 --config          # 快速配置"
    echo "  $0 --test            # 测试配置"
    echo "  $0 --show            # 显示配置信息"
    echo "  $0 --reset           # 重置配置"
    echo ""
    echo "功能："
    echo "  1. 配置 API 密钥"
    echo "  2. 创建配置文件"
    echo "  3. 配置代理设置"
    echo "  4. 配置 VS Code 集成"
    echo "  5. 测试配置"
    echo "  6. 显示配置信息"
    echo "  7. 重置配置"
    echo ""
}

# 检查参数
case "$1" in
    "--help"|"-h")
        show_help
        exit 0
        ;;
    "--config"|"-c")
        create_config_dir
        configure_api_key
        create_config_file
        configure_proxy
        test_configuration
        ;;
    "--test"|"-t")
        test_configuration
        ;;
    "--show"|"-s")
        show_configuration
        ;;
    "--reset"|"-r")
        reset_configuration
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
