<?php

class LugaresController {
    
    public function __construct(){
       require_once "models/LugaresModel.php";
    }
    
    // ══════════════════════════════════════════════════════════════
    // LISTAR (ADMIN) - Muestra el panel de admin
    // ══════════════════════════════════════════════════════════════
    public function index(){
        // Esta vista (lugares.php) es la del panel de admin
        $lugares = new Lugares_model();
        $data["titulo"] = "Lugares Turísticos";
        $data["lugares"] = $lugares->get_lugares();
        require_once "views/lugares/lugares.php";
    }
    
    // ══════════════════════════════════════════════════════════════
    // NUEVO - SÍ requiere login admin
    // ══════════════════════════════════════════════════════════════
    public function nuevo(){
        // PROTECCIÓN: Solo admin puede acceder
        require_once 'config/session.php';
        requiere_admin();
        
        $data["titulo"] = "Nuevo Lugar Turístico";
        
        require_once "models/CategoriasModel.php";
        $categorias = new Categorias_model();
        $data["categorias"] = $categorias->get_categorias();
        
        require_once "views/lugares/lugares_nuevo.php";
    }
    
    // ══════════════════════════════════════════════════════════════
    // GUARDAR - SÍ requiere login admin
    // ══════════════════════════════════════════════════════════════
    public function guarda(){
        // PROTECCIÓN: Solo admin puede guardar
        require_once 'config/session.php';
        requiere_admin();
        
        $nombre = $_POST['nombre'];
        $categoria_id = $_POST['categoria_id'];
        $descripcion = $_POST['descripcion'];
        $zona = $_POST['zona'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $horario = $_POST['horario'];
        $precio = $_POST['precio'];
        $lugares = new Lugares_model();
        $lugares->insertar($nombre, $descripcion, $direccion, $zona, $categoria_id, 
                           $telefono, $horario, $precio);
        $this->index(); // Vuelve al panel de admin
    }
    
    // ══════════════════════════════════════════════════════════════
    // MODIFICAR - SÍ requiere login admin
    // ══════════════════════════════════════════════════════════════
    public function modificar(){
        // PROTECCIÓN: Solo admin puede modificar
        require_once 'config/session.php';
        requiere_admin();
        
        $id = $_GET['id'];
        $lugares = new Lugares_model();
        $data["id"] = $id;
        $data["lugar"] = $lugares->get_lugar($id);
        $data["titulo"] = "Modificar Lugar Turístico";
        
        require_once "models/CategoriasModel.php";
        $categorias = new Categorias_model();
        $data["categorias"] = $categorias->get_categorias();
        
        require_once "views/lugares/lugares_modifica.php";
    }
    
    // ══════════════════════════════════════════════════════════════
    // ACTUALIZAR - SÍ requiere login admin
    // ══════════════════════════════════════════════════════════════
    public function actualizar(){
        // PROTECCIÓN: Solo admin puede actualizar
        require_once 'config/session.php';
        requiere_admin();
        
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $categoria_id = $_POST['categoria_id'];
        $descripcion = $_POST['descripcion'];
        $zona = $_POST['zona'];
        $direccion = $_POST['direccion'];
        $horario = $_POST['horario'];
        $precio = $_POST['precio'];
        $telefono = $_POST['telefono'];
        
        $lugares = new Lugares_model();
        // Asumiendo que tu modelo Lugares_model tiene un método 'modificar'
        $lugares->modificar($id, $nombre, $descripcion, $direccion,$zona, $categoria_id, $telefono, $horario, $precio);
        
        $this->index(); // Vuelve al panel de admin
    }
    
    // ══════════════════════════════════════════════════════════════
    // ELIMINAR - SÍ requiere login admin
    // ══════════════════════════════════════════════════════════════
    public function eliminar($id){
        // PROTECCIÓN: Solo admin puede eliminar
        require_once 'config/session.php';
        requiere_admin();
        
        $lugares = new Lugares_model();
        $lugares->eliminar($id);
        $this->index(); // Vuelve al panel de admin
    }

    // ══════════════════════════════════════════════════════════════
    // =                      PARTE PÚBLICA                       =
    // ══════════════════════════════════════════════════════════════

    // ══════════════════════════════════════════════════════════════
    // VER DETALLE (PÚBLICO) - NO requiere login
    // ══════════════════════════════════════════════════════════════
    public function ver(){
        
        // 1. Cargar modelos necesarios
        $lugares_model = new Lugares_model(); // Ya está cargado por el __construct
        
        // ¡Importante! Cargar el modelo de valoraciones
        require_once "models/ValoracionesModel.php";
        $valoraciones_model = new Valoraciones_model();
        
        // 2. Obtener el ID del lugar (ej: index.php?c=lugares&a=ver&id=5)
        $id_lugar = $_GET['id'];
        
        // 3. Buscar los datos del lugar
        $data["lugar"] = $lugares_model->get_lugar($id_lugar); // Asumiendo que tu modelo tiene "get_lugar"
        $data["titulo"] = $data["lugar"]["nombre"]; // Título de la página
        
        // 4. Buscar las valoraciones y estadísticas de ESE lugar
        $data["valoraciones"] = $valoraciones_model->obtener_valoraciones($id_lugar);
        $data["promedio"] = $valoraciones_model->obtener_promedio($id_lugar);
        $data["distribucion"] = $valoraciones_model->obtener_distribucion($id_lugar);
        
        // 5. Cargar la vista pública (la que tenías vacía)
        require_once "views/lugares/lugares_publico.php";
    }

    // ══════════════════════════════════════════════════════════════
    // GUARDAR VALORACIÓN (PÚBLICO) - NO requiere login
    // ══════════════════════════════════════════════════════════════
    public function guardar_valoracion(){
        
        // 1. Cargar el modelo
        require_once "models/ValoracionesModel.php";
        $valoraciones_model = new Valoraciones_model();
        
        // 2. Obtener datos del formulario (POST)
        $lugar_id = $_POST['lugar_id'];
        $nombre = $_POST['nombre_visitante'];
        $calificacion = $_POST['calificacion'];
        $comentario = $_POST['comentario'];
        
        // 3. Obtenemos la IP (la necesitamos para la función de guardar)
        $ip = $_SERVER['REMOTE_ADDR']; 
        
        // 4. Verificación de SPAM DESACTIVADA (líneas comentadas)
        // $ya_valoro = $valoraciones_model->verificar_spam($lugar_id, $ip, 60); 
        // if(!$ya_valoro){
        
            // 5. Guardar la valoración (¡ESTA LÍNEA AHORA ESTÁ ACTIVA!)
            $valoraciones_model->agregar_valoracion($lugar_id, $calificacion, $nombre, $comentario, $ip);
        
        // } // Fin del 'if' de spam (comentado)
        
        // 6. Redirigir al usuario de vuelta a la página del lugar que comentó
        header("Location: index.php?c=lugares&a=ver&id=" . $lugar_id);
    }
    
} // <-- Fin de la clase LugaresController
?>