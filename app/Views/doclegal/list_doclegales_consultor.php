<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Documentos Legales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Documentos Legales</h1>
        <a href="<?= base_url('/doclegal/add-doclegal') ?>" class="btn btn-primary mb-3">Agregar Documento Legal</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table id="doclegalesTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Tipo de Documento</th>
                    <th>Documento</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($doclegales as $doclegal): ?>
                    <tr>
                        <td><?= esc($doclegal['tipo_documento']) ?></td>
                        <td>
                            <?php if ($doclegal['documento']): ?>
                                <a href="<?= base_url('uploads/doclegal/' . esc($doclegal['documento'])) ?>" 
                                   class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                </a>
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                        <td><?= esc($doclegal['observaciones']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#doclegalesTable').DataTable({
                dom: "<'row'<'col-sm-12 col-md-6'B><'col-sm-12 col-md-6'f>>" +
                     "<'row'<'col-sm-12'tr>>" +
                     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    {
                        extend: 'excel',
                        text: 'Exportar a Excel',
                        className: 'btn btn-success'
                    }
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json'
                }
            });
        });
    </script>
</body>
</html>
