#!/usr/bin/env bash
# Provision a WordPress install for this project.
# Requires WP-CLI. Run from the repo root after filling provision/.env.
set -euo pipefail

set -a; source provision/.env; set +a

wp core download --force
wp config create --dbname="$DB_NAME" --dbuser="$DB_USER" --dbpass="$DB_PASS" --dbhost="$DB_HOST" --skip-check --force
wp db create || true
wp core install --url="$WP_URL" --title="$WP_TITLE" --admin_user="$WP_ADMIN_USER" --admin_password="$WP_ADMIN_PASS" --admin_email="$WP_ADMIN_EMAIL" --skip-email

# Free plugins from the WordPress.org directory
wp plugin install "classic-editor" "cookie-notice" "megamenu" "svg-support" "duplicate-post" "wordpress-seo" --activate

# Premium plugins — install from private zip URLs, then activate.
# Provide the zip URLs/paths in your deploy environment; license keys come from provision/.env.
# Advanced Custom Fields PRO (advanced-custom-fields-pro): wp plugin install <ADVANCED_CUSTOM_FIELDS_PRO_ZIP_URL> --activate
# Gravity Forms (gravityforms): wp plugin install <GRAVITYFORMS_ZIP_URL> --activate
# WP Rocket (wp-rocket): wp plugin install <WP_ROCKET_ZIP_URL> --activate

# Activate the agency blank theme (delivered via the project template repo).
wp theme activate "sd-workflow"

echo "WordPress provisioning complete."
