<?php 
    ini_set('display_errors', 'On');

    class Database{
        private $config = [];

        // conexion con la base base de datos
        public static function connect(){
            $db = new PDO('mysql:host=localhost;dbname=biblioteca;charset=utf8','root','');
            $db = setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // definir consulta 
            $libros = $db->query("SELECT * FROM libros");
            // ejecutar consulta
            $libros = $libros-> fetchAll(PDO::FETCH_ASSOC); // devuelve array asociativo

            return $libros;


        }

        //carga la configuracion de la bd
        public static function loadConfig(){
            $json_file = file_get_contents('../config/db-conf.json');
            $config = json_decode($json_file, true);

            $db_host = $config['host'];
            $db_user = $config['user'];
            $db_password = $config['password'];
            $db_name = $config['db_name'];
        }
    }

?>