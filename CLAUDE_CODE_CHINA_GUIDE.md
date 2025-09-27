# Claude Code 国内使用完整指南

## 概述

由于网络限制，国内使用 Claude Code 需要通过特殊方法。本指南提供多种解决方案，帮助您在国内成功使用 Claude Code。

## 方法一：直接使用（需要科学上网）

### 1. 准备工作

#### 科学上网配置
```bash
# 确保科学上网工具稳定运行
# 推荐使用稳定的 VPN 或代理服务
# 测试网络连接
curl -I https://www.anthropic.com
```

#### 注册 Claude 账号
1. 访问 [Anthropic 官网](https://www.anthropic.com/)
2. 使用海外邮箱注册（推荐 Gmail, Outlook）
3. 手机验证可使用接码平台：
   - [5sim.net](https://5sim.net)
   - [sms-activate.org](https://sms-activate.org)

### 2. 订阅会员

#### 方式1：Google Play（安卓）
```bash
# 1. 安装 Google Play Store
# 2. 绑定 Visa/MasterCard 信用卡
# 3. 下载 Claude 应用
# 4. 在应用内订阅 Pro 会员
```

#### 方式2：Apple Store（iOS）
```bash
# 1. 注册美区 Apple ID
# 2. 购买美区礼品卡
# 3. 下载 Claude 应用
# 4. 在应用内订阅 Pro 会员
```

#### 方式3：网页订阅
```bash
# 1. 访问 Claude 网页版
# 2. 使用虚拟信用卡服务
# 3. 直接订阅 Pro 会员
```

### 3. 安装 Claude Code

#### 安装 Node.js
```bash
# 使用 nvm 管理 Node.js 版本
curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash
source ~/.bashrc

# 安装 Node.js 18
nvm install 18
nvm use 18

# 验证安装
node --version
npm --version
```

#### 安装 Claude Code
```bash
# 全局安装 Claude Code
npm install -g @anthropic-ai/claude-code

# 验证安装
claude --version
```

#### 配置 API 密钥
```bash
# 获取 API 密钥
# 访问：https://console.anthropic.com/

# 设置环境变量
export ANTHROPIC_API_KEY="your_api_key_here"

# 永久设置（添加到 ~/.bashrc）
echo 'export ANTHROPIC_API_KEY="your_api_key_here"' >> ~/.bashrc
source ~/.bashrc
```

### 4. 使用 Claude Code

```bash
# 启动 Claude Code
claude

# 或指定项目目录
claude --project /path/to/your/project

# 首次使用需要 OAuth 认证
# 按提示在浏览器中完成认证
```

## 方法二：使用国内代理服务

### 1. 推荐代理服务

#### GAC Claude Code 代理
```bash
# 网站：https://www.51claude.com/claude-code/
# 特点：
# - 支持最新 Sonnet4 和 Opus4 模型
# - 多种套餐选择
# - 稳定的国内访问
```

#### Yoretea Claude Code 高速通道
```bash
# 网站：https://code.yoretea.com/
# 特点：
# - 支持所有主流 IDE
# - 提供 Pro 和 Max 套餐
# - 适合不同使用需求
```

#### DuckCoding Claude Code 服务
```bash
# 网站：https://doc.duckcoding.com/
# 特点：
# - 支持 Windows, macOS, Linux
# - 详细的安装指南
# - API 配置说明
```

### 2. 使用代理服务

#### 注册代理账号
```bash
# 1. 访问代理服务网站
# 2. 注册账号（通常支持国内手机号）
# 3. 选择适合的套餐
# 4. 完成支付（支持微信/支付宝）
```

#### 配置代理服务
```bash
# 根据代理服务商提供的文档配置
# 通常包括：
# 1. 下载客户端或配置 API
# 2. 设置代理参数
# 3. 测试连接
```

## 方法三：自建代理服务

### 1. 使用 Cloudflare Workers

```javascript
// worker.js
addEventListener('fetch', event => {
  event.respondWith(handleRequest(event.request))
})

async function handleRequest(request) {
  const url = new URL(request.url)
  
  // 代理到 Claude API
  if (url.pathname.startsWith('/v1/')) {
    const targetUrl = 'https://api.anthropic.com' + url.pathname + url.search
    
    const modifiedRequest = new Request(targetUrl, {
      method: request.method,
      headers: {
        ...request.headers,
        'Authorization': request.headers.get('Authorization'),
        'Content-Type': 'application/json',
        'x-api-key': request.headers.get('x-api-key')
      },
      body: request.body
    })
    
    const response = await fetch(modifiedRequest)
    return response
  }
  
  return new Response('Not Found', { status: 404 })
}
```

### 2. 使用 Vercel 部署

```bash
# 1. 创建 Vercel 项目
npx vercel create claude-proxy

# 2. 配置代理代码
# 3. 部署到 Vercel
# 4. 配置自定义域名（可选）
```

## 方法四：使用开源替代方案

### 1. Cursor IDE

```bash
# 下载 Cursor IDE
# 官网：https://cursor.sh/
# 特点：
# - 基于 VS Code
# - 集成 AI 编程助手
# - 支持多种 AI 模型
```

### 2. Continue.dev

```bash
# 安装 Continue 扩展
# VS Code 扩展商店搜索 "Continue"
# 特点：
# - 开源 AI 编程助手
# - 支持多种 AI 模型
# - 可配置 API 密钥
```

### 3. Codeium

```bash
# 访问：https://codeium.com/
# 特点：
# - 免费的 AI 编程助手
# - 支持多种编程语言
# - 集成到主流 IDE
```

## 配置和使用技巧

### 1. VS Code 集成

```json
// settings.json
{
  "claude.apiKey": "your_api_key",
  "claude.model": "claude-3-sonnet-20240229",
  "claude.maxTokens": 4000,
  "claude.temperature": 0.1
}
```

### 2. 常用命令

```bash
# 生成代码
claude generate --prompt "创建一个 Python 函数"

# 解释代码
claude explain --file main.py

# 重构代码
claude refactor --file main.py --style "clean code"

# 调试代码
claude debug --file main.py --error "error message"
```

### 3. 配置文件

```yaml
# claude.config.yml
api:
  key: "your_api_key"
  base_url: "https://api.anthropic.com"
  timeout: 30

model:
  default: "claude-3-sonnet-20240229"
  max_tokens: 4000
  temperature: 0.1

editor:
  theme: "dark"
  font_size: 14
  tab_size: 2
```

## 故障排除

### 1. 常见问题

#### 网络连接问题
```bash
# 检查网络连接
ping api.anthropic.com

# 检查代理设置
curl -I --proxy http://proxy:port https://api.anthropic.com

# 测试 API 连接
curl -H "Authorization: Bearer $ANTHROPIC_API_KEY" \
     https://api.anthropic.com/v1/messages
```

#### API 密钥问题
```bash
# 验证 API 密钥
curl -H "Authorization: Bearer $ANTHROPIC_API_KEY" \
     -H "Content-Type: application/json" \
     -d '{"model":"claude-3-sonnet-20240229","max_tokens":10,"messages":[{"role":"user","content":"Hello"}]}' \
     https://api.anthropic.com/v1/messages
```

#### 安装问题
```bash
# 清理 npm 缓存
npm cache clean --force

# 重新安装
npm uninstall -g @anthropic-ai/claude-code
npm install -g @anthropic-ai/claude-code

# 检查权限
sudo npm install -g @anthropic-ai/claude-code
```

### 2. 日志和调试

```bash
# 启用详细日志
export CLAUDE_DEBUG=1

# 查看日志文件
tail -f ~/.claude/logs/claude.log

# 重置配置
rm -rf ~/.claude/config
claude init
```

## 安全注意事项

### 1. API 密钥安全

```bash
# 不要将 API 密钥提交到版本控制
echo "ANTHROPIC_API_KEY=your_key" >> .env
echo ".env" >> .gitignore

# 使用环境变量
source .env
```

### 2. 代理服务安全

```bash
# 选择可信的代理服务商
# 检查服务商的隐私政策
# 避免在不安全的网络环境下使用
# 定期更换 API 密钥
```

## 总结

国内使用 Claude Code 的几种方法：

1. **直接使用**：需要科学上网，适合技术能力强的用户
2. **代理服务**：简单易用，适合大多数用户
3. **自建代理**：完全控制，适合高级用户
4. **开源替代**：免费使用，适合预算有限的用户

选择哪种方法取决于您的技术能力、预算和需求。建议从代理服务开始，逐步探索其他方案。

## 相关资源

- [Claude Code 官方文档](https://docs.anthropic.com/en/docs/claude-code/overview)
- [Anthropic 控制台](https://console.anthropic.com/)
- [Node.js 官网](https://nodejs.org/)
- [VS Code 官网](https://code.visualstudio.com/)
