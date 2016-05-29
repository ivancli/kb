rm -rf storage/framework/views/*
GREEN='\033[0;32m'
NC='\033[0m' # No Color
printf "${GREEN}Cached views are deleted${NC}\n"
php artisan cache:clear
composer dump-autoload
