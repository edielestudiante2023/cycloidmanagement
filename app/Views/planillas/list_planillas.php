<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Planillas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Planillas</h1>
        <a href="<?= base_url('/planillas/add-planilla') ?>" class="btn btn-primary mb-3">Agregar Planilla</a>
        <table id="planillasTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Planilla</th>
                    <th>Documento</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planillas as $planilla): ?>
                    <tr>
                        <td><?= $planilla['id'] ?></td>
                        <td><?= $planilla['year'] ?></td>
                        <td><?= $planilla['month'] ?></td>
                        <td><?= $planilla['planilla'] ?></td>
                        <td>
                            <a href="<?= base_url('planillas/' . $planilla['documento']) ?>" target="_blank">Ver Documento</a>
                        </td>
                        <td><?= $planilla['observaciones'] ?></td>
                        <td>
                            <a href="<?= base_url('/planillas/edit-planilla/' . $planilla['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="<?= base_url('/planillas/delete-planilla/' . $planilla['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta planilla?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#planillasTable').DataTable();
        });
    </script>
</body>
</html>
