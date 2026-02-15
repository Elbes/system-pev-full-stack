FROM php:8.2-fpm

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    zip \
    unzip \
    nginx \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Timezone
RUN echo "America/Sao_Paulo" > /etc/timezone

WORKDIR /var/www

# Copiar projeto
COPY . .

# Instalar dependências Laravel
RUN composer install

# Permissões
RUN chown -R www-data:www-data /var/www

# Remove configs padrão
RUN rm -f /etc/nginx/sites-enabled/*
RUN rm -f /etc/nginx/conf.d/*

# Copia sua config como única
COPY .docker/nginx/conf.d/default.conf /etc/nginx/sites-enabled/default

EXPOSE 80

CMD php-fpm -D && nginx -g "daemon off;"
