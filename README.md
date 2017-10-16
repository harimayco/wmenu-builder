# Laravel Drag and Drop menu editor like wordpress

forked from https://github.com/lordmacu/wmenu
![Laravel drag and drop menu](https://s28.postimg.org/pfxhnqcgd/screenshot_20170811_150313.png)

### Installation
1. Run
```php
composer require harimayco/laravel-menu
```
***Step 2 & 3 are optional if you are using laravel 5.5***

2. Add the following class, to "providers" array in the file config/app.php (optional on laravel 5.5)
```php
Harimayco\Menu\MenuServiceProvider::class,
```
3. add facade in the file config/app.php (optional on laravel 5.5)
```php
'Menu' => Harimayco\Menu\Facades\Menu::class,
```
4. Run publish
```php
php artisan vendor:publish --provider="Harimayco\Menu\MenuServiceProvider"
```
5. Configure (optional) in ***config/menu.php*** :
- ***CUSTOM MIDDLEWARE:*** You can add you own middleware 
- ***TABLE PREFIX:*** By default this package will create 2 new tables named "menus" and "menu_items" but you can still add your own table prefix avoiding conflict with existing table
- ***TABLE NAMES*** If you want use specific name of tables you have to modify that and the migrations
- ***Custom routes*** If you want to edit the route path you can edit the field
6. Run migrate

 ```php
 php artisan migrate
 ```

 DONE


### Usage Example
On your view blade file
```php
@extends('app')

@section('contents')
    {!! Menu::render() !!}
@endsection

//YOU MUST HAVE JQUERY LOADED BEFORE menu scripts
@push('scripts')
    {!! Menu::scripts() !!}
@endpush
```

### Get Menu Items By Menu ID
```php
use Harimayco\Menu\Facades\Menu;
...
/*
Parameter: Menu ID
Return: Array
*/
$menuList = Menu::get(1);
```

### Get Menu Items By Menu Name
In this example, you must have a menu named  *Admin*

```php
use Harimayco\Menu\Facades\Menu;
...
/*
Parameter: Menu ID
Return: Array
*/
$menuList = Menu::getByName('Admin');
```

### Using The Model
Call the model class
```php
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;
```

### Customization
you can edit the menu interface in ***resources/views/vendor/harimayco-menu/menu-html.blade.php***

### Credits

 * [wmenu](https://github.com/lordmacu/wmenu) laravel package menu like wordpress

### Compability
* Tested with laravel 5.2, 5.3, 5.4, 5.5
