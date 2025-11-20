<?php
/**
 * Controlador de Categorías
 * MODIFICADO: Agregada protección de rutas CRUD con requiere_admin()
 */

class CategoriasController {
	
	public function __construct(){
		require_once "models/CategoriasModel.php";
	}
	
	// ══════════════════════════════════════════════════════════════
	// LISTAR - NO requiere login (público)
	// ══════════════════════════════════════════════════════════════
	public function index(){
		$categorias = new Categorias_model();
		$data["titulo"] = "Gestión de Categorías";
		$data["categorias"] = $categorias->get_categorias();
		require_once "views/categorias/categorias.php";
	}
	
	// ══════════════════════════════════════════════════════════════
	// NUEVO - SÍ requiere login admin
	// ══════════════════════════════════════════════════════════════
	public function nuevo(){
		// PROTECCIÓN: Solo admin puede acceder
		require_once 'config/session.php';
		requiere_admin();
		
		$data["titulo"] = "Nueva Categoría";
		require_once "views/categorias/categorias_nuevo.php";
	}
	
	// ══════════════════════════════════════════════════════════════
	// GUARDAR - SÍ requiere login admin
	// ══════════════════════════════════════════════════════════════
	public function guarda(){
		// PROTECCIÓN: Solo admin puede guardar
		require_once 'config/session.php';
		requiere_admin();
		
		$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		
		$categorias = new Categorias_model();
		$categorias->insertar($nombre, $descripcion);
		
		$this->index();
	}
	
	// ══════════════════════════════════════════════════════════════
	// MODIFICAR - SÍ requiere login admin
	// ══════════════════════════════════════════════════════════════
	public function modificar(){
		// PROTECCIÓN: Solo admin puede modificar
		require_once 'config/session.php';
		requiere_admin();
		
		$id = $_GET['id'];
		$categorias = new Categorias_model();
		$data["id"] = $id;
		$data["categoria"] = $categorias->get_categoria($id);
		$data["titulo"] = "Modificar Categoría";
		
		require_once "views/categorias/categorias_modifica.php";
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
		$descripcion = $_POST['descripcion'];
		
		$categorias = new Categorias_model();
		$categorias->modificar($id, $nombre, $descripcion);
		
		$this->index();
	}
	
	// ══════════════════════════════════════════════════════════════
	// ELIMINAR - SÍ requiere login admin
	// ══════════════════════════════════════════════════════════════
	public function eliminar($id){
		// PROTECCIÓN: Solo admin puede eliminar
		require_once 'config/session.php';
		requiere_admin();
		
		$categorias = new Categorias_model();
		
		// Verificar si tiene lugares asociados
		$total_lugares = $categorias->contar_lugares($id);
		
		if($total_lugares > 0){
			echo "<script>
					alert('No se puede eliminar esta categoría porque tiene $total_lugares lugar(es) asociado(s). Elimine o reasigne los lugares primero.');
					window.location.href='index.php?c=categorias&a=index';
				  </script>";
		} else {
			$categorias->eliminar($id);
			$this->index();
		}
	}
}
?>