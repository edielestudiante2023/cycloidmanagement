<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Documentos Legales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Documentos Legales</h1>
        <a href="<?= base_url('/doclegal/add-doclegal') ?>" class="btn btn-primary mb-3">Agregar Documento Legal</a>
        <table id="doclegalTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="d-none">ID</th> <!-- Oculto visualmente -->
                    <th>Tipo de Documento</th>
                    <th>Documento</th>
                    <th>Observaciones</th>
                    <th>Fecha de Creación</th> <!-- Nueva columna -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doclegales as $doclegal): ?>
                    <tr>
                        <td class="d-none"><?= $doclegal['id'] ?></td> <!-- Oculto visualmente -->
                        <td><?= $doclegal['tipo_documento'] ?></td>
                        <td>
                            <a href="<?= base_url('uploads/doclegal/' . $doclegal['documento']) ?>" target="_blank">Ver Documento</a>
                        </td>
                        <td><?= $doclegal['observaciones'] ?></td>
                        <td><?= $doclegal['created_at'] ?></td> <!-- Fecha de creación -->
                        <td>
                            <a href="<?= base_url('/doclegal/edit-doclegal/' . $doclegal['id']) ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="<?= base_url('/doclegal/delete-doclegal/' . $doclegal['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este documento legal?');">Eliminar</a>
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
            $('#doclegalTable').DataTable({
                columnDefs: [
                    { targets: 0, visible: false } // Ocultar la columna ID en DataTables
                ]
            });
        });
    </script>
</body>
</html>
