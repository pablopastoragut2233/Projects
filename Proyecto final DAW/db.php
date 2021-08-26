<?php
    class Conection{
        public static function con($dbname){
            $con = new PDO("mysql:host=localhost;dbname=$dbname","root","", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        }
    }
?>