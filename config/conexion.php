<?php 
    function db_connect(){
        $mysqli = new mysqli('localhost', 'root', '', 'codeandohtml');
        if (mysqli_connect_error()) {
            die('Error de Conexión:: (' . mysqli_connect_error() . ') '
                    . mysqli_connect_error());
        }else{
            return $mysqli;
        }        
        $mysqli->close();
    }
?>