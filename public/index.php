<?php
// Reporte de errores (útil durante el desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Carga del núcleo
require_once __DIR__ . '/../core/Router.php';

$router = new Router();

// Carga de las rutas definidas
require_once __DIR__ . '/../routes/web.php';

// Ejecución del enrutador
$router->resolve();