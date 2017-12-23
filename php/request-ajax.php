<?php 
    include_once '../config/config.php';
    include_once '../config/conexion.php';
    include_once 'funciones.php';
    $db = db_connect();
    
    //GET AJAX
    switch ($_POST['type']) {
        case 1: //deletePreviewById
            $var = deletePreviewById($db, $_POST['id']);
            header('Content-Type: application/json');
            echo json_encode(array('success' => $var));
        break;
    }
    
?>