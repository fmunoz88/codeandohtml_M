<?php 
    include_once "../config/conexion.php";
    $db = db_connect();
    
    $query = "SELECT id, nombre FROM Tags ORDER BY nombre";
    $records = $db->query($query);
    
    $tags = [];
    
    foreach ($records AS $v) {
        $tags[] = array('id' => $v['id'], 'name' => $v['nombre']); 
    }
    header('Content-Type: application/json');
    echo json_encode($tags);
?>