# Laravel Drag and Drop menu editor like wordpress

forked from https://github.com/lordmacu/wmenu
![Laravel drag and drop menu](https://s28.postimg.org/pfxhnqcgd/screenshot_20170811_150313.png)
*note: you need to set minimim-stability to 'dev' if you want to install this package

installation :
1. Run
```php
composer require harimayco/laravel-menu
```
2. Add the following class, to "providers" array in the file config/app.php
```php
Harimayco\Menu\MenuServiceProvider::class,
```
3. add facade in the file config/app.php
```php
'Menu' => Harimayco\Menu\Facades\Menu::class,
```
4. Run publish
```php
php artisan vendor:publish --provider="Harimayco\Menu\MenuServiceProvider"
```
5. Run migrate
 ```php
 php artisan migrate
 ```
 
 DONE
 
### Configuration
You can add you own middleware in config/menu.php

### USAGE
you can simply add this code to your view
```php
{!! Menu::render() !!}
```

### CUSTOMIZATION
you can edit the menu interface in ***resources/view/vendor/harimayco-menu/menu.blade.php***

### CREDITS

 * [wmenu](https://github.com/lordmacu/wmenu) laravel package menu like wordpress

