<?php 
    include_once '../config/conexion.php';
    include_once '../php/funciones.php';
    $db = db_connect();
    
    header("Content-Type:text/html; charset=utf-8");
    header("Access-Control-Allow-Origin: *");
    //Setear ID false
    $id = false;
    $idPreview = false;

    $date = new DateTime();
    $fecha = $date->format('Y-m-d H:i:s');
    $titulo = mysqli_real_escape_string($db, ($_POST['titulo']));
    $articulo = mysqli_real_escape_string($db, ($_POST['contenido']));
    $preview = $_POST['preview'];
    $idImg = $_POST['id_img'];
    
    $idPreview = $_POST['idPreview']; //TRUE = El post se está editando
    
    if(isset($_POST['preview'])){
        
        //Obtener el ID del registro preview, en el caso de que exista
        if(isset($_POST['id'])){ 
            $id = $_POST['id'];
        }
        
        //Obtener Tags y transformalos en String
        $tags = $_POST['tags'];
        $tagString = "";
        foreach ($tags AS $k => $v) {
            $tagString .= $v . ",";
        }
        
        //Validar campos vacios
        if(empty($titulo) || empty($articulo) || empty($idImg)){
            
            header('Content-Type: application/json');
            echo json_encode(array(
                'success' => false,
                'message' => "Error de validación de campos. Favor de verificar."
            ));
            
        }else{
            
            //Si es preview, se guardará en la tabla ArticulosPreview
            if($preview){
                // Validar si viene el ID del articulo, quiere decir que es un preview y se tiene que actualizar el registro
                if($idPreview){
                    $sql = "UPDATE ArticulosPreview SET fecha = '".$fecha."', titulo = '".$titulo."', articulo = '".$articulo."', preview = '.$preview.', idImg = '.$idImg.', tags = '".$tagString."' WHERE id = ".$idPreview;
                }else { //Se ingresará el nuevo registro
                    $sql = "INSERT INTO ArticulosPreview (fecha,titulo,articulo,tags,preview,idImg,idUsuario,estatus) VALUES ('".$fecha."','".$titulo."','".$articulo."','".$tagString."', ".$preview.", ".$idImg.", 1,0)";
                }
            }else{
                // Validar si viene el ID del articulo, quiere decir que se está EDITANDO un artículo y se tiene que actualizar el registro
                if($id){
                    $sql = "UPDATE Articulos SET titulo = '".$titulo."', articulo = '".$articulo."', preview = '.$preview.', idImg = '.$idImg.', tags = '".$tagString."' WHERE id = ".$id;
                }else { //Se ingresará el nuevo registro
                    $sql = "INSERT INTO Articulos (fecha,titulo,articulo,tags,preview,idImg,idUsuario,estatus) VALUES ('".$fecha."','".$titulo."','".$articulo."','".$tagString."', ".$preview.", ".$idImg.", 1,0)";
                }
            }
            //ACLARACIÓN: Al tener una tabla especial para el preview, se evitará que si un artículo ya creado se edita, al darle preview este no modificará el ya creado.
            
            //Insert/Update de datos del formulario
            $query = $db->query($sql);

            if($query){//Validar si se ejecutó correctamente la sentencia

                if(!$idPreview){ //Si no viene el idPreview, quiere decir es la primera vez que se llama el "Preview"
                    $resultID = $db->query("SELECT MAX(id) AS id FROM ArticulosPreview");
                	$row = mysqli_fetch_assoc($resultID);
                    $idPreview = $row['id'];
                }
                
                // Fin Edición
                if(!$preview){
                    //actualizar el conteo de tags
                    //No es vital validar si se realiza correctamente conteo de los tags
                    actualizarConteoTags($db, $tags);
                    
                    if($idPreview){ //Si viene un $idPreview, significa que existe un registro creado en el preview y se eliminará ya que se terminó la edición
                        $query = "DELETE FROM ArticulosPreview WHERE id = " . $idPreview;
                        $db->query($query);
                    }
                    
                }
                
                header('Content-Type: application/json');
                echo json_encode(array(
                    'success' => true,
                    'id' => $id,
                    'idPreview' => $idPreview,
                    'preview' => $preview
                ));

            }else{
                echo "<pre>"; var_dump("ERROR ->",$sql,mysqli_error($db)); die();
                header('Content-Type: application/json');
                echo json_encode(array(
                    'success' => false
                ));
                
            }
        }
    }
?>