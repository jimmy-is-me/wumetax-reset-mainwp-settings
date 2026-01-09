這是一個專門為 MainWP Child 開發的一次性重置工具。旨在協助開發者快速清理資料庫中的 MainWP 殘留設定，並在完成任務後自動移除自身檔案以保持環境簡潔。
​
主要功能
資料庫清理：自動刪除 wp_options 與 wp_postmeta 資料表中所有名稱包含 mainwp_ 的欄位 。
自我刪除：外掛執行完畢後會自動停用並刪除 .php 原始檔案，無需手動進入 FTP 或後台刪除。
​

使用方式
將 wumetax-reset-mainwp-settings.php 上傳至您的 WordPress 外掛目錄 (/wp-content/plugins/)。
進入 WordPress 管理後台的「外掛」頁面。
找到 wumetax-reset-mainwp-settings 並點擊 啟用。
啟用完成後，外掛將立即執行重置邏輯並自動消失。

注意事項
不可逆操作：此動作會永久刪除資料庫中的 MainWP 設定，執行前請確保已完成備份。
單次使用：由於具備自我毀滅功能，若需再次執行，必須重新上傳檔案。
​
版本資訊
Version: 1.1.0

Author: wumetax
