<?php 
    
    /**
     * Función para actualizar las vistas de un artículo
     * @param  [objeto]     $db [conexión DB]
     * @param  [type]     $id []
     * @return [null]         []
     * @author Fabián Muñoz Flores
     * @date   2017-12-15
     */
    function actualizarVistas($db, $id){
        
        $sql = "UPDATE Articulos SET vistas = vistas + 1 WHERE id = ".$id;
        $query = $db->query($sql);
        
    }
    
    /**
     * Función para actualizar el conteo de un tag cuando este sea utilizado
     * @param  [type]     $db [conexión DB]
     * @param  [array]     $ids [Se recibe un array de todos los IDs de los tags seleccionados]
     * @return [null]         []
     * @author Fabián Muñoz Flores
     * @date   2017-12-15
     */
    function actualizarConteoTags($db, $ids){
        
        foreach($ids as $v){
            $sql = "UPDATE Tags SET conteo = conteo + 1 WHERE id = ".$v;
            $query = $db->query($sql);
        }
        
    }
    
    /**
     * Función para obtener los tags en base a sus ID y devolver un JSON formateado para que lo lea la instancia de CHIP autocomplete
     * @param  [objeto]     $db   [conexión DB]
     * @param  [string]     $tags []
     * @return [json]           []
     * @author Fabián Muñoz Flores
     * @date   2017-12-20
     */
    function getTagsById($db, $tags){
        
        $records = $db->query("SELECT id, nombre FROM Tags WHERE id IN (".trim($tags,',').")");
        $objeto = Array();
        
        foreach($records AS $v){
            $objeto[] = array('id' => $v['id'], 'tag' => $v['nombre']);
        }
        
        return json_encode($objeto);
        
    }
    
    /**
     * Función para obtener la ruta de una imagen según su ID
     * @param  [type]     $db [description]
     * @param  [type]     $id [description]
     * @return [type]         [description]
     * @author Fabián Muñoz Flores
     * @date   2017-12-20
     */
    function getPathImgById($db, $id){
        $record = $db->query("SELECT path FROM Imagenes WHERE id = " . $id);
        $row = mysqli_fetch_assoc($record);
        return $row['path'];
    }
    
    function existsPreviewById($db, $id){
        $record = $db->query("SELECT COUNT(id) AS conteo FROM ArticulosPreview WHERE id = " . $id);
        $row = mysqli_fetch_assoc($record);
    }
    
    function formatterTitle($texto){
        //Eliminar paréntesis
        $textoLimpio = preg_replace('([()])', '', $texto);	   					
        return $textoLimpio;
    }
?>