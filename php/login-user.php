<?php
    session_start();
    include_once '../config/conexion.php';
    include_once '../php/funciones.php';
    $db = db_connect();
    
    if($_GET['logout']){
        session_destroy();
        header("Location: ../login");
    }else{
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        header('Content-Type: application/json');
        
        if(existsUserLogin($db, $email, $password)){
            //generar sesión
            if(setSessionID($db, $email, $password)){
                echo json_encode(array('success' => true ));
            }else{
                echo json_encode(array('success' => false ));
            }
        }else{
            echo json_encode(array('success' => false ));
        }
    }
?>