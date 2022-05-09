<?php

namespace Config;

use DeepCopy\Filter\Filter;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/auth/login', 'Auth::login');



$routes->group('public',['namespace'=>'App\Controllers\API'], function($routes){
   
    $routes->post('usuarios/create', 'Usuarios::create');
   
});

$routes->group('api',['namespace' => 'App\Controllers\API','filter' => 'authFilter', 'filter' => 'cors' ],function($routes){
   //rutas para el carrito
   $routes->get('carrito', 'Carrito::index');
   $routes->post('carrito/create', 'Carrito::create');
   $routes->get('carrito/edit/(:num)', 'Carrito::edit');
   $routes->post('carrito/update/(:num)', 'Carrito::update');
   $routes->get('carrito/delete/(:num)', 'Carrito::delete');



   $routes->get('roles', 'Roles::index');
   $routes->post('roles/create', 'Roles::create');
   $routes->get('roles/edit/(:num)', 'Roles::edit/$1');
   $routes->put('roles/update/(:num)', 'Roles::update/$1');
   $routes->delete('roles/delete/(:num)', 'Roles::delete/$1');

   //Rutas para el controlador de usuarios
   $routes->get('usuarios', 'Usuarios::index');
  
   $routes->delete('usuarios/delete/(:num)', 'Usuarios::delete/$1');
   $routes->get('usuarios/edit/(:num)', 'Usuarios::edit/$1');
   $routes->put('usuarios/update/(:num)', 'Usuarios::update/$1');
   $routes->get('roles', 'Roles::index');
  
   $routes->get('clientes', 'Usuarios::Clientes');
 


   //Rutas para el controlador de pasteles
   $routes->get('pasteles', 'Pastel::index');
   $routes->post('pasteles/create', 'Pastel::create');
   $routes->get('pasteles/edit/(:num)', 'Pastel::edit/$1');
   $routes->put('pasteles/update/(:num)', 'Pastel::update/$1');
   $routes->delete('pasteles/delete/(:num)', 'Pastel::delete/$1');

   //Rutas para el controlador de pedidos
   $routes->get('pedidos', 'Pedidos::index');
   $routes->post('pedidos/create', 'Pedidos::create');
   $routes->get('pedidos/edit/(:num)', 'Pedidos::edit/$1');
   $routes->put('pedidos/update/(:num)', 'Pedidos::update/$1');
   $routes->delete('pedidos/delete/(:num)', 'Pedidos::delete/$1');
   
   //para el controlador de detalle de pedidos
   $routes->get('carrito/datosPedidos/(:num)', 'Carrito::datosPedidos/$1');
   $routes->get('carrito/totalPedido/(:num)', 'Carrito::totalPedido/$1');

   //para ver los administradores
    $routes->get('administradores', 'Usuarios::Administradores');

    //para ver los clientes

    //para ver la imagen de los pasteles
    $routes->get('getImage/(:num)', 'Pastel::GetImage/$1');

  
});


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
