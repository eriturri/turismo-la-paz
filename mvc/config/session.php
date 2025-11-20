<?php

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Verificar si hay un usuario admin logueado
 * @return bool
 */
function esta_logueado() {
    return isset($_SESSION['admin_logueado']) && $_SESSION['admin_logueado'] === true;
}

/**
 * Obtener datos del usuario logueado
 * @return array|null
 */
function obtener_usuario() {
    if (esta_logueado()) {
        return [
            'id' => $_SESSION['usuario_id'] ?? null,
            'username' => $_SESSION['usuario_username'] ?? null,
            'nombre' => $_SESSION['usuario_nombre'] ?? null
        ];
    }
    return null;
}

/**
 * Establecer sesión de usuario
 */
function establecer_sesion($usuario) {
    $_SESSION['admin_logueado'] = true;
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_username'] = $usuario['username'];
    $_SESSION['usuario_nombre'] = $usuario['nombre_completo'];
    $_SESSION['tiempo_login'] = time();
}

/**
 * Destruir sesión (logout)
 */
function cerrar_sesion() {
    $_SESSION = array();
    session_destroy();
}

/**
 * Requiere login para acceder
 * Redirige a index si no está logueado
 */
function requiere_admin() {
    if (!esta_logueado()) {
        header('Location: index.php');
        exit;
    }
}

/**
 * Verificar timeout de sesión (opcional)
 * @param int $minutos Minutos de inactividad permitidos
 * @return bool
 */
function verificar_timeout($minutos = 30) {
    if (isset($_SESSION['tiempo_login'])) {
        $tiempo_transcurrido = time() - $_SESSION['tiempo_login'];
        $tiempo_limite = $minutos * 60;
        
        if ($tiempo_transcurrido > $tiempo_limite) {
            cerrar_sesion();
            return false;
        }
        
        // Actualizar tiempo de última actividad
        $_SESSION['tiempo_login'] = time();
    }
    return true;
}

/**
 * Generar token CSRF
 * @return string
 */
function generar_csrf_token() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verificar token CSRF
 * @param string $token
 * @return bool
 */
function verificar_csrf_token($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>
