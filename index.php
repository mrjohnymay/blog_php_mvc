<?php
//Hacemos la conexión a la base de datos
require_once('connection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
} else {
    $controller = 'pages';
    $action = 'home';
}
//Una vez sabemos donde queremos ir, mostramos el layout
require_once('views/layout.php');
?>
