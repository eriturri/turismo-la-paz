<?php
/**
 * Controlador de Valoraciones (CRUD Admin)
 */

class ValoracionesController {
    
    public function __construct(){
        // Cargar el modelo
        require_once "models/ValoracionesModel.php";
        
        // ¡¡PROTEGER TODO EL CONTROLADOR!!
        // Solo los admin pueden gestionar valoraciones.
        require_once 'config/session.php';
        requiere_admin();
    }
    
    /**
     * (READ) Mostrar la lista de todas las valoraciones
     * Esta es la acción 'ver' de tu botón
     */
    public function ver(){
        $valoraciones_model = new Valoraciones_model();
        
        $data["titulo"] = "Admin - Gestionar Valoraciones";
        // Usamos la función 'obtener_ultimas' con un límite alto para traer todas
        $data["valoraciones"] = $valoraciones_model->obtener_ultimas(999); 
        
        // Cargar la vista de la tabla de admin
        require_once "views/valoraciones/valoraciones_admin.php";
    }
    
    /**
     * (CREATE) Mostrar formulario para nueva valoración
     */
    public function nuevo(){
        $data["titulo"] = "Admin - Nueva Valoración";
        
        // Para poder seleccionar un lugar de la lista
        require_once "models/LugaresModel.php";
        $lugares_model = new Lugares_model();
        $data["lugares"] = $lugares_model->get_lugares();
        
        require_once "views/valoraciones/valoraciones_nuevo.php";
    }
    
    /**
     * (CREATE) Guardar la nueva valoración
     */
    public function guarda(){
        $valoraciones_model = new Valoraciones_model();
        
        $lugar_id = $_POST['lugar_id'];
        $nombre = $_POST['nombre_visitante'];
        $calificacion = $_POST['calificacion'];
        $comentario = $_POST['comentario'];
        // El admin no necesita IP
        
        $valoraciones_model->agregar_valoracion($lugar_id, $calificacion, $nombre, $comentario, null);
        
        // Redirigir a la lista de valoraciones
        header("Location: index.php?c=valoraciones&a=ver");
    }
    
    /**
     * (UPDATE) Mostrar formulario para editar
     */
    public function editar($id){
        $valoraciones_model = new Valoraciones_model();
        
        $data["titulo"] = "Admin - Editar Valoración";
        $data["valoracion"] = $valoraciones_model->get_valoracion($id);
        
        require_once "views/valoraciones/valoraciones_modifica.php";
    }
    
    /**
     * (UPDATE) Actualizar la valoración en la BDD
     */
    public function actualizar(){
        $valoraciones_model = new Valoraciones_model();
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre_visitante'];
        $calificacion = $_POST['calificacion'];
        $comentario = $_POST['comentario'];
        
        $valoraciones_model->modificar_valoracion($id, $nombre, $calificacion, $comentario);
        
        header("Location: index.php?c=valoraciones&a=ver");
    }
    
    /**
     * (DELETE) Eliminar una valoración
     */
    public function eliminar($id){
        $valoraciones_model = new Valoraciones_model();
        $valoraciones_model->eliminar_valoracion($id);
        
        header("Location: index.php?c=valoraciones&a=ver");
    }
}
?>