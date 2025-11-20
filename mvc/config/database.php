<?php
	
	class Conectar {
		
		public static function conexion(){
			
			$conexion = new mysqli("localhost", "root", "", "turismo_la_paz_simple");
			return $conexion;
			
		}
	}
?>