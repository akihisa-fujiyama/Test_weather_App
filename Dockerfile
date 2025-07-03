# PHP公式イメージ（alpineで軽量化）
FROM php:8.2-fpm-alpine

# 必要なパッケージをインストール
RUN apk add --no-cache \
    bash \
    git \
    curl \
    icu-dev \
    libzip-dev \
    libpng-dev \
    oniguruma-dev \
    && docker-php-ext-install intl pdo_mysql mbstring zip gd

# Composerをインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 作業ディレクトリを作成
WORKDIR /var/www

# プロジェクトファイルをコンテナにコピー
COPY . .

# 依存関係インストール
RUN composer install --optimize-autoloader --no-dev

# ストレージとキャッシュのパーミッション
RUN chmod -R 775 storage bootstrap/cache

# .envをRender用に設定
COPY .env.example .env
RUN php artisan key:generate

# 8000ポートで待ち受け
EXPOSE 8000

# Laravel組み込みサーバーを起動
CMD php artisan serve --host=0.0.0.0 --port=8000
