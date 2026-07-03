# syntax=docker/dockerfile:1
#
# PY4E (Python for Everybody) — PHP/Apache + Tsugi
#
# The site is a Tsugi app. Tsugi is NOT committed to this repo (it is
# gitignored and expected as a ./tsugi subfolder), so we clone + build it here.
#
FROM php:8.4-apache

# ---- System packages & PHP extensions Tsugi needs ---------------------------
RUN set -eux; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libicu-dev \
        libcurl4-openssl-dev \
        libonig-dev \
        default-mysql-client; \
    docker-php-ext-configure gd --with-freetype --with-jpeg; \
    docker-php-ext-install -j"$(nproc)" \
        pdo_mysql \
        mysqli \
        gd \
        zip \
        intl \
        mbstring \
        curl \
        bcmath \
        exif; \
    rm -rf /var/lib/apt/lists/*

# ---- Composer ---------------------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---- Apache configuration ---------------------------------------------------
# The app relies on .htaccess RewriteRules -> tsugi.php, so AllowOverride is on.
RUN a2enmod rewrite headers
RUN set -eux; \
    printf '%s\n' \
        '<Directory /var/www/html>' \
        '    Options -Indexes +FollowSymLinks' \
        '    AllowOverride All' \
        '    Require all granted' \
        '</Directory>' \
        'ServerTokens Prod' \
        'ServerSignature Off' \
        > /etc/apache2/conf-available/py4e.conf; \
    a2enconf py4e

# Recommended PHP production-ish settings + generous upload for media.
RUN { \
        echo 'upload_max_filesize=64M'; \
        echo 'post_max_size=64M'; \
        echo 'memory_limit=256M'; \
        echo 'max_execution_time=120'; \
        echo 'expose_php=Off'; \
    } > /usr/local/etc/php/conf.d/py4e.ini

WORKDIR /var/www/html

# ---- Tsugi framework (cloned + built at image build time) -------------------
# Pin via TSUGI_REPO / TSUGI_REF build args if you need a specific version.
ARG TSUGI_REPO=https://github.com/tsugiproject/tsugi.git
ARG TSUGI_REF=master
RUN set -eux; \
    git clone --depth 1 --branch "${TSUGI_REF}" "${TSUGI_REPO}" tsugi; \
    cd tsugi; \
    composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# ---- Application source ------------------------------------------------------
COPY . /var/www/html/

# Keep the freshly built tsugi/ (the COPY above would not include it since it is
# gitignored, but guard against a stray local checkout being copied over).
# vendor/ inside tsugi is preserved because .dockerignore excludes tsugi/.

RUN chown -R www-data:www-data /var/www/html

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
