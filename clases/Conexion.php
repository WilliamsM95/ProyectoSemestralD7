<?php
DEFINE("DB_HOST","localhost");
DEFINE("DB_USER","root");
DEFINE("DB_PASS","");
DEFINE("DB","proyecto7");

class Conexion
{
    function Conectar(){
        return mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB,"3308");
    }
}