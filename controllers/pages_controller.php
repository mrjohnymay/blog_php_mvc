<?php

class PagesController {

    public function home() {
        // simulación de datos obtenidos de un modelo
        $first_name = 'Ivan';
        $last_name = 'Anguita';
        require_once('views/pages/home.php');
    }

    public function error() {
        require_once('views/pages/error.php');
    }
}
?>
