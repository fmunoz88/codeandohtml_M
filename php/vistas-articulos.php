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
?>