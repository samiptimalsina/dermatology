#!/usr/bin/env bash
# Wrapper that ensures pdo_sqlite is loaded for this project
PHP_INI_SCAN_DIR=/etc/php/8.5/cli/conf.d:~/.config/php php artisan "$@"
