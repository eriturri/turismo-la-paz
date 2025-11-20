<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<div class="container mt-4">
    <h2><?php echo $data['titulo']; ?></h2>
    
    <form action="index.php?c=valoraciones&a=guarda" method="POST" autocomplete="off">
        
        <div class="form-group mb-3">
            <label for="lugar_id">Lugar Turístico</label>
            <select class="form-control" id="lugar_id" name="lugar_id" required>
                <option value="">Seleccione un lugar...</option>
                <?php foreach($data['lugares'] as $lugar): ?>
                    <option value="<?php echo $lugar['id']; ?>"><?php echo $lugar['nombre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="nombre_visitante">Nombre Visitante</label>
            <input type="text" class="form-control" id="nombre_visitante" name="nombre_visitante" required>
        </div>

        <div class="form-group mb-3">
            <label for="calificacion">Calificación</label>
            <select class="form-control" id="calificacion" name="calificacion" required>
                <option value="5">5 Estrellas</option>
                <option value="4">4 Estrellas</option>
                <option value="3">3 Estrellas</option>
                <option value="2">2 Estrellas</option>
                <option value="1">1 Estrella</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="comentario">Comentario</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?c=valoraciones&a=ver" class="btn btn-secondary">Cancelar</a>
    </form>
</div>