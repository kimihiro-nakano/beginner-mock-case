# beginner-mock-case

サービス名は Atte（アット）、ある企業の勤怠管理システム

制作の目的は人事評価のため、目標は利用者数 100 人達成

## アプリケーション URL

- 開発環境：http://localhost/
- phpMyAdmin；http://localhost:8080/

## 機能一覧

- 会員登録ページ

![スクリーンショット 2024-07-15 15.03.24.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/950355a2-75be-469d-9157-34473e2c19d5/3bd9d03b-0957-49aa-8130-983f2936a7fb.png)

- ログインページ

![スクリーンショット 2024-07-15 15.03.31.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/3f167701-dff7-47fc-857f-5d29fe367f65/d65ca83a-3366-44a5-b439-c66c1842fe7e.png)

- メール確認ページ（認証リンクを送信ボタンをクリックで、

メールアドレスに認証リンク送信）

![スクリーンショット 2024-07-15 15.04.05.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/ccf6369b-b3b3-4f70-a554-87dcf9ba27c6/e1baa9ff-d7ae-4814-8104-463b825b325d.png)

- 認証リンクメールを受信したら、メールアドレスを確認するボタンでログイン

![スクリーンショット 2024-07-15 16.51.33.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/8e71bc53-4326-4de8-bd02-0c3c14204235/7524fda6-9f68-4df8-a934-fdf69a098da3.png)

- 打刻ページ（出勤：日を跨いだ時点で翌日の出勤に切替、休憩：1 日で何度も休憩が可能）

![スクリーンショット 2024-07-15 15.05.50.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/42c1284e-6253-49c9-bc49-23edd71720f5/e5b9aed5-108e-4ff3-a979-2c4ab688f717.png)

- 日付一覧ページ（ページネーション５件ずつ）

![スクリーンショット 2024-07-15 15.06.09.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/9a156b3b-ad71-4ba0-960f-17b74d3cb57b/04dfe97c-292f-4f94-b382-249400f7e402.png)

- ユーザーページ（ユーザー名をクリックするとユーザーごとの勤怠表の表示

ページネーション５件ずつ）

![スクリーンショット 2024-07-15 15.06.19.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/b228aa0e-7a90-4b07-a2f6-fd2dca862e90/bfca0d14-837f-4290-b32d-bc25b196f268.png)

- ユーザーごとの勤怠表ページ（ページネーション５件ずつ)

![スクリーンショット 2024-07-15 15.47.01.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/2b6ecfc9-9c7c-4886-9c79-6d05ec42692d/dd7f8fe4-a259-46da-8c82-c097318434bf.png)

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

![スクリーンショット 2024-07-15 17.01.57.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/7f962f3e-05b2-462a-a9ab-bdb2fc79ef17/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-07-15_17.01.57.png)

## ER 図

![スクリーンショット 2024-07-15 17.19.41.png](https://prod-files-secure.s3.us-west-2.amazonaws.com/c0d15fd2-4f07-47d1-9f08-737c03342766/f9d65d94-2de9-4d55-b3bc-5f8eaae4c638/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88_2024-07-15_17.19.41.png)

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
