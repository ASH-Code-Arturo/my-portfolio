<?php

class HomeController {
    /**
     * Muestra la página de inicio
     */
    public function index() {
        // La ruta es relativa a la ubicación de este archivo
        $viewPath = __DIR__ . '/../Views/home.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "Error: La vista home.php no se encuentra en app/Views/";
        }
    }
}