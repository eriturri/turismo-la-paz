<?php

class AuthController {
    
    public function login(){
        require_once 'config/session.php';
        if (esta_logueado()) {
            header('Location: index.php?c=lugares&a=index');
            exit;
        }
        
        require_once 'views/auth/login.php';
    }
    
    public function procesar_login(){
        require_once 'config/session.php';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                echo "<script>
                            alert('Por favor complete todos los campos');
                            window.location.href='index.php?c=auth&a=login';
                          </script>";
                return;
            }
            
            require_once 'models/UsuariosModel.php';
            $usuarios_model = new Usuarios_model();
            
            // 1. Llamamos a la función corregida
            $usuario = $usuarios_model->validar_usuario($username, $password);
            
            if ($usuario) {
                // Login exitoso
                // 2. $usuario ahora contiene ['id'], ['username'] y ['nombre_completo']
                establecer_sesion($usuario); 
                
                // 3. CORRECCIÓN: Usamos la variable $usuario['nombre_completo'] de la BDD
                echo "<script>
                            alert('¡Bienvenido " . htmlspecialchars($usuario['nombre_completo']) . "!');
                            window.location.href='index.php?c=lugares&a=index';
                          </script>";
            } else {
                // Login fallido
                echo "<script>
                            alert('Usuario o contraseña incorrectos');
                            window.location.href='index.php?c=auth&a=login';
                          </script>";
            }
        } else {
            // No es POST, redirigir al login
            header('Location: index.php?c=auth&a=login');
        }
    }
    
    public function logout(){
        require_once 'config/session.php';
        cerrar_sesion();
        
        echo "<script>
                  alert('Sesión cerrada correctamente');
                  window.location.href='index.php';
                </script>";
    }
}
?>