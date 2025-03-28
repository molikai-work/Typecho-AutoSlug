# Typecho-AutoSlug
一个极简的 Typecho 插件，用于在新建文章时自动填写随机 Slug。

## 原理
当插件被激活时，`AutoSlug_Plugin::activate` 方法被调用，插件通过 `Typecho_Plugin::factory` 将一个 JavaScript 脚本注入到文章编辑页面的底部，  

## 安装
这个插件本身非常简单，  
您只需要在 Typecho 的插件目录 `/usr/plugins` 下新建一个名为 `AutoSlug` 的文件夹，  
然后下载仓库中的 `Plugin.php` 文件并添加到 `AutoSlug` 文件夹中即可。

## 设置
作者认为不必有设置项，因为本身这个插件足够简单，  
如果您想设置随机字符串的长度，请直接修改 `Plugin.php` 文件，  
在 `addAutoSlugScript()` 方法中 echo 的 JavaScript 脚本：
```
// 生成一个 0 到 1 之间的随机浮动小数（例如 0.563456789），
// 将这个随机小数转换为一个 36 进制的字符串，
// 从转换后的字符串中截取，从索引 2 开始的 6 个字符（索引 2 是为了去掉 “0.” 部分）
var randomSlug = Math.random().toString(36).substr(2, 6);
```
将默认值“6”改为您希望的长度即可。

## 使用
在启用插件后访问 `撰写新文章` 页面，您应该就可以看见 Slug 输入框中随机生成并自动填写的字符串了。
