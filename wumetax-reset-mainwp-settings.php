<?php
/**
 * Plugin Name: wumetax-reset-mainwp-settings
 * Description: 一次性重置 MainWP Child 設定，執行後將自動停用並刪除此外掛檔案。
 * Version: 1.1.0
 * Author: wumetax
 */

defined('ABSPATH') or die('No script kiddies please!');

/**
 * 核心重置與自我毀滅函式
 */
function wumetax_reset_mainwp_and_self_destruct() {
    global $wpdb;

    // 1. 刪除 options 表中所有包含 mainwp_ 的設定
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}options WHERE option_name LIKE %s",
            '%mainwp_%'
        )
    );

    // 2. 刪除 postmeta 表中所有相關的 meta 鍵值
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE %s",
            '%mainwp_%'
        )
    );

    // 3. 停用自身外掛，避免刪除檔案後 WordPress 產生錯誤提示
    deactivate_plugins(plugin_basename(__FILE__));

    // 4. 執行自我毀滅：刪除此 PHP 檔案
    if (file_exists(__FILE__)) {
        unlink(__FILE__);
    }
}

/**
 * 註冊啟用鉤子
 * 當您在後台點擊「啟用」時，會觸發上述函式
 */
register_activation_hook(__FILE__, 'wumetax_reset_mainwp_and_self_destruct');
