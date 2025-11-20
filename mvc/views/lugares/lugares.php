<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $data["titulo"]; ?></title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/estilos-crema.css">
		<script src="assets/js/bootstrap.min.js"></script>
		<style>
			.card-lugar {
				margin-bottom: 20px;
				transition: transform 0.2s;
			}
			.card-lugar:hover {
				transform: translateY(-5px);
				box-shadow: 0 5px 15px rgba(0,0,0,0.3);
			}
			.admin-badge {
				background: #28a745;
				color: white;
				padding: 5px 15px;
				border-radius: 20px;
				font-size: 14px;
			}
		</style>
	</head>
	
	<body>
		<div class="container">

			<div class="d-flex justify-content-between align-items-center mt-4 mb-4">
				<h2><?php echo $data["titulo"]; ?> - La Paz, Bolivia</h2>

				<div>
					<button id="btnModoOscuro" class="btn btn-secondary btn-sm me-2">🌙</button>
					<?php
					// Verificar si hay sesión activa
					require_once 'config/session.php';
					if (esta_logueado()) {
						// Modo Admin: Mostrar badge y botón logout
						$usuario = obtener_usuario();
						echo '<span class="admin-badge me-2">🔧 Admin: ' . htmlspecialchars($usuario['username']) . '</span>';
						echo '<a href="index.php?c=auth&a=logout" class="btn btn-danger btn-sm">Cerrar Sesión</a>';
					} else {
						// Modo Visitante: Mostrar botón login
						echo '<a href="index.php?c=auth&a=login" class="btn btn-primary">Login Admin</a>';
					}
					?>
				</div>
			</div>
			
			<!-- ══════════════════════════════════════════════════════════════ -->
			<!-- BOTONES CRUD - SOLO PARA ADMIN -->
			<!-- MODIFICACIÓN: Mostrar solo si está logueado -->
			<!-- ══════════════════════════════════════════════════════════════ -->
			<?php if (esta_logueado()): ?>
				<div class="mb-3">
					<a href="index.php?c=lugares&a=nuevo" class="btn btn-primary">Agregar Lugar</a>
					<a href="index.php?c=categorias&a=index" class="btn btn-info">Gestionar Categorías</a>
					<a href="index.php?c=valoraciones&a=ver" class="btn btn-info">Ver Valoraciones</a>
					<a href="index.php?c=usuarios&a=index" class="btn btn-info">Gestionar Usuarios</a>
				</div>
			<?php endif; ?>
			
			<!-- Filtro por categoría (disponible para todos) -->
			<div class="mb-3">
				<label>Filtrar por categoría:</label>
				<select id="filtroCategoria" class="form-select" style="max-width: 300px;" onchange="filtrarPorCategoria()">
					<option value="">Todas las categorías</option>
					<?php 
					$categorias_vistas = array();
					foreach($data["lugares"] as $lugar) {
						if(!in_array($lugar["categoria_id"], $categorias_vistas)) {
							$categorias_vistas[] = $lugar["categoria_id"];
							echo "<option value='{$lugar["categoria_id"]}'>{$lugar["categoria_nombre"]}</option>";
						}
					}
					?>
				</select>
		
			</div>
			
			<!-- VISTA TABLA -->
			<div id="vistaTabla">
				<div class="table-responsive">
					<table class="table table-bordered table-striped">
						<thead class="table-dark">
							<tr>
								<th>Nombre</th>
								<th>Categoría</th>
								<th>Zona</th>
								<th>Dirección</th>
								<th>Teléfono</th>
								<th>Horario</th>
								<th>Precio (Bs.)</th>
								<th>Valorar</th>
								<th>Acciones</th>

							</tr>
						</thead>
						
						<tbody id="tablaLugares">
							<?php foreach($data["lugares"] as $dato): ?>
								<tr class="fila-lugar" data-categoria="<?php echo $dato["categoria_id"]; ?>">
									<td><strong><?php echo $dato["nombre"]; ?></strong></td>
									<td>
										<span class="badge bg-info">
											<?php echo $dato["categoria_nombre"]; ?>
										</span>
									</td>
									<td><?php echo $dato["zona"]; ?></td>
									<td><?php echo $dato["direccion"]; ?></td>
									<td><?php echo $dato["telefono"] ? $dato["telefono"] : '-'; ?></td>
									<td><?php echo $dato["horario"] ? $dato["horario"] : '-'; ?></td>
									<td>
										<?php 
										if($dato["precio"] > 0) {
											echo number_format($dato["precio"], 2);
										} else {
											echo '<span class="badge bg-success">GRATIS</span>';
										}
										?>
									</td>
									
									<td>
										
										<a href="index.php?c=lugares&a=ver&id=<?php echo $dato['id']; ?>">
											<?php echo $dato['nombre']; ?>
										</a>
										
									</td>
									
									<td>
										<!-- ══════════════════════════════════════════════════════════════ -->
										<!-- BOTONES EDITAR/ELIMINAR - SOLO PARA ADMIN -->
										<!-- MODIFICACIÓN: Mostrar solo si está logueado -->
										<!-- ══════════════════════════════════════════════════════════════ -->
										<?php if (esta_logueado()): ?>
											<a href="index.php?c=lugares&a=modificar&id=<?php echo $dato["id"]; ?>" 
											   class="btn btn-warning btn-sm">Editar</a>
											<a href="index.php?c=lugares&a=eliminar&id=<?php echo $dato["id"]; ?>" 
											   class="btn btn-danger btn-sm"
											   onclick="return confirm('¿Está seguro de eliminar este lugar?');">Eliminar</a>
										<?php else: ?>
											<span class="text-muted">-</span>
										<?php endif; ?>
									</td>

									<td>
								</tr>
							<?php endforeach; ?>
					</table>
				</div>
			</div>
			
			
				</div>
			</div>
			
		</div>
		
		<script>
		// Filtrar por categoría (funciona para todos)
		function filtrarPorCategoria() {
			const filtro = document.getElementById('filtroCategoria').value;
			
			// Filtrar en tabla
			const filas = document.querySelectorAll('.fila-lugar');
			filas.forEach(fila => {
				if(!filtro || fila.getAttribute('data-categoria') === filtro) {
					fila.style.display = '';
				} else {
					fila.style.display = 'none';
				}
			});
			
			// Filtrar en tarjetas
			const tarjetas = document.querySelectorAll('.tarjeta-lugar');
			tarjetas.forEach(tarjeta => {
				if(!filtro || tarjeta.getAttribute('data-categoria') === filtro) {
					tarjeta.style.display = '';
				} else {
					tarjeta.style.display = 'none';
				}
			});
		}
		</script>
		<script src="assets/js/dark-mode-toggle.js"></script>
	</body>
</html>