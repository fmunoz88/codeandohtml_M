<?php 
    include_once('../config/conexion.php');
    $db = db_connect();
    
    header("Content-Type:text/html; charset=utf-8");
    header("Access-Control-Allow-Origin: *");

    $id = false;

    $fecha = date("Y-m-d H:m:s");
    // $titulo = $_POST['titulo'];
    // $subtitulo = $_POST['subtitulo'];
    $titulo = mysqli_real_escape_string($db, ($_POST['titulo']));
    $articulo = mysqli_real_escape_string($db, ($_POST['contenido']));
    $preview = $_POST['preview'];
    $idImg = $_POST['id_img'];

    //Obtener el ID del registro preview, en el caso de que exista
    if(isset($_POST['id'])){ 
        $id = $_POST['id'];
    }
    
    //Obtener Tags y transformalos en String
    $tags = $_POST['tags'];
    $tagString = "";
    foreach ($tags AS $k => $v) {
        // var_dump($v);
        $tagString .= $v . ",";
    }
    // echo "<pre>"; var_dump("->",$articulo, $_POST); die();
    // die('aa');
    //Validar campos vacios
    if(empty($titulo) || empty($articulo) || empty($idImg)){
        
        header('Content-Type: application/json');
        echo json_encode(array(
            'success' => false,
            'message' => "Error de validación de campos. Favor de verificar."
        ));
        
    }else{
        
        // Validar si viene el ID del articulo, quiere decir que es un preview y se tiene que actualizar el registro
        if($id){
            $sql = "UPDATE Articulos SET fecha = '".$fecha."', titulo = '".$titulo."', articulo = '".$articulo."', preview = '.$preview.', idImg = '.$idImg.', tags = '".$tagString."' WHERE id = ".$id;
        }else { //Se ingresará el nuevo registro
            $sql = "INSERT INTO Articulos (fecha,titulo,articulo,tags,preview,idImg,idUsuario,estatus) VALUES ('".$fecha."','".$titulo."','".$articulo."','".$tagString."', ".$preview.", ".$idImg.", 1,0)";
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
            echo "<pre>"; var_dump("->",$sql,mysqli_error($db)); die();
            header('Content-Type: application/json');
            echo json_encode(array(
                'success' => false
            ));
            
        }
    }    
?>