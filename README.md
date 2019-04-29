# Laravel Drag and Drop menu editor like wordpress

forked from https://github.com/lordmacu/wmenu
![Laravel drag and drop menu](https://raw.githubusercontent.com/harimayco/wmenu-builder/master/screenshot.png)

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
- ***Role Access*** If you want to enable roles (permissions) on menu items

6. Run migrate

 ```php
 php artisan migrate
 ```

 DONE


### Menu Builder Usage Example - displays the builder
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

### Menu Usage Example (a)
A basic two-level menu can be displayed in your blade template
```php
// Used to get the menu items into the blade template
$public_menu = Menu::getByName('Public');

```
### Menu Usage Example (b)
Now inside your blade template file place the menu using this simple example
```php
<div class="nav-wrap">
    <div class="btn-menu">
        <span></span>
    </div><!-- //mobile menu button -->
    <nav id="mainnav" class="mainnav">
    
        @if($public_menu)
        <ul class="menu">
            @foreach($public_menu as $menu)
            <li class="">
                <a href="{{ $menu['link'] }}" title="">{{ $menu['label'] }}</a>
                @if( $menu['child'] )
                <ul class="sub-menu">
                    @foreach( $menu['child'] as $child )
                        <li class=""><a href="{{ $child['link'] }}" title="">{{ $child['label'] }}</a></li>
                    @endforeach
                </ul><!-- /.sub-menu -->
                @endif
            </li>
            @endforeach
        @endif

        </ul><!-- /.menu -->
    </nav><!-- /#mainnav -->
 </div><!-- /.nav-wrap -->
```

### Customization
you can edit the menu interface in ***resources/views/vendor/harimayco-menu/menu-html.blade.php***

### Credits

 * [wmenu](https://github.com/lordmacu/wmenu) laravel package menu like wordpress

### Compatibility
* Tested with laravel 5.2, 5.3, 5.4, 5.5, 5.6, 5.7
