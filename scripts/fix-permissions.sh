#!/bin/bash

# Fix Laravel permissions script
echo "Fixing Laravel permissions..."

# Clear compiled views and cache
sudo rm -rf storage/framework/views/*
sudo rm -rf storage/framework/cache/*

# Set proper ownership
sudo chown -R www-data:www-data storage/ bootstrap/cache/

# Set proper permissions
sudo chmod -R 775 storage/ bootstrap/cache/

# Add sticky bit to prevent future issues
sudo chmod -R g+s storage/ bootstrap/cache/

# Clear Laravel caches
php artisan config:clear
php artisan view:clear

echo "Permissions fixed successfully!"
echo "You can now run: php artisan serve"
