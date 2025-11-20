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
		<div class="container">
			<h2 class="mt-4 mb-4"><?php echo $data["titulo"]; ?></h2>
			
			<a href="index.php?c=lugares&a=index" class="btn btn-secondary mb-3">VOLVER</a>
			
			<div class="card">
				<div class="card-body">
					<form action="index.php?c=lugares&a=actualizar" method="POST">
						<input type="hidden" name="id" value="<?php echo $data["lugar"]["id"]; ?>">
						
						<div class="row mb-3">
							<div class="col-md-8">
								<label class="form-label">Nombre *</label>
								<input type="text" name="nombre" class="form-control" required 
									   value="<?php echo $data["lugar"]["nombre"]; ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label">Categoría *</label>
								<select name="categoria_id" class="form-select" required>
									<option value="">Seleccione...</option>
									<?php foreach($data["categorias"] as $cat): ?>
										<option value="<?php echo $cat["id"]; ?>"
											<?php echo ($cat["id"] == $data["lugar"]["categoria_id"]) ? 'selected' : ''; ?>>
											<?php echo $cat["nombre"]; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						
						<div class="mb-3">
							<label class="form-label">Descripción *</label>
							<textarea name="descripcion" class="form-control" rows="3" required><?php echo $data["lugar"]["descripcion"]; ?></textarea>
						</div>
						
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label">Dirección *</label>
								<input type="text" name="direccion" class="form-control" required
									   value="<?php echo $data["lugar"]["direccion"]; ?>">
							</div>
							<div class="col-md-6">
								<label class="form-label">Zona *</label>
								<input type="text" name="zona" class="form-control" required
									   value="<?php echo $data["lugar"]["zona"]; ?>">
							</div>
						</div>
						
						<div class="row mb-3">
							<div class="col-md-4">
								<label class="form-label">Teléfono</label>
								<input type="text" name="telefono" class="form-control"
									   value="<?php echo $data["lugar"]["telefono"]; ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label">Horario</label>
								<input type="text" name="horario" class="form-control"
									   value="<?php echo $data["lugar"]["horario"]; ?>">
							</div>
							<div class="col-md-4">
								<label class="form-label">Precio (Bs.)</label>
								<input type="number" name="precio" class="form-control" step="0.01" min="0"
									   value="<?php echo $data["lugar"]["precio"]; ?>">
							</div>
						</div>
						
						<div class="mt-4">
							<button type="submit" class="btn btn-warning">GUARDAR</button>
							<a href="index.php?c=lugares&a=index" class="btn btn-secondary">CANCELAR</a>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</body>
</html>