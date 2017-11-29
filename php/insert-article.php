<?php 
    include_once('../config/conexion.php');
    $db = db_connect();
    
    header("Content-Type:text/html; charset=utf-8");
    header("Access-Control-Allow-Origin: *");

    $id = false;

    $fecha = date("Y-m-d H:m:s");
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $articulo = mysqli_real_escape_string($db, ($_POST['contenido']));
    $preview = $_POST['preview'];

    //Obtener el ID del registro preview, en el caso de que exista
    if(isset($_POST['id'])){ 
        $id = $_POST['id'];
    }
    
    // Validar si viene el ID del articulo, quiere decir que es un preview y se tiene que actualizar el registro
    if($id){
        $sql = "UPDATE Articulos SET fecha = '".$fecha."', titulo = '".$titulo."', subTitulo = '".$subtitulo."', articulo = '".$articulo."', preview = '.$preview.' WHERE id = ".$id;
    }else { //Se ingresará el nuevo registro
        $sql = "INSERT INTO Articulos (fecha,titulo,subTitulo,articulo,preview,idUsuario,estatus) VALUES ('".$fecha."','".$titulo."','".$subtitulo."','".$articulo."', ".$preview.", 1,0)";
    }

    //Insert/Update de datos del formulario
    $query = $db->query($sql);

    if($query){//Validar si se ejecutó correctamente la sentencia

        if(!$id){ 
            $resultID = $db->query("SELECT MAX(id) AS id FROM Articulos WHERE preview = 1");
        	$row = mysqli_fetch_assoc($resultID);
            $id = $row['id'];
        }
        
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => true,
            'id' => $id,
            'preview' => $preview
        ));

    }else{
        
        echo json_encode(array(
            'success' => false
        ));
        
    }
        
?>