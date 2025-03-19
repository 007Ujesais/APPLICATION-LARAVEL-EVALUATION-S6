# Étape 1 : Utiliser PHP 8.2 avec PHP-FPM
FROM php:8.2-fpm

# Étape 2 : Éviter les crashs mémoire sur Railway
RUN fallocate -l 1G /swapfile && chmod 600 /swapfile && mkswap /swapfile && swapon /swapfile

# Étape 3 : Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev unzip zip git npm curl libpq-dev \
    && docker-php-ext-install gd pdo pdo_pgsql mbstring

# Étape 4 : Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Étape 5 : Installer Node.js (pour Laravel Vite)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Étape 6 : Définir le dossier de travail
WORKDIR /var/www

# Étape 7 : Copier composer.json et composer.lock
COPY composer.json composer.lock ./

# Étape 8 : Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Étape 9 : Copier le reste du projet
COPY . .

# Étape 10 : Installer les dépendances npm (frontend)
RUN npm install --legacy-peer-deps

# Étape 11 : Compiler les assets avec Vite
RUN npm run build

# Étape 12 : Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Étape 13 : Démarrer PHP-FPM pour servir Laravel
CMD ["php-fpm"]
