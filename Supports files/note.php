<!-- Migrate Tables -->
php artisan migrate --path=/database/migrations/2021_01_26_105651_create_libraries_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105738_create_centers_table.php
php artisan migrate --path=/database/migrations/2021_01_26_114517_create_designetions_table.php
php artisan migrate --path=/database/migrations/2021_01_26_100131_create_staff_table.php 
php artisan migrate --path=/database/migrations/2014_10_12_000000_create_users_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105806_create_book_dd_classes_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105846_create_book_dd_devisions_table.php
php artisan migrate --path=/database/migrations/2021_01_26_105905_create_book_dd_sections_table.php 
php artisan migrate --path=/database/migrations/2020_10_09_135640_create_permission_tables.php
php artisan migrate --path=/database/migrations/2020_10_09_135732_create_products_table.php 
php artisan migrate --path=/database/migrations/2021_01_03_152629_create_code_table.php 
php artisan migrate --path=/database/migrations/2021_01_16_075922_create_member_cats_table.php
php artisan migrate --path=/database/migrations/2021_01_16_075854_create_members_table.php
php artisan migrate --path=/database/migrations/2021_01_16_075950_create_book_cats_table.php
php artisan migrate --path=/database/migrations/2021_01_16_080044_create_book_langs_table.php
php artisan migrate --path=/database/migrations/2021_01_16_080126_create_book_publishers_table.php
php artisan migrate --path=/database/migrations/2021_01_16_080911_create_book_media_table.php
php artisan migrate --path=/database/migrations/2021_01_16_075743_create_books_table.php
php artisan migrate --path=/database/migrations/2021_01_25_063419_create_settings_table.php
php artisan migrate


<!-- Seed Tables -->

php artisan db:seed --class=PermissionSeeder
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=SettingSeeder

php artisan db:seed --class=StaffSeeder
php artisan db:seed --class=librarySeeder
php artisan db:seed --class=BookSeeder


