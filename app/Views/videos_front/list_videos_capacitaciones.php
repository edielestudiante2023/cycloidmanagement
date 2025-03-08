<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Lista de Videos de Capacitación Front Office</h1>
    <table id="videosTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Elemento</th>
                <th>Detalles</th>
                <th>Enlace</th>
                <th>Acciones</th> <!-- Se agrega la columna de Acciones -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($videos as $video): ?>
                <tr>
                    <td><?= $video['id'] ?></td>
                    <td><?= $video['elemento'] ?></td>
                    <td><?= $video['detalles'] ?></td>
                    <td><a href="<?= $video['enlace'] ?>" target="_blank">Ver Enlace</a></td>
                    <td>
                        <a href="<?= base_url('videos-capacitaciones-front/edit/' . $video['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="<?= base_url('videos-capacitaciones-front/delete/' . $video['id']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- Inicialización de DataTables -->
<script>
    $(document).ready(function () {
        $('#videosTable').DataTable();
    });
</script>
</body>
</html>
