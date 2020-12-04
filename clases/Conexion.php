<?php
DEFINE("DB_HOST","localhost");
DEFINE("DB_USER","root");
DEFINE("DB_PASS","");
DEFINE("DB","parcial2");

class Conexion
{
    function Conexion()
    {
        return mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB);
    }
}