<?php 
/*
 * VISTA: views/lugares/lugares_publico.php (Vista de Detalle y Valoraciones)
 * * NOTA: Asume que BASE_URL está disponible si usas un layout/header.
 */
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['titulo']; ?> - Turismo La Paz</title>
    
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/estilos-crema.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* Paleta de colores crema profesional */
        :root {
            --cream-light: #FAF8F3;
            --cream-medium: #F5F0E8;
            --cream-dark: #E8DCC8;
            --accent-gold: #D4AF37;
            --accent-brown: #8B7355;
            --text-primary: #3E2723;
            --text-secondary: #5D4E37;
        }

        body {
            background;
            background: linear-gradient(135deg, var(--cream-light) 0%, var(--cream-medium) 100%);
            color: var(--text-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Estilo para la imagen destacada */
        .lugar-imagen {
            height: 450px;
            object-fit: cover;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(62, 39, 35, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .lugar-imagen:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(62, 39, 35, 0.25);
        }

        /* Botón volver elegante */
        .btn-volver {
            background-color: var(--cream-dark);
            color: var(--text-primary);
            border: 2px solid var(--accent-brown);
            border-radius: 50px;
            padding: 0.6rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-volver:hover {
            background-color: var(--accent-brown);
            color: white;
            transform: translateX(-5px);
        }

        /* Título principal */
        .titulo-lugar {
            color: var(--accent-brown);
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Badge de categoría */
        .badge-categoria {
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-brown) 100%);
            color: white;
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(212, 175, 55, 0.3);
        }

        /* Lista de información */
        .info-list {
            background-color: white;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 5px 20px rgba(62, 39, 35, 0.1);
            overflow: hidden;
        }

        .info-list .list-group-item {
            background-color: white;
            border: none;
            border-bottom: 1px solid var(--cream-dark);
            padding: 1rem 1.5rem;
            transition: background-color 0.3s ease;
        }

        .info-list .list-group-item:hover {
            background-color: var(--cream-light);
        }

        .info-list .list-group-item:last-child {
            border-bottom: none;
        }

        /* Card de resumen de calificaciones */
        .resumen-card {
            background: linear-gradient(135deg, white 0%, var(--cream-light) 100%);
            border: 2px solid var(--cream-dark);
            border-radius: 1.5rem;
            box-shadow: 0 8px 25px rgba(62, 39, 35, 0.12);
            padding: 2rem;
        }

        .resumen-card h3 {
            color: var(--accent-brown);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        /* Estrellas doradas */
        .estrellas-resumen, .estrellas-comentario {
            color: var(--accent-gold);
            text-shadow: 1px 1px 2px rgba(212, 175, 55, 0.3);
        }

        .rating-numero {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--accent-gold);
        }

        /* Barra de progreso personalizada */
        .progress {
            background-color: var(--cream-medium);
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--accent-gold) 0%, var(--accent-brown) 100%);
            transition: width 0.6s ease;
        }

        /* Card de formulario */
        .form-card {
            background: white;
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 8px 25px rgba(62, 39, 35, 0.12);
            overflow: hidden;
        }

        .form-card .card-body {
            padding: 2rem;
        }

        .form-card .card-title {
            color: var(--accent-brown);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
        }

        /* Inputs del formulario */
        .form-control, .form-select {
            border: 2px solid var(--cream-dark);
            border-radius: 0.8rem;
            padding: 0.8rem 1rem;
            background-color: var(--cream-light);
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-gold);
            background-color: white;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.15);
        }

        .form-label {
            color: var(--text-secondary);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        /* Botón enviar */
        .btn-enviar {
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-brown) 100%);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .btn-enviar:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.4);
        }

        /* Cards de comentarios */
        .comentario-card {
            background: white;
            border: 2px solid var(--cream-dark);
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(62, 39, 35, 0.08);
            transition: all 0.3s ease;
        }

        .comentario-card:hover {
            border-color: var(--accent-gold);
            box-shadow: 0 6px 20px rgba(62, 39, 35, 0.15);
            transform: translateY(-2px);
        }

        .comentario-card .card-body {
            padding: 1.5rem;
        }

        .comentario-card .card-title {
            color: var(--accent-brown);
            font-weight: 600;
        }

        /* Alert */
        .alert-empty {
            background-color: var(--cream-medium);
            border: 2px dashed var(--cream-dark);
            color: var(--text-secondary);
            border-radius: 1rem;
            padding: 1.5rem;
        }

        /* HR decorativo */
        .hr-cream {
            border: none;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, var(--cream-dark) 50%, transparent 100%);
            margin: 3rem 0;
        }

        /* Descripción del lugar */
        .descripcion-lugar {
            color: var(--text-secondary);
            font-size: 1.1rem;
            line-height: 1.8;
        }

        /* Iconos de información */
        .info-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--cream-light);
            margin-right: 0.5rem;
        }

        /* Sección títulos */
        .section-title {
            color: var(--accent-brown);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-gold) 0%, var(--accent-brown) 100%);
            border-radius: 2px;
        }
    </style>
</head>
<body>
<?php ?>

<div class="container mt-5 mb-5">

    <a href="index.php?c=Lugares&a=index" class="btn btn-volver mb-4">
        <i class="bi bi-arrow-left-circle-fill me-1"></i> Volver
    </a>

    <div class="row">
        
        <div class="col-lg-6 mb-4">
            <img src="assets/img/<?php echo $data['lugar']['id']; ?>.jpg" 
                 alt="<?php echo htmlspecialchars($data['lugar']['nombre']); ?>" 
                 class="img-fluid lugar-imagen"
                 onerror="this.onerror=null; this.src='assets/img/default.jpg';">
        </div>

        <div class="col-lg-6 mb-4">
            <h1 class="display-5 titulo-lugar"><?php echo htmlspecialchars($data['lugar']['nombre']); ?></h1>
            <h5 class="mb-3">
                <span class="badge-categoria">
                    <i class="bi bi-tags-fill me-1"></i> <?php echo htmlspecialchars($data['lugar']['categoria_nombre']); ?>
                </span>
            </h5>

            <p class="descripcion-lugar"><?php echo htmlspecialchars($data['lugar']['descripcion']); ?></p>

            <h4 class="mt-4 mb-3 section-title">Información Clave</h4>
            <ul class="list-group info-list">
                
                <li class="list-group-item">
                    <i class="bi bi-geo-alt-fill me-2 text-danger"></i> 
                    <strong>Zona:</strong> <?php echo htmlspecialchars($data['lugar']['zona']); ?>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-signpost-2-fill me-2 text-dark"></i> 
                    <strong>Dirección:</strong> <?php echo htmlspecialchars($data['lugar']['direccion']); ?>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-telephone-fill me-2 text-success"></i> 
                    <strong>Teléfono:</strong> <?php echo $data['lugar']['telefono'] ? htmlspecialchars($data['lugar']['telefono']) : 'No disponible'; ?>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-clock-fill me-2 text-info"></i> 
                    <strong>Horario:</strong> <?php echo htmlspecialchars($data['lugar']['horario']); ?>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-cash me-2 text-success"></i> 
                    <strong>Precio:</strong> 
                    <span class="fw-bold">
                        <?php echo $data['lugar']['precio'] > 0 ? htmlspecialchars(number_format($data['lugar']['precio'], 2)) . ' Bs.' : 'GRATUITO'; ?>
                    </span>
                </li>
            </ul>
        </div>
    </div>

    <hr class="hr-cream">

    <div class="row">

        <div class="col-md-4">
            <div class="resumen-card">
                <h3>Resumen de Calificaciones</h3>
                <?php
                    $promedio = number_format($data['promedio']['promedio'], 1);
                    $total_opiniones = $data['promedio']['total'];
                ?>
                <div class="rating-numero estrellas-resumen"><?php echo $promedio; ?> ★</div>
                <p class="text-muted mt-2">Basado en <?php echo $total_opiniones; ?> opiniones</p>

                <?php 
                    for ($estrella = 5; $estrella >= 1; $estrella--):
                        $total_estrella = $data['distribucion'][$estrella] ?? 0;
                        $porcentaje = ($total_opiniones > 0) ? ($total_estrella / $total_opiniones) * 100 : 0;
                ?>
                        <div class="row align-items-center mb-1">
                            <div class="col-3 text-end text-warning small"><?php echo $estrella; ?> ★</div>
                            <div class="col-9">
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo $porcentaje; ?>%;" aria-valuenow="<?php echo $porcentaje; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card form-card">
                <div class="card-body">
                    <h5 class="card-title">¡Comparte tu experiencia!</h5>
                    <form action="index.php?c=Lugares&a=guardar_valoracion" method="POST">
                        <input type="hidden" name="lugar_id" value="<?php echo $data['lugar']['id']; ?>">
                        
                        <div class="mb-3">
                            <label for="nombre_visitante" class="form-label">Tu Nombre:</label>
                            <input type="text" class="form-control" name="nombre_visitante" id="nombre_visitante" placeholder="Ej: Viajero La Paz" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="calificacion" class="form-label">Tu Calificación:</label>
                            <select class="form-select" name="calificacion" id="calificacion" required>
                                <option value="" disabled selected>-- Selecciona una puntuación --</option>
                                <option value="5">★★★★★ (5 Estrellas - Excelente)</option>
                                <option value="4">★★★★☆ (4 Estrellas - Bueno)</option>
                                <option value="3">★★★☆☆ (3 Estrellas - Regular)</option>
                                <option value="2">★★☆☆☆ (2 Estrellas - Malo)</option>
                                <option value="1">★☆☆☆☆ (1 Estrella - Pésimo)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="comentario" class="form-label">Comentario (Opcional):</label>
                            <textarea class="form-control" name="comentario" id="comentario" rows="3" placeholder="Escribe tu experiencia..."></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-enviar">
                            <i class="bi bi-send-fill me-1"></i> Enviar Opinión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr class="hr-cream">

    <div class="row">
        <div class="col-12">
            <h3 class="section-title">Opiniones de Visitantes</h3>

            <?php if (empty($data['valoraciones'])): ?>
                <div class="alert alert-empty mt-3">
                    <i class="bi bi-chat-left-text me-2"></i>
                    Aún no hay comentarios. ¡Sé el primero en opinar!
                </div>
            <?php else: ?>
                <?php foreach ($data['valoraciones'] as $v): ?>
                    <div class="card comentario-card mb-3">
                        <div class="card-body">
                            <h5 class="card-title mb-0 text-dark">
                                <i class="bi bi-person-circle me-1"></i> <?php echo htmlspecialchars($v['nombre_visitante']); ?>
                            </h5>
                            <p class="card-text estrellas-comentario mb-1">
                                <?php for($i=0; $i < $v['calificacion']; $i++) echo '★'; ?>
                                <?php for($i=0; $i < (5 - $v['calificacion']); $i++) echo '☆'; ?>
                            </p>
                            <p class="card-text text-muted small fst-italic">
                                Publicado el: <?php echo date('d/m/Y \a \l\a\s H:i', strtotime($v['fecha'])); ?>
                            </p>
                            <p class="card-text"><?php echo nl2br(htmlspecialchars($v['comentario'])); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

</div> 
<?php // Aquí se puede incluir un footer.php si lo tienes ?>

<script src="assets/js/bootstrap.min.js"></script>
<?php // Asume que jquery.min.js y bootstrap.min.js están disponibles en esta ruta ?>
</body>
</html>