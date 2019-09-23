# foodie

clone

composer install
npm install
php artisan migrate
php artisan passport:install 
php artisan vendor:publish --tag=passport-components
php artisan db:seed --class=RecipeTableSeeder -v 

php artisan serve
npm run watch
