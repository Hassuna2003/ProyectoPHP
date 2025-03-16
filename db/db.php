<?php

# Funcionalidades relacionadas con la base de datos.
    class Database {
        public static function open_connection(){
            try{
                $host = "localhost";
                $dbname = "tienda_headphones";
                $user = "root";
                $password = "";
            
                $dsn = "mysql:host=$host;dbname=$dbname";
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                return $dbh;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }  
        }
    }
?>