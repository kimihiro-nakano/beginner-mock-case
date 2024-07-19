# Beginner-mock-case

サービス名は Atte（アット）、ある企業の勤怠管理システム

制作の目的は人事評価のため、目標は利用者数 100 人達成

## アプリケーション URL

- 開発環境：http://localhost/
- phpMyAdmin；http://localhost:8080/

## 機能一覧

- 会員登録ページ

<img src="https://github.com/user-attachments/assets/5dcc1cde-667c-4509-8981-d1ad26735190" alt="register" width="500"/>  

- ログインページ

<img src="https://github.com/user-attachments/assets/a40a3acd-df6c-4b6d-b4f5-ce365ce748f1" alt="login" width="500"/>  

- メール確認ページ（認証リンクを送信ボタンをクリックで、

メールアドレスに認証リンク送信）

<img src="https://github.com/user-attachments/assets/53dad81b-17bd-48eb-843d-1556b998f39e" alt="verifyEmail" width="500"/>  

- 認証リンクメールを受信したら、メールアドレスを確認するボタンでログイン

<img src="https://github.com/user-attachments/assets/7cbe69c7-63fb-49df-a537-332d6e579af3" alt="email" width="500"/>  

- 打刻ページ（出勤：日を跨いだ時点で翌日の出勤に切替、休憩：1 日で何度も休憩が可能）

<img src="https://github.com/user-attachments/assets/e196fa85-68f0-4143-aecf-f8a2c48732fe" alt="email" width="500"/>  

- 日付一覧ページ（ページネーション５件ずつ）

<img src="https://github.com/user-attachments/assets/7a17e1b1-7ca1-49af-8fdb-771197848de8" alt="index" width="500"/>  

- ユーザーページ（ユーザー名をクリックするとユーザーごとの勤怠表の表示

ページネーション５件ずつ）

<img src="https://github.com/user-attachments/assets/0ac0d334-1fbe-4e81-8830-cb4347ee7c74" alt="userList" width="500"/>  

- ユーザーごとの勤怠表ページ（ページネーション５件ずつ）

<img src="https://github.com/user-attachments/assets/01d13c42-dab7-48dd-a3b1-16cc77a5aa11" alt="userDetail" width="500"/>  

【ダミーデータの作成】

- シーダーファイルを使用し、users テーブルにダミーデータを 101 件作成

例

| ユーザー名         | メールアドレス   | パスワード               |
| ------------------ | ---------------- | ------------------------ |
| テストユーザー 1   | test1@test.com   | 11111111                 |
| テストユーザー 8   | test8@test.com   | 88888888                 |
| テストユーザー 100 | test100@test.com | 100100100100100100100100 |

- シーダーファイルを使用し、attendances テーブルに勤務時間のダミーデータを各ユーザー 5 日分を作成
- シーダーファイルを使用し、breakings テーブルに休憩時間のダミーデータを各ユーザー 5 日分を作成

## 使用技術（実行環境）

- PHP 7.4.9
- Laravel 8.83.27
- MySQL 8.0.36

## テーブル設計

<img src="https://github.com/user-attachments/assets/6998d317-1b81-4af9-b92b-8673a8d15e97" alt="table" width="500"/>

## ER 図

<img src="https://github.com/user-attachments/assets/1bd573f1-5fde-48f6-9cc4-858df6217c8e" alt="er" width="500"/>

## 環境構築

1. Docker ビルド

```
git clone git@github.com:kimihiro-nakano/beginner-mock-case.git
```

2.  DockerDesktop アプリを立ち上げる

```
docker-compose up -d --build
```

> Mac の M1・M2 チップの PC の場合、no matching manifest for linux/arm64/v8 in the manifest list entries のメッセージが表示されビルドができないことがあります。 エラーが発生する場合は、docker-compose.yml ファイルの mysql 内に platform の項目を追加で記載してください

```
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```

3. Laravel 環境構築

```
docker-compose exec php bash
```

4. Composer のインストール

```
 composer install
```

5.  .env.example ファイルから .env を作成し、環境変数を変更

```

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
~
MAIL_FROM_ADDRESS=test@example.com
```

6. アプリケーションキーの作成

```
php artisan key:generate
```

7. マイグレーションの実行

```
php artisan migrate
```

8. シーディングの実行

```
php artisan db:seed
```
