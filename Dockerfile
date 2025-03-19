# Étape 1 : Utiliser l'image officielle PHP 8.2-FPM
FROM php:8.2-fpm

# Étape 2 : Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    zip \
    git \
    npm \
    curl \
    libpq-dev \
    && docker-php-ext-install gd pdo pdo_pgsql mbstring

# Étape 3 : Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Étape 4 : Installer Node.js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Étape 5 : Définir le répertoire de travail
WORKDIR /var/www

# Étape 6 : Copier le fichier composer.json et composer.lock avant d'installer les dépendances
COPY composer.json composer.lock ./

# Étape 7 : Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

# Étape 8 : Copier le reste du code source
COPY . .

# Étape 9 : Installer les dépendances JavaScript avec npm
RUN npm install --legacy-peer-deps

# Étape 10 : Compiler les assets avec Vite
RUN npm run build

# Étape 11 : Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Étape 12 : Démarrer le serveur PHP Laravel
CMD ["php-fpm"]
