#!/bin/bash
set -e

# Run migrations, force runs in production without prompts
echo "Running database migrations..."
php artisan migrate --force

# Start apache in foreground
echo "Starting Apache..."
apache2-foreground
