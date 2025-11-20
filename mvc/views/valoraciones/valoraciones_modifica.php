<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<div class="container mt-4">
    <h2><?php echo $data['titulo']; ?></h2>
    
    <form action="index.php?c=valoraciones&a=actualizar" method="POST" autocomplete="off">
        
        <input type="hidden" name="id" value="<?php echo $data['valoracion']['id']; ?>">

        <div class="form-group mb-3">
            <label for="nombre_visitante">Nombre Visitante</label>
            <input type="text" class="form-control" id="nombre_visitante" name="nombre_visitante" value="<?php echo $data['valoracion']['nombre_visitante']; ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="calificacion">Calificación</label>
            <select class="form-control" id="calificacion" name="calificacion" required>
                <option value="5" <?php echo $data['valoracion']['calificacion'] == 5 ? 'selected' : ''; ?>>5 Estrellas</option>
                <option value="4" <?php echo $data['valoracion']['calificacion'] == 4 ? 'selected' : ''; ?>>4 Estrellas</option>
                <option value="3" <?php echo $data['valoracion']['calificacion'] == 3 ? 'selected' : ''; ?>>3 Estrellas</option>
                <option value="2" <?php echo $data['valoracion']['calificacion'] == 2 ? 'selected' : ''; ?>>2 Estrellas</option>
                <option value="1" <?php echo $data['valoracion']['calificacion'] == 1 ? 'selected' : ''; ?>>1 Estrella</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="comentario">Comentario</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3"><?php echo $data['valoracion']['comentario']; ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?c=valoraciones&a=ver" class="btn btn-secondary">Cancelar</a>
    </form>
</div>