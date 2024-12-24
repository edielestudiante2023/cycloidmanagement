<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Información de Socios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Listado de Información de Socios</h1>
            <a href="<?= base_url('info-socios/add') ?>" class="btn btn-primary">Agregar Nuevo</a>
        </div>

        <table id="infoSociosTable" class="table table-striped table-hover">
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
                <?php foreach ($info_socios as $socio): ?>
                    <tr>
                        <td><?= htmlspecialchars($socio['id']) ?></td>
                        <td><?= htmlspecialchars($socio['elemento']) ?></td>
                        <td><?= htmlspecialchars($socio['detalles']) ?></td>
                        <td><a href="<?= htmlspecialchars($socio['enlace']) ?>" target="_blank">Ver Enlace</a></td>
                        <td>
                            <a href="<?= base_url('info-socios/edit/' . htmlspecialchars($socio['id'])) ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= base_url('info-socios/delete/' . htmlspecialchars($socio['id'])) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery (obligatorio para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#infoSociosTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                },
                responsive: true,
                order: [[1, 'asc']], // Ordenar por la columna "Elemento" (índice 1) de forma ascendente
                columnDefs: [
                    { targets: 0, visible: false } // Ocultar la primera columna (ID)
                ],
                dom: 'ftip', // Aseguramos que aparezca la barra de búsqueda, paginación e información
            });
        });
    </script>
</body>
</html>
