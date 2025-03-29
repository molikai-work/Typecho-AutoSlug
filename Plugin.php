<?php
/**
 * 新建文章时自动生成随机 Slug
 * 
 * @package AutoSlug
 * @author molikai-work
 * @version 1.1.0
 * @link https://github.com/molikai-work/Typecho-AutoSlug
 */

if (!defined("__TYPECHO_ROOT_DIR__")) {
    exit();
}

class AutoSlug_Plugin implements Typecho_Plugin_Interface {
    public static function activate() {
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array('AutoSlug_Plugin', 'addAutoSlugScript');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array('AutoSlug_Plugin', 'addAutoSlugScript');
    }

    public static function deactivate() {}

    public static function config(Typecho_Widget_Helper_Form $form) {
        $length = new Typecho_Widget_Helper_Form_Element_Text(
            'slug_length',
            NULL,
            '6',
            _t('随机 Slug 长度'),
            _t('设置生成的随机 Slug 的长度')
        );
        $form->addInput($length->addRule('isInteger', _t('长度必须是整数'))->addRule('min', _t('长度必须大于 0'), 1));

        $pages = new Typecho_Widget_Helper_Form_Element_Checkbox(
            'inject_pages',
            ['post' => _t('文章页面'), 'page' => _t('独立页面')],
            ['post'],
            _t('启用随机 Slug 的页面'),
            _t('需要自动生成并填写随机 Slug 的编辑页面')
        );
        $form->addInput($pages);
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}

    public static function addAutoSlugScript() {
        $options = Typecho_Widget::widget('Widget_Options')->plugin('AutoSlug');
        $slugLength = intval($options->slug_length) > 0 ? intval($options->slug_length) : 6;
        $injectPages = $options->inject_pages;
        $currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');

        if (!in_array($currentPage === 'write-post' ? 'post' : 'page', $injectPages)) {
            return;
        }

        echo <<<EOT
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var slugInput = document.getElementById("slug");
        if (slugInput && slugInput.value.trim() === "") {
            var randomSlug = Math.random().toString(36).substr(2, {$slugLength});
            slugInput.value = randomSlug;
        }
    });
</script>
EOT;
    }
}
