<?php
/**
 * Definición de rutas del sitio
 * Formato: $router->get('URL', 'Controlador@Método');
 */

$router->get('/', 'HomeController@index');

// Ejemplo para cuando agregues más páginas en el futuro:
// $router->get('/proyectos', 'ProjectController@list');