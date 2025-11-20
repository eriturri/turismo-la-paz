<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $data["titulo"]; ?></title>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/estilos-crema.css">
		<script src="assets/js/bootstrap.min.js"></script>
	</head>
	
	<body>
			<div class="top-buttons">
				<button id="btnModoOscuro" class="btn btn-secondary">🌙 Modo Oscuro</button>
				
			</div>

		<div class="container">
			<h2 class="mt-4 mb-4"><?php echo $data["titulo"]; ?></h2>

			<a href="index.php?c=categorias&a=index" class="btn btn-secondary mb-3">← Volver</a>
			
			<div class="card">
				<div class="card-body">
					<form action="index.php?c=categorias&a=actualizar" method="POST">
						<input type="hidden" name="id" value="<?php echo $data["categoria"]["id"]; ?>">
						
						<div class="mb-3">
							<label class="form-label">Nombre de la Categoría *</label>
							<input type="text" name="nombre" class="form-control" required
								   value="<?php echo $data["categoria"]["nombre"]; ?>">
							<small class="text-muted">Nombre corto que identifique la categoría</small>
						</div>
						
						<div class="mb-3">
							<label class="form-label">Descripción</label>
							<textarea name="descripcion" class="form-control" rows="3"><?php echo $data["categoria"]["descripcion"]; ?></textarea>
							<small class="text-muted">Opcional: Explica qué incluye esta categoría</small>
						</div>
						
						<div class="alert alert-info">
							<strong>ID de la categoría:</strong> <?php echo $data["categoria"]["id"]; ?>
						</div>
						
						<div class="mt-4">
							<button type="submit" class="btn btn-warning">GUARDAR</button>
							<a href="index.php?c=categorias&a=index" class="btn btn-secondary">CANCELAR</a>
						</div>
						
					</form>
				</div>
			</div>
		</div>
		<script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/dark-mode-toggle.js"></script>
	</body>
</html>