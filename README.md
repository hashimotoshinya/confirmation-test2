# 確認テスト - mogitate

**mogitate** は、フルーツの擬似販売を行う販売者向けのLaravelアプリケーションです。  
商品（フルーツ）の一覧表示、追加登録、編集、削除などの機能を備えており、フォームにはバリデーション機能も実装されています。

---

## 🔧 使用技術スタック

- Laravel (PHP)
- MySQL 8.0
- Nginx 1.21.1
- Docker / Docker Compose
- phpMyAdmin

---

## 📦 機能一覧

- 商品の一覧表示（カード形式、ページネーション対応）
- 商品の登録（画像、価格、説明、旬の季節など）
- 商品の編集・削除
- 商品の検索・価格による並び替え
- 登録フォームのバリデーション機能
- ER図の設計（`ER.drawio.png`）

---

## 🚀 セットアップ手順

```bash
# リポジトリをクローン
git clone git@github.com:hashimotoshinya/confirmation-test2.git

# Docker起動
docker-compose up -d --build

# PHPコンテナに入る
docker-compose exec your_php_container bash

# Laravelプロジェクトのセットアップ
composer install

# .envファイルの作成と編集
cp .env.example .env
# （必要に応じてDB接続情報を修正）

# アプリケーションキーの生成
php artisan key:generate

# マイグレーションとシーディング
php artisan migrate --seed

# シンボリックリンク作成
php artisan storage:link

---

## 📊 ER図

![ER図](./ER.drawio.png)
