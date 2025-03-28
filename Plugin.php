<?php
/**
 * 	新建文章时自动生成随机 Slug
 * 
 * @package AutoSlug
 * @author molikai-work
 * @version 1.0
 * @link https://github.com/molikai-work/Typecho-AutoSlug
 */

// 阻止直接访问
if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
}

class AutoSlug_Plugin implements Typecho_Plugin_Interface {
    public static function activate() {
        // 将 addAutoSlugScript 添加到文章编辑页面的底部
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array('AutoSlug_Plugin', 'addAutoSlugScript');
    }

    public static function deactivate() {}

    public static function config(Typecho_Widget_Helper_Form $form) {}

    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}

    public static function addAutoSlugScript() {
        echo <<<EOT
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var slugInput = document.getElementById("slug");
        // 如果 Slug 输入框存在且为空
        if (slugInput && slugInput.value.trim() === "") {
            // 生成一个随机的 Slug
            var randomSlug = Math.random().toString(36).substr(2, 6);
            slugInput.value = randomSlug;
        }
    });
</script>
EOT;
    }
}
