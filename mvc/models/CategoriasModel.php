<?php
	
	class Categorias_model {
		
		private $db;
		private $categorias;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			$this->categorias = array();
		}

		public function get_categorias(){
        $sql = "SELECT 
                    c.id, 
                    c.nombre, 
                    c.descripcion, 
                    COUNT(l.id) as total_lugares 
                FROM 
                    categorias as c
                LEFT JOIN 
                    lugares_turisticos as l ON c.id = l.categoria_id
                GROUP BY 
                    c.id, c.nombre, c.descripcion";
        
        $resultado = $this->db->query($sql);
        
        if (!$resultado) {
            // Manejo básico de error
            echo "Error en la consulta: " . $this->db->error;
            return [];
        }
        
        while($row = $resultado->fetch_assoc()){
            $this->categorias[] = $row;
        }
        return $this->categorias;
    }
		public function get_categoria($id)
		{
			$sql = "SELECT * FROM categorias WHERE id='$id' LIMIT 1";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row;
		}
		
		// INSERTAR nueva categoría
		public function insertar($nombre, $descripcion){
			$sql = "INSERT INTO categorias (nombre, descripcion) 
					VALUES ('$nombre', '$descripcion')";
			$resultado = $this->db->query($sql);
			return $resultado;
		}
		
		// MODIFICAR categoría existente
		public function modificar($id, $nombre, $descripcion){
			$sql = "UPDATE categorias SET 
					nombre='$nombre', 
					descripcion='$descripcion'
					WHERE id = '$id'";
			$resultado = $this->db->query($sql);
			return $resultado;
		}
		
		// ELIMINAR categoría
		public function eliminar($id){
			$sql = "DELETE FROM categorias WHERE id = '$id'";
			$resultado = $this->db->query($sql);
			return $resultado;
		}
		
		// Contar cuántos lugares tiene una categoría
		public function contar_lugares($id){
			$sql = "SELECT COUNT(*) as total FROM lugares_turisticos WHERE categoria_id = '$id'";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();
			return $row['total'];
		}
	} 
?>