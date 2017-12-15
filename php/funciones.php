<?php 
    
    /**
     * Función para actualizar las vistas de un artículo
     * @param  [type]     $db [description]
     * @param  [type]     $id [description]
     * @return [type]         [description]
     * @author Fabián Muñoz Flores
     * @date   2017-12-15
     */
    function actualizarVistas($db, $id){
        $sql = "UPDATE Articulos SET vistas = vistas + 1 WHERE id = ".$id;
        $query = $db->query($sql);
    }
    
    /**
     * Función para actualizar el conteo de un tag cuando este sea utilizado
     * @param  [type]     $db [description]
     * @param  [array]     $ids [Se recibe un array de todos los IDs de los tags seleccionados]
     * @return [type]         [description]
     * @author Fabián Muñoz Flores
     * @date   2017-12-15
     */
    function actualizarConteoTags($db, $ids){
        
        foreach($ids as $v){
            $sql = "UPDATE Tags SET conteo = conteo + 1 WHERE id = ".$v;
            $query = $db->query($sql);
        }
    }
?>