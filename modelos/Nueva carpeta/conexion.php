<?php
 class Conexion{
     static public function conectar(){
         $link = new PDO("mysql:host=sql301.epizy.com;dbname=epiz_30905772_ecommerce",
        "epiz_30905772",
        "s3mCNRy9iXI6rX",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
              PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
        return $link;
     }
 }
 