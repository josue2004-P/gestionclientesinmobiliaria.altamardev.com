#!/bin/sh
set -e

# Crear directorios críticos por si no existen en el volumen local
mkdir -p /var/www/html/resources/views
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache/data
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Permisos para el usuario www-data
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

if [ "$1" = 'apache2-foreground' ]; then
    echo "Esperando a que la base de datos MySQL esté disponible..."

    # Validación directa mediante un script PHP seguro
    until php -r "
        \$host = 'bd_mysql_inmobiliaria';
        \$db   = 'inmobiliaria';
        \$user = 'root';
        \$pass = getenv('DB_PASSWORD') ?: 'root';

        try {
            \$pdo = new PDO(\"mysql:host=\$host;dbname=\$db;port=3306\", \$user, \$pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 2
            ]);
            exit(0);
        } catch (Exception \$e) {
            exit(1);
        }
    "; do
        echo "MySQL no está listo aún - esperando 2 segundos..."
        sleep 2
    done

    echo "Base de datos conectada con éxito."

    echo "Ejecutando migraciones..."
    php artisan migrate --force

    echo "Optimizando configuración de Laravel..."
    php artisan config:clear || true
    php artisan route:clear || true
    php artisan config:cache
    php artisan route:cache
fi

# Transferir el control al proceso principal
exec "$@"