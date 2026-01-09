這是一個專為 WordPress 網站開發的輕量化維護工具，旨在一鍵重置 MainWP Child 的所有設定。本外掛採用「執行後即焚」的設計邏輯，確保在清理資料庫殘留數據後，不會佔用伺服器空間或留下安全隱患 。
​

📋 功能特點
徹底清理：自動掃描並刪除 options 與 postmeta 資料表中所有包含 mainwp_ 關鍵字的欄位 。
​

自動化執行：僅需點擊「啟用」，程式便會自動觸發清理邏輯，無需進行額外設定。

自我毀滅 (Self-Destruct)：執行成功後，外掛會自動停用並從伺服器中刪除自身原始碼，實現真正的「一次性使用」 。
​

安全防護：包含基本安全檢查，防止非授權的腳本直接存取 。
​

🚀 安裝與使用
下載檔案：複製 wumetax-reset-mainwp-settings.php 檔案內容。

上傳外掛：透過 FTP 或主機管理面版，將檔案放置於 /wp-content/plugins/ 目錄下。

點擊啟用：

登入 WordPress 後台。

前往「外掛」>「已安裝的外掛」。

找到 wumetax-reset-mainwp-settings 並點擊 啟用。

完成：頁面重整後，外掛將完成任務並自動消失。

⚠️ 注意事項
[!CAUTION]
本操作不可逆。 在執行此工具前，請務必先備份您的資料庫。一旦啟用，所有 MainWP 相關的連線設定、歷史紀錄與 Meta 數據將被永久刪除 。
​

🛠 開發規格
函式前綴：wumetax_

觸發鉤子：register_activation_hook
​

支援版本：支援 PHP 7.4+ 及 WordPress 最新版本。

License
This project is licensed under the GPL-2.0 License.
