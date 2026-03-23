#!/bin/sh
set -e

cd /var/www/html

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

exec "$@"

