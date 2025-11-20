<?php
/**
 * Archivo: models/ValoracionesModel.php
 * Descripción: Modelo para gestión de valoraciones de lugares
 * MODIFICADO: Añadidas get_valoracion() y modificar_valoracion() para CRUD Admin
 */

class Valoraciones_model {
    
    private $db;
    
    public function __construct(){
        require_once 'config/database.php';
        $this->db = Conectar::conexion();
    }
    
    /**
     * Obtener promedio de valoraciones de un lugar
     * @param int $lugar_id
     * @return array [promedio, total]
     */
    public function obtener_promedio($lugar_id){
        $lugar_id = $this->db->real_escape_string($lugar_id);
        
        $sql = "SELECT 
                    COALESCE(AVG(calificacion), 0) as promedio,
                    COUNT(*) as total
                FROM valoraciones 
                WHERE lugar_id = '$lugar_id'";
        
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }
    
    /**
     * Obtener todas las valoraciones de un lugar
     * @param int $lugar_id
     * @return array
     */
    public function obtener_valoraciones($lugar_id){
        $lugar_id = $this->db->real_escape_string($lugar_id);
        
        $sql = "SELECT * FROM valoraciones 
                WHERE lugar_id = '$lugar_id' 
                ORDER BY fecha DESC";
        
        $resultado = $this->db->query($sql);
        $valoraciones = array();
        
        while($row = $resultado->fetch_assoc()){
            $valoraciones[] = $row;
        }
        
        return $valoraciones;
    }
    
    /**
     * Agregar nueva valoración
     */
    public function agregar_valoracion($lugar_id, $calificacion, $nombre_visitante = 'Anónimo', $comentario = null, $ip = null){
        $lugar_id = $this->db->real_escape_string($lugar_id);
        $calificacion = (int)$calificacion;
        $nombre_visitante = $this->db->real_escape_string($nombre_visitante);
        $comentario = $comentario ? $this->db->real_escape_string($comentario) : null;
        $ip = $ip ? $this->db->real_escape_string($ip) : null;
        
        if ($calificacion < 1 || $calificacion > 5) {
            return false;
        }
        
        $sql = "INSERT INTO valoraciones (lugar_id, calificacion, nombre_visitante, comentario, ip) 
                VALUES ('$lugar_id', $calificacion, '$nombre_visitante', " . 
                ($comentario ? "'$comentario'" : "NULL") . ", " .
                ($ip ? "'$ip'" : "NULL") . ")";
        
        return $this->db->query($sql);
    }
    
    /**
     * Verificar si una IP ya valoró recientemente (evitar spam)
     */
    public function verificar_spam($lugar_id, $ip, $minutos = 60){
        $lugar_id = $this->db->real_escape_string($lugar_id);
        $ip = $this->db->real_escape_string($ip);
        
        $sql = "SELECT COUNT(*) as total 
                FROM valoraciones 
                WHERE lugar_id = '$lugar_id' 
                AND ip = '$ip' 
                AND fecha > DATE_SUB(NOW(), INTERVAL $minutos MINUTE)";
        
        $resultado = $this->db->query($sql);
        $row = $resultado->fetch_assoc();
        
        return $row['total'] > 0;
    }
    
    /**
     * Obtener distribución de calificaciones
     */
    public function obtener_distribucion($lugar_id){
        $lugar_id = $this->db->real_escape_string($lugar_id);
        
        $sql = "SELECT 
                    calificacion,
                    COUNT(*) as total
                FROM valoraciones 
                WHERE lugar_id = '$lugar_id' 
                GROUP BY calificacion 
                ORDER BY calificacion DESC";
        
        $resultado = $this->db->query($sql);
        $distribucion = array();
        
        for($i = 5; $i >= 1; $i--){
            $distribucion[$i] = 0;
        }
        
        while($row = $resultado->fetch_assoc()){
            $distribucion[$row['calificacion']] = $row['total'];
        }
        
        return $distribucion;
    }
    
    /**
     * Eliminar valoración (solo admin)
     */
    public function eliminar_valoracion($id){
        $id = $this->db->real_escape_string($id);
        
        $sql = "DELETE FROM valoraciones WHERE id = '$id'";
        return $this->db->query($sql);
    }
    
    /**
     * Obtener últimas valoraciones del sistema (para el admin)
     */
    public function obtener_ultimas($limite = 10){
        $limite = (int)$limite;
        
        $sql = "SELECT v.*, l.nombre as lugar_nombre 
                FROM valoraciones v
                JOIN lugares_turisticos l ON v.lugar_id = l.id
                ORDER BY v.fecha DESC 
                LIMIT $limite";
        
        $resultado = $this->db->query($sql);
        $valoraciones = array();
        
        while($row = $resultado->fetch_assoc()){
            $valoraciones[] = $row;
        }
        
        return $valoraciones;
    }
    
    /**
     * Obtener estadísticas generales
     */
    public function obtener_estadisticas(){
        $sql = "SELECT 
                    COUNT(*) as total_valoraciones,
                    AVG(calificacion) as promedio_general,
                    MAX(calificacion) as calificacion_maxima,
                    MIN(calificacion) as calificacion_minima
                FROM valoraciones";
        
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    /**
     * (NUEVO) Obtener una valoración específica por su ID
     * @param int $id
     * @return array
     */
    public function get_valoracion($id){
        $id = (int)$id;
        $sql = "SELECT * FROM valoraciones WHERE id = $id";
        $resultado = $this->db->query($sql);
        return $resultado->fetch_assoc();
    }

    /**
     * Modificar una valoración (Admin)
     * @return bool
     */
    public function modificar_valoracion($id, $nombre_visitante, $calificacion, $comentario){
        $id = (int)$id;
        $nombre_visitante = $this->db->real_escape_string($nombre_visitante);
        $calificacion = (int)$calificacion;
        $comentario = $this->db->real_escape_string($comentario);
        
        $sql = "UPDATE valoraciones 
                SET nombre_visitante = '$nombre_visitante', 
                    calificacion = $calificacion, 
                    comentario = '$comentario'
                WHERE id = $id";
                
        return $this->db->query($sql);
    }
}
?>