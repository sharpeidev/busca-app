FROM php:8.3-fpm

# Instala dependências de PHP.
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Instala extensões do PHP.
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala o Composer.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instala o Node.js (versão 22).
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm@latest

# Define o diretório de trabalho.
WORKDIR /var/www/html/laravel-app

# Copia o conteúdo da pasta laravel-app para o container.
COPY ./laravel-app /var/www/html/laravel-app

# Instala dependências do Composer.
RUN composer install --optimize-autoloader --no-dev

# Ajusta permissões do Laravel.
RUN chown -R www-data:www-data /var/www/html/laravel-app/storage /var/www/html/laravel-app/bootstrap/cache
RUN chmod -R 775 /var/www/html/laravel-app/storage /var/www/html/laravel-app/bootstrap/cache

# Expõe a porta 9000 para o PHP-FPM.
EXPOSE 9000

# Roda o PHP-FPM.
CMD ["php-fpm"]