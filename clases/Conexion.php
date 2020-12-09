<?php
DEFINE("DB_HOST","localhost");
DEFINE("DB_USER","root");
DEFINE("DB_PASS","");
<<<<<<< HEAD
//DEFINE("DB","mrram");
=======
// DEFINE("DB","mrram");
>>>>>>> 0ffca0d5a9cae36b2c4d654b1a8204bba70b858e
DEFINE("DB","proyecto7");

class Conexion
{
    function Conectar(){
        return mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB);
         //return mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB,"3308");
    }
}