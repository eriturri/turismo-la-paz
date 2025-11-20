<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/estilos-crema.css">

<div class="container mt-4">
    <h2><?php echo $data['titulo']; ?></h2>
    
    <form action="index.php?c=usuarios&a=actualizar" method="POST" autocomplete="off">
        
        <input type="hidden" name="id" value="<?php echo $data['usuario']['id']; ?>">

        <div class="form-group mb-3">
            
            <label for="usuario">Nombre de Usuario</label>
            
            <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $data['usuario']['username']; ?>" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
            <small class="form-text text-muted">Dejar en blanco para no cambiar la contraseña actual.</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="index.php?c=usuarios" class="btn btn-secondary">Cancelar</a>
    </form>
</div>