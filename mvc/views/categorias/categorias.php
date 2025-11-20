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
			<!-- ══════════════════════════════════════════════════════════════ -->
			<!-- HEADER CON BOTÓN LOGIN/LOGOUT -->
			<!-- MODIFICACIÓN: Agregar verificación de sesión y botón login -->
			<!-- ══════════════════════════════════════════════════════════════ -->
			<div class="d-flex justify-content-between align-items-center mt-4 mb-4">
				<h2><?php echo $data["titulo"]; ?></h2>
				
				<div>
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
						echo '<a href="index.php?c=auth&a=login" class="btn btn-primary">🔐 Login Admin</a>';
					}
					?>
				</div>
			</div>
			
			<!-- ══════════════════════════════════════════════════════════════ -->
			<!-- BOTONES DE NAVEGACIÓN -->
			<!-- ══════════════════════════════════════════════════════════════ -->
			<div class="mb-3">
				<a href="index.php?c=lugares&a=index" class="btn btn-secondary">← Volver a Lugares</a>
				
				<!-- ══════════════════════════════════════════════════════════════ -->
				<!-- BOTÓN AGREGAR - SOLO PARA ADMIN -->
				<!-- MODIFICACIÓN: Mostrar solo si está logueado -->
				<!-- ══════════════════════════════════════════════════════════════ -->
				<?php if (esta_logueado()): ?>
					<a href="index.php?c=categorias&a=nuevo" class="btn btn-primary">+ Agregar Categoría</a>
				<?php endif; ?>
			</div>
			
			<!-- ══════════════════════════════════════════════════════════════ -->
			<!-- TABLA DE CATEGORÍAS -->
			<!-- ══════════════════════════════════════════════════════════════ -->
			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead class="table-dark">
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>Lugares</th>
							<th>Acciones</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach($data["categorias"] as $dato): ?>
							<tr>
								<td><?php echo $dato["id"]; ?></td>
								<td><strong><?php echo $dato["nombre"]; ?></strong></td>
								<td><?php echo $dato["descripcion"]; ?></td>
								<td>
									<?php 
									$total = $dato["total_lugares"];
									if($total > 0) {
										echo '<span class="badge bg-info">' . $total . ' lugar(es)</span>';
									} else {
										echo '<span class="badge bg-secondary">Sin lugares</span>';
									}
									?>
								</td>
								<td>
									<!-- ══════════════════════════════════════════════════════════════ -->
									<!-- BOTONES EDITAR/ELIMINAR - SOLO PARA ADMIN -->
									<!-- MODIFICACIÓN: Mostrar solo si está logueado -->
									<!-- ══════════════════════════════════════════════════════════════ -->
									<?php if (esta_logueado()): ?>
										<!-- Botón Editar - Siempre disponible -->
										<a href="index.php?c=categorias&a=modificar&id=<?php echo $dato["id"]; ?>" 
										   class="btn btn-warning btn-sm">
										   Editar
										</a>
										
										<!-- Botón Eliminar - Condicional según lugares -->
										<?php if($dato["total_lugares"] == 0): ?>
											<!-- Sin lugares: Botón habilitado -->
											<a href="index.php?c=categorias&a=eliminar&id=<?php echo $dato["id"]; ?>" 
											   class="btn btn-danger btn-sm"
											   onclick="return confirm('¿Está seguro de eliminar esta categoría?');">
											   Eliminar
											</a>
										<?php else: ?>
											<!-- Con lugares: Botón deshabilitado -->
											<button class="btn btn-secondary btn-sm" 
													disabled 
													title="No se puede eliminar porque tiene <?php echo $dato["total_lugares"]; ?> lugar(es) asociado(s)">
												Eliminar
											</button>
										<?php endif; ?>
									<?php else: ?>
										<!-- Modo Visitante: Sin botones -->
										<span class="text-muted">-</span>
									<?php endif; ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			
			<!-- ══════════════════════════════════════════════════════════════ -->
			<!-- INFORMACIÓN ADICIONAL -->
			<!-- ══════════════════════════════════════════════════════════════ -->
			<div class="mt-3">
				<p class="text-muted">
					Total de categorías: <strong><?php echo count($data["categorias"]); ?></strong>
				</p>
				
				<?php if (!esta_logueado()): ?>
					<div class="alert alert-info">
						<strong>ℹ️ Modo Visitante:</strong> 
						Puedes ver las categorías pero no modificarlas. 
						<a href="index.php?c=auth&a=login">Inicia sesión como admin</a> para gestionar categorías.
					</div>
				<?php endif; ?>
			</div>
		</div>
	</body>
</html>