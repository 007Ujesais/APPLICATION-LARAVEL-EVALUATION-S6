# Étape 1 : Utiliser l'image officielle PHP 8.2
FROM php:8.2-cli

# Étape 2 : Installer les dépendances nécessaires (comme les extensions PHP, Node.js, etc.)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    zip \
    git \
    npm \
    libpq-dev

# Étape 3 : Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Étape 4 : Installer Node.js (nécessaire pour Vite et les assets frontend)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Étape 5 : Créer et définir le répertoire de travail
WORKDIR /var/www

# Étape 6 : Copier le code source du projet dans le conteneur
COPY . /var/www

# Étape 7 : Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Étape 8 : Installer les dépendances JavaScript avec npm (avec --legacy-peer-deps pour éviter les problèmes de versions)
RUN npm install --legacy-peer-deps

# Étape 9 : Compiler les assets avec Vite
RUN npm run dev

# Étape 10 : Exposer le port 9000 pour PHP-FPM (si utilisé avec un serveur web comme Nginx ou Apache)
EXPOSE 9000

# Étape 11 : Lancer PHP-FPM
CMD ["php", "artisan", "serve"]
