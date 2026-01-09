<?php
/**
 * Plugin Name: wumetax-reset-mainwp-settings
 * Description: [強效版] 停用 MainWP Child、刪除所有自定義資料表與設定，並自我毀滅。
 * Version: 1.3.0
 * Author: wumetax
 */

defined('ABSPATH') or die('No script kiddies please!');

function wumetax_complete_mainwp_wipeout() {
    global $wpdb;

    // 1. 強制停用相關外掛
    if (!function_exists('is_plugin_active')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
    $plugins_to_deactivate = array(
        'mainwp-child/mainwp-child.php',
        'mainwp-child-reports/mainwp-child-reports.php'
    );
    deactivate_plugins($plugins_to_deactivate);

    // 2. 清理 Options 與 Postmeta
    $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}options WHERE option_name LIKE %s", '%mainwp_%'));
    $wpdb->query($wpdb->prepare("DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key LIKE %s", '%mainwp_%'));

    // 3. 刪除 MainWP 專屬的自定義資料表 (如 wp_mainwp_stream, wp_mainwp_stream_meta 等)
    // 透過 SHOW TABLES 指令動態搜尋所有包含 'mainwp_' 的資料表
    $mainwp_tables = $wpdb->get_col(
        $wpdb->prepare("SHOW TABLES LIKE %s", $wpdb->prefix . 'mainwp_%')
    );

    if (!empty($mainwp_tables)) {
        foreach ($mainwp_tables as $table) {
            $wpdb->query("DROP TABLE IF EXISTS $table");
        }
    }

    // 4. 自我毀滅
    deactivate_plugins(plugin_basename(__FILE__));
    if (file_exists(__FILE__)) {
        unlink(__FILE__);
    }
}

register_activation_hook(__FILE__, 'wumetax_complete_mainwp_wipeout');
