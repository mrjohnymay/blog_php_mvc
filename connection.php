<!--En este archivo hacemos la conexión a la base de datos-->
<?php
class Db {
    private static $instance = NULL;
    private function __construct() {}
    private function __clone() {}

    public static function getInstance() {
        if (!isset(self::$instance)) { //self = this
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;dbname=blog_php_mvc', 'root', '123456', $pdo_options);
        }
        return self::$instance;
    }
}
?>