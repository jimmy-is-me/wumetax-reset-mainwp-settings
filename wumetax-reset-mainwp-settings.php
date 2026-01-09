<?php
/**
 * Plugin Name: wumetax-reset-mainwp-settings
 * Description: 強制停用 MainWP Child、重置設定並在執行後自我毀滅（自動刪除）。
 * Version: 1.2.0
 * Author: wumetax
 */

defined('ABSPATH') or die('No script kiddies please!');

/**
 * 核心執行函式
 */
function wumetax_mainwp_child_reset_and_destroy() {
    global $wpdb;

    // 1. 檢查並停用 MainWP Child 外掛（如果目前是啟動狀態）
    if (!function_exists('is_plugin_active')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    
    $mainwp_child_path = 'mainwp-child/mainwp-child.php';
    if (is_plugin_active($mainwp_child_path)) {
        deactivate_plugins($mainwp_child_path);
    }

    // 2. 清理 options 資料表
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}options WHERE option_name LIKE %s",
            '%mainwp_%'
        )
    );

    // 3. 清理 postmeta 資料表
    $wpdb->query(
        $wpdb->prepare(
            "DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE %s",
            '%mainwp_%'
        )
    );

    // 4. 停用自身外掛
    deactivate_plugins(plugin_basename(__FILE__));

    // 5. 自我毀滅：刪除此檔案
    if (file_exists(__FILE__)) {
        unlink(__FILE__);
    }
}

/**
 * 註冊啟用鉤子：點擊「啟用」時觸發
 */
register_activation_hook(__FILE__, 'wumetax_mainwp_child_reset_and_destroy');
