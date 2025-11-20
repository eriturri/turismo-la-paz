<?php
	
	class Lugares_model {
		
		private $db;
		private $lugares;
		
		public function __construct(){
			$this->db = Conectar::conexion();
			$this->lugares = array();
		}
		
		public function get_lugares()
		{
			$sql = "SELECT lt.*, c.nombre as categoria_nombre 
					FROM lugares_turisticos lt 
					INNER JOIN categorias c ON lt.categoria_id = c.id 
					ORDER BY lt.nombre ASC";
			$resultado = $this->db->query($sql);
			while($row = $resultado->fetch_assoc())
			{
				$this->lugares[] = $row;
			}
			return $this->lugares;
		}
		
		public function insertar($nombre, $descripcion, $direccion, $zona, $categoria_id, $telefono, $horario, $precio){
			
			$sql = "INSERT INTO lugares_turisticos (nombre, descripcion, direccion, zona, categoria_id, telefono, horario, precio) 
					VALUES ('$nombre', '$descripcion', '$direccion', '$zona', '$categoria_id', '$telefono', '$horario', '$precio')";
			
			$resultado = $this->db->query($sql);
			return $resultado;
		}
		
		public function modificar($id, $nombre, $descripcion, $direccion, $zona, $categoria_id, $telefono, $horario, $precio){
			
			$sql = "UPDATE lugares_turisticos SET 
					nombre='$nombre', 
					descripcion='$descripcion', 
					direccion='$direccion', 
					zona='$zona', 
					categoria_id='$categoria_id',
					telefono='$telefono', 
					horario='$horario', 
					precio='$precio'
					WHERE id = '$id'";
					
			$resultado = $this->db->query($sql);
			return $resultado;
		}
		
		public function eliminar($id){
			
			$sql = "DELETE FROM lugares_turisticos WHERE id = '$id'";
			$resultado = $this->db->query($sql);
			return $resultado;
		}
		
		public function get_lugar($id)
		{
			$sql = "SELECT lt.*, c.nombre as categoria_nombre 
					FROM lugares_turisticos lt 
					INNER JOIN categorias c ON lt.categoria_id = c.id 
					WHERE lt.id='$id' 
					LIMIT 1";
			$resultado = $this->db->query($sql);
			$row = $resultado->fetch_assoc();

			return $row;
		}
		
		public function get_categorias(){
			$sql = "SELECT * FROM categorias ORDER BY nombre ASC";
			$resultado = $this->db->query($sql);
			$categorias = array();
			while($row = $resultado->fetch_assoc())
			{
				$categorias[] = $row;
			}
			return $categorias;
		}
	} 
?>