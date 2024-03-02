# 龍メーカー
Keio Object Hub(KOH)内の龍にまつわる作品を元にした龍のイラストをAIが生成<br>
画像生成AI：Stable Diffusion(Dream Studio)<br>
参考URL：https://studio.kemco.keio.ac.jp/NewYear2024/ryu-maker/ichiran.php

# 概要
ローカル
- dream-studio-i2i.py：画像生成コード
- ryu-api.php：画風選択ページ
- ryu-form-submit.php：画像生成完了ページ
- stable-function.js：ローディング表示js

サーバ
- 

# 使用方法
## データベース作成
テーブル：ukiyoe2023_kuniyoshi

| 名前 | タイプ | 照合順序 | デフォルト値 | その他 |  
| -------- | -------- | ------------------ | ----------------- | -------------- |
|    id    |   int    |  　|  | AUTO_INCREMENT |
|   path   |   text   | utf8mb4_general_ci |  |  |
| datetime | datetime |  | CURRENT_TIMESTAMP |  |

## Discord設定
1. "Midjourney Image Download Server"というサーバを作成
2. Midjourney BotをMidjourney Image Download Serverに追加
3. "ukiyoe_bot"というボットを作成し, Midjourney Image Download Serverに追加

参考URL：https://medium.com/@neonforge/how-to-create-a-discord-bot-to-download-midjourney-images-automatically-python-step-by-step-guide-90b6a8336e82

## デスクトップ配置
以下の画像のように武者絵4枚, 美人画4枚, person.png, Discordをデスクトップに配置<br>
各画像やDiscordのテキストボックスの座標を確認し, midjourney.py内のCoordinateの値を変更<br>
<img src="https://github.com/kemco2019/ukiyoe_kuniyoshi/assets/128669621/fc8b7200-7cd7-4877-81b8-219ce9509432" width="800">

# 実行
** モニタを繋ぐなどし, デスクトップ画面とブラウザ画面を別画面で表示すること **

0. ローカルサーバを起動, download.py, get_url.pyは常時実行
   ```
   php -S 127.0.0.1:8080
   python3 download.py
   python3 get_url.py
   ```
1. camera.phpのロードによりカメラを起動, 撮影(Cキー：撮影, Qキー：カメラ終了)
2. start.phpで武者絵風, 美人画風のいずれかを選択し丸印をクリック
3. making.phpに遷移
4. 画像生成が終わるとfinish.phpに遷移
5. finish.phpで保存ボタンをクリックしサーバに生成画像をアップロード
6. 戻るボタンでstart.phpに戻る
