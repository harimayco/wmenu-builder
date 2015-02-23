# wmenu
laravel package menu like wordpress

This is a menu that has the functionality of wordpress, and ease of creating editing and selection, some css and javascripts property was used wordpress.

It has a nestable menu and sortable.

This project has two versions of menu creator

domain.com/menuw
```
"require": {
		"laravel/framework": "4.2.*",
		"garcia/wmenu": "dev-master"
	}
	
```


```
	'providers' => array(
		'Garcia\Wmenu\WmenuServiceProvider',
	),
```


```
CREATE TABLE `menus` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

CREATE TABLE `menu_items` (
`id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `parent` varchar(255) NOT NULL DEFAULT '0',
  `sort` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `class` varchar(50) DEFAULT NULL,
  `menu` int(11) DEFAULT '1',
  `depth` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=latin1;

```
php artisan asset:publish --bench="garcia/wmenu"

![ScreenShot](http://oi59.tinypic.com/m935vp.jpg)
![ScreenShot](http://oi61.tinypic.com/4g2bli.jpg)
![ScreenShot](http://oi62.tinypic.com/28bb6eq.jpg)
