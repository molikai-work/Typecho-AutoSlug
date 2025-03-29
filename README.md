# Typecho-AutoSlug
一个极简的 Typecho 插件，用于在新建文章时自动填写随机 Slug，  
使用无意义的 Slug 似乎会对 SEO 有负面影响，请注意。

## 原理
当插件被激活时，`AutoSlug_Plugin::activate` 方法被调用，插件通过 `Typecho_Plugin::factory` 将一个 JavaScript 脚本注入到文章编辑页面的底部。

## 安装
这个插件本身非常简单，  
您只需要在 Typecho 的插件目录 `/usr/plugins` 下新建一个名为 `AutoSlug` 的文件夹，  
然后下载仓库中的 `Plugin.php` 文件并添加到 `AutoSlug` 文件夹中即可。

## 设置
~~作者认为不必有设置项，因为本身这个插件足够简单，~~  
~~如果您想设置随机字符串的长度，请直接修改 `Plugin.php` 文件，~~  
~~在 `addAutoSlugScript()` 方法中 echo 的 JavaScript 脚本：~~  
~~将默认值“6”改为您希望的长度即可。~~

---

自 v1.1.0 开始，此插件已有设置页面，  
可在插件设置页面设置生成的随机字符串的长度，您无需再手动更改源码，  
还可以设置将脚本注入到哪个编辑页面中，支持文章页面和独立页面。

## 使用
在启用插件后访问 `撰写新文章` 页面，您应该就可以看见 Slug 输入框中随机生成并自动填写的字符串了。
