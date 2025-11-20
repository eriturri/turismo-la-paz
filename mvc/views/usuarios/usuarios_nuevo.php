<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/estilos-crema.css">

<div class="container mt-4">
    <h2><?php echo $data['titulo']; ?></h2>
    
    <form action="index.php?c=usuarios&a=guarda" method="POST" autocomplete="off">
        
        <div class="form-group mb-3">
            <label for="usuario">Nombre de Usuario</label>
            <input type="text" class="form-control" id="usuario" name="usuario" required>
        </div>

        <div class="form-group mb-3">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="index.php?c=usuarios" class="btn btn-secondary">Cancelar</a>
    </form>
</div>