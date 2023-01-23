Instructions:
1: CTRL+P -> Go to AppServiceProvider.php
2: comment line 32 and 33 
3: go to env example and clone it and turn it to .env
4: composer install
5: php artisan migrate
6: php artisan db:seed
7: npm install
8: Uncomment lines 32 and 33 that you previously commented
9: php artisan key:generate
10: php artisan serve and npm run dev
