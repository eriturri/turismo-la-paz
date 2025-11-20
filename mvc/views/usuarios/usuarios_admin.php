<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/estilos-crema.css">

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><?php echo $data['titulo']; ?></h2>
        <div>
            <a href="index.php?c=usuarios&a=nuevo" class="btn btn-primary">➕ Nuevo Usuario</a>
            <a href="index.php?c=lugares" class="btn btn-secondary">Volver a Lugares</a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre de Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data["usuarios"] as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    
                    <td><?php echo $user['username']; ?></td>
                    
                    <td>
                        <a href="index.php?c=usuarios&a=modificar&id=<?php echo $user["id"]; ?>" 
                           class="btn btn-warning btn-sm">Editar</a>
                        
                        <?php // Seguridad: No permitir borrar al usuario ID 1 (admin principal) ?>
                        <?php if ($user['id'] != 1): ?>
                            <a href="index.php?c=usuarios&a=eliminar&id=<?php echo $user["id"]; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Seguro que desea eliminar a este usuario?');">Eliminar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>