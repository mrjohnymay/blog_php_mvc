<?php

class PagesController {
    //En esta función declaramos cual es el nombre y el apellido y vamos a la vista home
    public function home() {
        $first_name = 'Ivan';
        $last_name = 'Anguita';
        require_once('views/pages/home.php');
    }
    //En esta función vamos a la vista de error
    public function error() {
        require_once('views/pages/error.php');
    }
}
?>
