<?php


class Usuarios_model {
    
    private $db;
    
    public function __construct(){
        require_once 'config/database.php';
        $this->db = Conectar::conexion();
    }
    
    /**
     * Validar usuario para Login
     */
    public function validar_usuario($usuario, $password){
        $usuario = $this->db->real_escape_string($usuario);
        
        // Selecciona los datos que usará la sesión
        $sql = "SELECT id, password, username, nombre_completo 
                FROM usuarios 
                WHERE username = '$usuario'";
        
        $resultado = $this->db->query($sql);
        
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return $row; 
            }
        }
        return false;
    }

    // ══════════════════════════════════════════════════════════════
    // =              FUNCIONES CRUD PARA EL ADMIN                  =
    // ══════════════════════════════════════════════════════════════

    /**
     *  Obtener todos los usuarios
     */
    public function get_usuarios(){
        $sql = "SELECT id, username FROM usuarios ORDER BY username ASC";
        $resultado = $this->db->query($sql);
        $usuarios = array();
        while($row = $resultado->fetch_assoc()){
            $usuarios[] = $row;
        }
        return $usuarios;
    }
    
    /**
     *  Obtener un solo usuario por su ID
     */
    public function get_usuario($id){
        $id = (int)$id;
        $sql = "SELECT id, username FROM usuarios WHERE id = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    /**
     *  Insertar un nuevo usuario
     */
    public function insertar_usuario($usuario, $password){
        $usuario = $this->db->real_escape_string($usuario);
        $password_hashed = password_hash($password, PASSWORD_DEFAULT); 

        $sql = "INSERT INTO usuarios (username, password) VALUES ('$usuario', '$password_hashed')";
        return $this->db->query($sql);
    }
    
    /**
     *  Modificar un usuario
     */
    public function modificar_usuario($id, $usuario, $password = null){
        $id = (int)$id;
        $usuario = $this->db->real_escape_string($usuario);
        
        if ($password) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios 
                    SET username = '$usuario', 
                        password = '$password_hashed'
                    WHERE id = $id";
        } else {
            $sql = "UPDATE usuarios 
                    SET username = '$usuario' 
                    WHERE id = $id";
        }
        
        return $this->db->query($sql);
    }
    
    /**
     *  Eliminar un usuario por su ID
     */
    public function eliminar_usuario($id){
        $id = (int)$id;
        // Evitar que el admin 1 se borre a sí mismo
        if ($id == 1) {
            return false;
        }
        $sql = "DELETE FROM usuarios WHERE id = $id";
        return $this->db->query($sql);
    }
}
?>