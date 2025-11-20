<?php 
// (Incluir tu header de admin si tienes uno)
// require_once 'views/layout/header_admin.php'; 
?>
<link rel="stylesheet" href="assets/css/bootstrap.min.css"> <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2><?php echo $data['titulo']; ?></h2>
        <div>
            <a href="index.php?c=valoraciones&a=nuevo" class="btn btn-primary">➕ Nueva Valoración</a>
            <a href="index.php?c=lugares" class="btn btn-secondary">Volver a Lugares</a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Lugar Turístico</th>
                <th>Visitante</th>
                <th>Calificación</th>
                <th>Comentario</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data["valoraciones"] as $v): ?>
                <tr>
                    <td><?php echo $v['lugar_nombre']; ?></td>
                    <td><?php echo $v['nombre_visitante']; ?></td>
                    <td><?php echo $v['calificacion']; ?> ★</td>
                    <td><?php echo $v['comentario']; ?></td>
                    <td><?php echo $v['fecha']; ?></td>
                    <td>
                        <a href="index.php?c=valoraciones&a=editar&id=<?php echo $v["id"]; ?>" 
                           class="btn btn-warning btn-sm">Editar</a>
                        <a href="index.php?c=valoraciones&a=eliminar&id=<?php echo $v["id"]; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que desea eliminar esta valoración?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php // (Incluir tu footer de admin) ?>