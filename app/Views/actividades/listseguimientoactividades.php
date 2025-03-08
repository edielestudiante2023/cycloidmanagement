<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Listado de Actividades</title>

  <!-- Estilos de Bootstrap y DataTables -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet"/>

  <style>
    /* Modern color scheme */
    body {
      background-color: #f8f9fa;
      color: #343a40;
    }
    h1 {
      color: #007bff;
    }

    /* Ajustes de diseño: misma altura de filas y ajuste de columnas */
    table.dataTable tbody tr {
      height: 50px;
      transition: background-color 0.3s;
    }
    table.dataTable tbody tr:hover {
      background-color: #e9ecef;
    }
    table.dataTable th,
    table.dataTable td {
      white-space: nowrap;
    }

    /* Estilo para botones modernos */
    .btn-moderno {
      font-weight: 500;
      letter-spacing: 0.25px;
      border-radius: 50px;
      transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
    }
    .btn-moderno:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
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
          <!-- Columna 0) Acciones -->
          <th>Acciones</th>
          <!-- Columna 1) ID -->
          <th>ID</th>
          <!-- Columna 2) Nombre de la Actividad -->
          <th>Nombre de la Actividad</th>
          <!-- Columna 3) Tipo de Actividad -->
          <th>Tipo de Actividad</th>
          <!-- Columna 4) Responsable -->
          <th>Responsable</th>
          <!-- NUEVA Columna 5) Enlaces Adjuntos (justo después de responsable) -->
          <th>Enlaces Adjuntos</th>
          <!-- Columna 6) Estado -->
          <th>Estado</th>
          <!-- Columna 7) Fecha Apertura -->
          <th>Fecha Apertura</th>
          <!-- Columna 8) Fecha Vencimiento -->
          <th>Fecha Vencimiento</th>
          <!-- Columna 9) Avance (%) -->
          <th>Avance (%)</th>
          <!-- Columna 10) Comentarios -->
          <th>Comentarios</th>
        </tr>
      </thead>

      <tfoot>
        <tr>
          <th></th> <!-- Sin filtro para Acciones -->
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
            <!-- 0) Acciones -->
            <td>
              <a href="<?= base_url('actividades/edit/' . esc($actividad['id_actividad'])) ?>"
                 class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                Editar
              </a>
              <a href="<?= base_url('actividades/delete/' . esc($actividad['id_actividad'])) ?>"
                 class="btn btn-danger btn-sm"
                 onclick="return confirm('¿Estás seguro de eliminar esta actividad?');"
                 data-bs-toggle="tooltip" title="Eliminar">
                Eliminar
              </a>
            </td>
            <!-- 1) ID -->
            <td><?= esc($actividad['id_actividad']) ?></td>
            <!-- 2) Nombre de la Actividad -->
            <td><?= esc($actividad['nombre_actividad']) ?></td>
            <!-- 3) Tipo de Actividad -->
            <td><?= esc($actividad['tipo_titulo']) ?></td>
            <!-- 4) Responsable -->
            <td><?= esc($actividad['responsable']) ?></td>
            <!-- 5) Enlaces Adjuntos -->
            <td>
              <?php if (!empty($actividad['enlaces_adjuntos'])): ?>
                <a href="<?= esc($actividad['enlaces_adjuntos']) ?>"
                   target="_blank"
                   class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Ir al enlace">
                  <i class="bi bi-link-45deg"></i>
                </a>
              <?php else: ?>
                <span class="text-muted">No disponible</span>
              <?php endif; ?>
            </td>
            <!-- 6) Estado -->
            <td><?= esc($actividad['estado']) ?></td>
            <!-- 7) Fecha Apertura -->
            <td><?= esc($actividad['fecha_apertura']) ?></td>
            <!-- 8) Fecha Vencimiento -->
            <td><?= esc($actividad['fecha_vencimiento']) ?></td>
            <!-- 9) Avance (%) -->
            <td><?= esc($actividad['avance']) ?>%</td>
            <!-- 10) Comentarios -->
            <td><?= esc($actividad['comentarios']) ?></td>
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
      // Inicializamos DataTable
      var table = $('#evaluacionesTable').DataTable({
        stateSave: true,
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'B>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
          {
            extend: 'colvis',
            text: 'Columnas Visibles'
          },
          {
            extend: 'excelHtml5',
            text: 'Exportar a Excel',
            exportOptions: {
              // Oculta la columna Acciones (índice 0)
              columns: ':visible:not(:first-child)'
            }
          }
        ],
        initComplete: function() {
          // Inicializar filtros desplegables en <tfoot> para cada columna
          this.api().columns().every(function(index) {
            // Saltar la primera columna ("Acciones", índice 0)
            if (index === 0) return;

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
          // Inicializar tooltips en cada draw
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
          tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
          });
        }
      });

      // Botón para limpiar el state (filtros)
      $('#clearState').on('click', function() {
        localStorage.removeItem('DataTables_evaluacionesTable_/');
        table.state.clear();
        location.reload();
      });
    });
  </script>
</body>
</html>
