#!/bin/bash
set -e

# Set default port to 80 if PORT is not set
PORT="${PORT:-80}"

# Update Apache ports.conf and default site config with the actual numeric port
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/000-default.conf

# Start Apache in foreground
exec apache2-foreground
