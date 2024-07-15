## Beginner-mock-case

サービス名は Atte（アット）、ある企業の勤怠管理システム

制作の目的は人事評価のため、目標は利用者数 100 人達成

## アプリケーション URL

- 開発環境：http://localhost/
- phpMyAdmin；http://localhost:8080/

## 機能一覧

- 会員登録ページ

![register.png](/register.png)

- ログインページ

![login.png](/login.png)

- メール確認ページ（認証リンクを送信ボタンをクリックで、

メールアドレスに認証リンク送信）

![verifyEmail.png](/verifyEmail.png)

- 認証リンクメールを受信したら、メールアドレスを確認するボタンでログイン

![email.png](/email.png)

- 打刻ページ（出勤：日を跨いだ時点で翌日の出勤に切替、休憩：1 日で何度も休憩が可能）

![attendance.png](/attendance.png)

- 日付一覧ページ（ページネーション５件ずつ）

![index.png](/index.png)

- ユーザーページ（ユーザー名をクリックするとユーザーごとの勤怠表の表示

ページネーション５件ずつ）

![userList.png](/userList.png)

- ユーザーごとの勤怠表ページ（ページネーション５件ずつ）

![userDetail.png](/userDetail.png)

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
- MySQL 15.1

## テーブル設計

![table.png](/table.png)

## ER 図

![er.png](/er.png)

## 環境構築

1. Docker ビルド

```
git clone git@github.com:kimihiro-nakano/beginner-mock-case.git
```

1.  DockerDesktop アプリを立ち上げる

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

1. Laravel 環境構築

```
docker-compose exec php bash
```

1. Composer のインストール

```
 composer install
```

1.  .env.example ファイルから .env を作成し、環境変数を変更

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

1. アプリケーションキーの作成

```
php artisan key:generate
```

1. マイグレーションの実行

```
php artisan migrate
```

1. シーディングの実行

```
php artisan db:seed
```
# beginner-mock-case
