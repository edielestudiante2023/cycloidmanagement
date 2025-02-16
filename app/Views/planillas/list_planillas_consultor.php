<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Planillas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Lista de Planillas</h1>
        <a href="<?= base_url('/planillas/add-planilla') ?>" class="btn btn-primary mb-3">Agregar Planilla</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <table id="planillasTable" class="table table-striped">
            <thead>
                <tr>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Planilla</th>
                    <th>Documento</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($planillas as $planilla): ?>
                    <tr>
                        <td><?= esc($planilla['year']) ?></td>
                        <td><?= esc($planilla['month']) ?></td>
                        <td><?= esc($planilla['planilla']) ?></td>
                        <td>
                            <?php if ($planilla['documento']): ?>
                                <a href="<?= base_url('planillas/' . esc($planilla['documento'])) ?>" 
                                   class="btn btn-primary btn-sm" target="_blank">
                                    Ver Documento
                                </a>
                            <?php else: ?>
                                No disponible
                            <?php endif; ?>
                        </td>
                        <td><?= esc($planilla['observaciones']) ?></td>
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
            $('#planillasTable').DataTable({
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
