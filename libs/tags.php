<?php 
    include_once "../config/conexion.php";
    $db = db_connect();
    
    // $get = $_GET;
    
    $query = "SELECT id, nombre FROM Tags ORDER BY nombre";
    $records = $db->query($query);
    
    $tags = [];
    // $count = 0;
    
    foreach ($records AS $v) {
        // echo $v['nombre'];
        $tags[] = array('id' => $v['id'], 'name' => $v['nombre']); 
        // $count++;
        // $tags[0] = $v['id'];  
        // $tags[1] = $v['nombre'];  
    }
    header('Content-Type: application/json');
    echo json_encode($tags);
    // echo $tags;
    // echo "<pre>"; var_dump("->",json_encode($tags)); die();
?>