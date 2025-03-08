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

    /* Estilo para la celda que sirve como "control" de expandir/colapsar */
    td.dt-control {
      cursor: pointer;
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
          <!-- 1) Primera columna: Acciones -->
          <th>Acciones</th>

          <!-- 2) Segunda columna: ícono expandir/colapsar -->
          <th></th>

          <!-- 3) Las siguientes columnas ya existentes -->
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
          <th></th> <!-- sin filtro para acciones -->
          <th></th> <!-- sin filtro para el expand/collapse -->
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
          <!-- En cada <tr> se almacena la info completa en un atributo data-actividad -->
          <tr data-actividad='<?= json_encode($actividad) ?>'>
            <!-- 1) Celda de Acciones -->
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

            <!-- 2) Celda vacía que servirá como 'dt-control' para expandir/colapsar -->
            <td></td>

            <!-- 3) Resto de campos visibles en la fila principal -->
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
                   target="_blank"
                   class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Ver documento">
                  <i class="bi bi-file-earmark-text"></i>
                </a>
              <?php else: ?>
                <span class="text-muted">No disponible</span>
              <?php endif; ?>
            </td>
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
    // Función para construir el contenido del "row child"
    // Ajusta según los campos que quieras mostrar dentro.
    function format(d) {
      // d es el objeto completo de la actividad (JSON)
      // Aquí construimos el HTML con un pequeño "sub-table" o como prefieras.
      return `
        <div style="overflow: auto;">
          <table class="table">
            <tr>
              <td style="width:30%; font-weight: bold;">ID Actividad</td>
              <td style="width:70%;">${d.id_actividad}</td>
            </tr>
            <tr>
              <td style="width:30%; font-weight: bold;">Responsable</td>
              <td style="width:70%;">${d.responsable ?? ''}</td>
            </tr>
            <tr>
              <td style="width:30%; font-weight: bold;">Estado</td>
              <td style="width:70%;">${d.estado ?? ''}</td>
            </tr>
            <tr>
              <td style="width:30%; font-weight: bold;">Comentarios</td>
              <td style="width:70%;">${d.comentarios ?? ''}</td>
            </tr>
            <tr>
              <td style="width:30%; font-weight: bold;">Avance</td>
              <td style="width:70%;">${d.avance ?? ''}%</td>
            </tr>
            <!-- Agrega más filas si quieres mostrar más campos -->
          </table>
        </div>
      `;
    }

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
              // Excluye la primera columna ("Acciones") de la exportación,
              // pero ojo: ahora la segunda es la del "expand/collapse". Ajusta si quieres.
            }
          }
        ],
        // Para que la segunda columna (index = 1) sea la encargada de expandir/colapsar
        columnDefs: [
          {
            className: 'dt-control',
            orderable: false,
            targets: 1  // la segunda columna (comienza en 0 la primera)
          }
        ],
        initComplete: function() {
          // Inicializar filtros desplegables en <tfoot> para cada columna
          this.api().columns().every(function(index) {
            var column = this;
            // Saltarnos las dos primeras columnas (Acciones y expand/collapse)
            if (index < 2) return;

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

      // Evento para expandir/colapsar al hacer clic en la columna .dt-control
      $('#evaluacionesTable tbody').on('click', 'td.dt-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
          // Si ya está abierto, se oculta
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Si está cerrado, se muestra
          // Obtenemos el JSON del atributo data-actividad del <tr>
          var dataActividad = tr.data('actividad');
          row.child(format(dataActividad)).show();
          tr.addClass('shown');
        }
      });

      // Botón para limpiar el state
      $('#clearState').on('click', function() {
        localStorage.removeItem('DataTables_evaluacionesTable_/');
        table.state.clear();
        location.reload();
      });
    });
  </script>
</body>
</html>
