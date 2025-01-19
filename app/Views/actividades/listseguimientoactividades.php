<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de Actividades</title>

  <!-- Estilos de Bootstrap y DataTables -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet" />

  <style>
    /* Ajustes de diseño: misma altura de filas y ajuste de columnas */
    table.dataTable tbody tr {
      height: 50px;
    }

    table.dataTable th,
    table.dataTable td {
      white-space: nowrap;
    }
  </style>
</head>

<body>
  <div class="container-fluid mt-5">
    <h1 class="mb-4">Seguimiento de Actividades</h1>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <a href="<?= base_url('actividades/add') ?>" class="btn btn-primary mb-3">Agregar Actividad</a>

    <!-- Botón para restablecer filtros -->
    <button id="clearState" class="btn btn-secondary mb-3">Restablecer Filtros</button>

    <table id="evaluacionesTable" class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>Acciones</th>
          <th>ID</th>
          <th>Nombre de la Actividad</th>
          <th>Tipo de Actividad</th>
          <th>Responsable</th>
          <th>Estado</th>
          <th>Fecha Apertura</th>
          <th>Fecha Vencimiento</th>
          <th>Avance (%)</th>
          <th>Comentarios</th>
          <th>Documentos Adjuntos</th>
          <th>Enlaces Adjuntos</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th></th> <!-- Sin filtro para la columna "Acciones" -->
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
          <th><select class="form-select form-select-sm"><option value=""></option></select></th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($actividades as $actividad): ?>
          <tr>
            <!-- Columna "Acciones" movida a la primera posición -->
            <td>
              <a href="<?= base_url('actividades/edit/' . esc($actividad['id_actividad'])) ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                Editar
              </a>
              <a href="<?= base_url('actividades/delete/' . esc($actividad['id_actividad'])) ?>" class="btn btn-danger btn-sm"
                onclick="return confirm('¿Estás seguro de eliminar esta actividad?');" data-bs-toggle="tooltip" title="Eliminar">
                Eliminar
              </a>
            </td>
            <td><?= esc($actividad['id_actividad']) ?></td>
            <td><?= esc($actividad['nombre_actividad']) ?></td>
            <td><?= esc($actividad['tipo_titulo']) ?></td>
            <td><?= esc($actividad['responsable']) ?></td>
            <td><?= esc($actividad['estado']) ?></td>
            <td><?= esc($actividad['fecha_apertura']) ?></td>
            <td><?= esc($actividad['fecha_vencimiento']) ?></td>
            <td><?= esc($actividad['avance']) ?>%</td>
            <td><?= esc($actividad['comentarios']) ?></td>
            <td>
              <?php if (!empty($actividad['documentos_adjuntos'])): ?>
                <a href="<?= base_url('uploads/actividades/' . esc($actividad['documentos_adjuntos'])) ?>"
                   target="_blank" class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Ver documento">
                  <i class="bi bi-file-earmark-text"></i>
                </a>
              <?php else: ?>
                <span class="text-muted">No disponible</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if (!empty($actividad['enlaces_adjuntos'])): ?>
                <a href="<?= esc($actividad['enlaces_adjuntos']) ?>"
                   target="_blank" class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Ir al enlace">
                  <i class="bi bi-link-45deg"></i>
                </a>
              <?php else: ?>
                <span class="text-muted">No disponible</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Scripts necesarios -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.colVis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

  <script>
    $(document).ready(function() {
      var table = $('#evaluacionesTable').DataTable({
        stateSave: true,
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'B>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
          {
            extend: 'colvis',
            text: 'Columnas Visibles',
            className: ''
          },
          {
            extend: 'excelHtml5',
            text: 'Exportar a Excel',
            className: '',
            exportOptions: {
              columns: ':visible:not(:first-child)' 
              // Excluye la primera columna ("Acciones") de la exportación
            }
          }
        ],
        initComplete: function() {
          // Inicializar filtros desplegables en <tfoot> para cada columna
          this.api().columns().every(function() {
            var column = this;
            var select = $('select', column.footer());
            if (select.length) {
              column.data().unique().sort().each(function(d) {
                if (d) {
                  select.append('<option value="' + d + '">' + d + '</option>');
                }
              });
              select.on('change', function() {
                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                column.search(val ? '^' + val + '$' : '', true, false).draw();
              });
            }
          });
        },
        drawCallback: function() {
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
          tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
          });
        }
      });

      $('#clearState').on('click', function() {
        localStorage.removeItem('DataTables_evaluacionesTable_/');
        table.state.clear();
        location.reload();
      });
    });
  </script>
</body>

</html>
