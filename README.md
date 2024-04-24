# 龍メーカー
Keio Object Hub(KOH)内の龍にまつわる作品を元にした龍のイラストをAIが生成<br>
画像生成AI：Stable Diffusion<br>
参考URL：https://studio.kemco.keio.ac.jp/NewYear2024/ryu-maker/ichiran.php

# 概要
ローカル
- dream-studio-i2i.py：画像生成コード
- ryu-api.php：画風選択ページ
- ryu-form-submit.php：画像生成完了ページ
- stable-function.js：ローディング表示js

サーバ
- upload.php：アップロード完了ページ
- ichiran.php：完成画像一覧ページ
- ichiran.js：トップボタン表示js

# 使用方法
## データベース作成
テーブル：ryu_ai

| 名前 | タイプ | 照合順序 | デフォルト値 | その他 |  
| -------- | -------- | ------------------ | ----------------- | -------------- |
|    id    |   int    |  　|  | AUTO_INCREMENT |
|   path   |   text   | utf8mb4_general_ci |  |  |
| datetime | datetime |  | CURRENT_TIMESTAMP |  |
|   url    |   text   | utf8mb4_general_ci |  |  |

## APIキーの取得
1. Stability AIのアカウント登録をし, アカウントページからAPIキーを取得<br>
無料クレジットは25クレジットのみで, 10ドル1000クレジットで購入が必要<br>
参考URL：https://platform.stability.ai/docs/getting-started
2. Keio Object HubのAPIキーを取得

## コードの書き換え
以下の値を適切な値, 文字列に書き換える
- upload.php：YOUR_PATH
- dream-studio-i2i.py：YOUR_STABILITY_AI_API_KEY
- ryu-api.php, ryu-form-submit.php：YOUR_KOH_API_KEY

# 実行
0. ローカルサーバを起動
   ```
   php -S 127.0.0.1:8080
   ```
1. ryu-api.phpのプルダウンで画風を選択
2. ryu-form-submit.phpの保存ボタンで生成画像をサーバにアップロード
3. uploadページの戻るボタンでryu-api.phpに戻る
