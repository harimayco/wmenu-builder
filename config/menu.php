<?php

return [
/* you can add your own middleware here */
	
   'middleware' => [],

/* you can set your own table prefix here */
    'table_prefix' => 'admin_',

/* you can set your own table names */
    'table_name_menus' => 'menus',

    'table_name_items' => 'menu_items',

/* you can set your route path*/
    'route_path' => '/harimayco/',

/* here you can make menu items visible to specific roles */
    'use_roles' => false,

/* If use_roles = true above then must set the table name, primary key and title field to get roles details */
    'roles_table' => 'roles',

    'roles_pk' => 'id', // primary key of the roles table

    'roles_title_field' => 'name', // display name (field) of the roles table
];
