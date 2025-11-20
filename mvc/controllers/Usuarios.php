<?php
/**
 * Controlador de Usuarios (CRUD Admin)
 */

class UsuariosController {
    
    private $modelo;

    public function __construct(){
        // Cargar el modelo
        require_once "models/UsuariosModel.php";
        $this->modelo = new Usuarios_model();
        
        // ¡¡PROTEGER TODO EL CONTROLADOR!!
        // Solo los admin pueden gestionar usuarios.
        require_once 'config/session.php';
        requiere_admin();
    }
    
    /**
     * (READ) Mostrar la lista de todos los usuarios
     * (Esta será la acción 'index', no 'ver' como en valoraciones)
     */
    public function index(){
        $data["titulo"] = "Admin - Gestionar Usuarios";
        $data["usuarios"] = $this->modelo->get_usuarios(); 
        
        // Cargar la vista de la tabla de admin
        require_once "views/usuarios/usuarios_admin.php";
    }
    
    /**
     * (CREATE) Mostrar formulario para nuevo usuario
     */
    public function nuevo(){
        $data["titulo"] = "Admin - Nuevo Usuario";
        require_once "views/usuarios/usuarios_nuevo.php";
    }
    
    /**
     * (CREATE) Guardar el nuevo usuario
     */
    public function guarda(){
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
        
        // Validación simple
        if (!empty($usuario) && !empty($password)) {
            $this->modelo->insertar_usuario($usuario, $password);
        }
        
        // Redirigir a la lista de usuarios
        header("Location: index.php?c=usuarios");
    }
    
    /**
     * (UPDATE) Mostrar formulario para editar
     */
    public function modificar($id){
        // Usamos $id que viene de la URL (ej: ...&a=modificar&id=2)
        
        $data["titulo"] = "Admin - Editar Usuario";
        $data["usuario"] = $this->modelo->get_usuario($id);
        
        require_once "views/usuarios/usuarios_modifica.php";
    }
    
    /**
     * (UPDATE) Actualizar el usuario en la BDD
     */
    public function actualizar(){
        $id = $_POST['id'];
        $usuario = $_POST['usuario'];
        $password = $_POST['password']; // Estará vacío si no se quiere cambiar
        
        $this->modelo->modificar_usuario($id, $usuario, $password);
        
        header("Location: index.php?c=usuarios");
    }
    
    /**
     * (DELETE) Eliminar un usuario
     */
    public function eliminar($id){
        // Usamos $id que viene de la URL (ej: ...&a=eliminar&id=2)
        $this->modelo->eliminar_usuario($id);
        
        header("Location: index.php?c=usuarios");
    }
}
?>