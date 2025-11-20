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
			
			<a href="index.php?c=categorias&a=index" class="btn btn-secondary mb-3">Volver</a>
			
			<div class="card">
				<div class="card-body">
					<form action="index.php?c=categorias&a=guarda" method="POST">
						
						<div class="mb-3">
							<label class="form-label">Nombre de la Categoría *</label>
							<input type="text" name="nombre" class="form-control" required
								   placeholder="Ej: Sitios Históricos, Naturaleza, Cultura...">
							<small class="text-muted">Nombre corto que identifique la categoría</small>
						</div>
						
						<div class="mb-3">
							<label class="form-label">Descripción</label>
							<textarea name="descripcion" class="form-control" rows="3"
									  placeholder="Describe qué tipo de lugares pertenecen a esta categoría"></textarea>
							<small class="text-muted">Opcional: Explica qué incluye esta categoría</small>
						</div>
						
						<div class="alert alert-warning">
							<strong>Ejemplos de categorías:</strong>
							<ul class="mb-0">
								<li><strong>Sitios Históricos:</strong> Monumentos, museos, lugares con valor histórico</li>
								<li><strong>Naturaleza:</strong> Parques, montañas, lagos, áreas naturales</li>
								<li><strong>Cultura:</strong> Galerías de arte, teatros, centros culturales</li>
								<li><strong>Mercados:</strong> Mercados tradicionales y zonas comerciales</li>
								<li><strong>Gastronomía:</strong> Restaurantes típicos, zonas gastronómicas</li>
								<li><strong>Religioso:</strong> Iglesias, templos, lugares de culto</li>
								<li><strong>Miradores:</strong> Puntos panorámicos con vistas de la ciudad</li>
							</ul>
						</div>
						
						<div class="mt-4">
							<button type="submit" class="btn btn-success">GUARDAR</button>
							<a href="index.php?c=categorias&a=index" class="btn btn-secondary">CANCELAR</a>
						</div>
						
					</form>
				</div>
			</div>
		</div>
	</body>
</html>