<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Lista de Videos de Capacitación Back Office</h1>
    <a href="<?= base_url('videos-capacitaciones-back/add') ?>" class="btn btn-primary mb-3">Agregar Video</a>
    <table id="videosTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Elemento</th>
                <th>Detalles</th>
                <th>Enlace</th>
                <th>Acciones</th>
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
                        <a href="<?= base_url('videos-capacitaciones-back/edit/' . $video['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="<?= base_url('videos-capacitaciones-back/delete/' . $video['id']) ?>" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#videosTable').DataTable();
    });
</script>
</body>
</html>
