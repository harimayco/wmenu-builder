# Laravel Drag and Drop menu editor like wordpress

forked from https://github.com/lordmacu/wmenu
![Laravel drag and drop menu](https://s28.postimg.org/pfxhnqcgd/screenshot_20170811_150313.png)
*note: you need to set minimim-stability to 'dev' if you want to install this package

### Installation
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
5. Configure (optional)
- ***CUSTOM MIDDLEWARE:*** You can add you own middleware in ***config/menu.php***
- ***TABLE PREFIX:*** By default this package will create 2 new tables named "menus" and "menu_items" but you can still add your own table prefix avoiding confict with existing table in ***config/menu.php***

6. Run migrate

 ```php
 php artisan migrate
 ```
 
 DONE
 

### Usage
you can simply add this code to your view
```php
{!! Menu::render() !!}
```

### Using The Model
Call the model class 
```php
use Harimayco\Menu\Models\Menu;
use Harimayco\Menu\Models\MenuItem;
```

### Customization
you can edit the menu interface in ***resources/view/vendor/harimayco-menu/menu.blade.php***

### Credits

 * [wmenu](https://github.com/lordmacu/wmenu) laravel package menu like wordpress

### Compability
* Tested with laravel 5.2, 5.3, 5.4 

