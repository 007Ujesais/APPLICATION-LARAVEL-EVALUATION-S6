# Étape 1: Utiliser une image PHP avec FPM et les outils nécessaires pour Laravel
FROM php:8.1-fpm

# Étape 2: Installer les dépendances nécessaires (librairies PHP et Node.js)
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git npm

# Étape 3: Installer Composer pour la gestion des dépendances PHP
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Étape 4: Installer Node.js (nécessaire pour les dépendances JS de Laravel)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && apt-get install -y nodejs

# Étape 5: Définir le répertoire de travail de l'application
WORKDIR /app

# Étape 6: Copier tous les fichiers du projet dans le conteneur Docker
COPY . /app

# Étape 7: Naviguer dans le répertoire contenant ton projet Laravel
WORKDIR /app/APP-LARAVEL/my-project

# Étape 8: Installer les dépendances PHP avec Composer
RUN composer install --no-dev --optimize-autoloader

# Étape 9: Installer les dépendances JavaScript avec npm (avec --legacy-peer-deps)
RUN npm install --legacy-peer-deps

# Étape 10: Exposer le port sur lequel l'application va tourner
EXPOSE 8000

# Étape 11: Démarrer l'application Laravel avec php artisan serve
CMD php artisan serve --host=0.0.0.0 --port=$PORT
