#!/bin/sh
set -e

cd /var/www/html

# Strictly ensure storage structure exists and has correct permissions
mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Ensure we have an .env file for Artisan.
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Generate APP_KEY if missing.
if [ -z "$(sed -n 's/^APP_KEY=//p' .env | tail -n 1)" ]; then
  php artisan key:generate --force
fi

# Create the storage symlink (safe to ignore failures).
php artisan storage:link >/dev/null 2>&1 || true

# Optional migrations on container start.
if [ "${MIGRATE_ON_START:-0}" = "1" ]; then
  php artisan migrate --force
fi

# Configure Apache to listen on the PORT provided by Railway
if [ -n "$PORT" ]; then
  sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
fi

# Ensure only mpm_prefork is loaded
echo "Cleaning up MPM modules before starting Apache to prevent AH00534..."
rm -f /etc/apache2/mods-enabled/mpm_*.load
rm -f /etc/apache2/mods-enabled/mpm_*.conf
ln -sf /etc/apache2/mods-available/mpm_prefork.load /etc/apache2/mods-enabled/mpm_prefork.load
ln -sf /etc/apache2/mods-available/mpm_prefork.conf /etc/apache2/mods-enabled/mpm_prefork.conf

# Log loaded modules for debugging
echo "Loaded modules in mods-enabled:"
ls -la /etc/apache2/mods-enabled/mpm*

exec "$@"

