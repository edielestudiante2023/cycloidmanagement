<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Listado de Actividades</title>

  <!-- Estilos de Bootstrap y DataTables -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet" />
  <!-- X-Editable CSS -->
  <link href="https://cdn.jsdelivr.net/npm/x-editable@1.5.1/dist/bootstrap-editable/css/bootstrap-editable.css" rel="stylesheet">
  <!-- Flatpickr CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <style>
    /* Modern color scheme */
    body {
      background-color: #f8f9fa;
      color: #343a40;
    }

    h1 {
      color: #007bff;
    }

    /* Ajustes para el diseño de la tabla */
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

    .editable-click,
    a.editable-click,
    a.editable-click:hover {
      border-bottom: dashed 1px #007bff;
      cursor: pointer;
    }

    .loading {
      opacity: 0.5;
      pointer-events: none;
    }

    .editable-container.editable-inline {
      max-width: 200px;
    }

    .editable-input {
      width: 100%;
    }

    .editable-error-block {
      color: #dc3545;
      font-size: 12px;
      margin-top: 5px;
    }

    /* Botón estilos */
    .btn-secondary {
      background-color: #6c757d;
      border-color: #6c757d;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
      border-color: #545b62;
    }

    /* Estilo para la fila expandible */
    .child-details {
      overflow: auto;
    }
  </style>
</head>

<body>
  <div class="container-fluid mt-5">
    <h1 class="mb-4">Seguimiento de Actividades</h1>

    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <!-- Botón para restablecer filtros -->
    <button id="clearState" class="btn btn-secondary mb-3">Restablecer Filtros</button>

    <table id="evaluacionesTable" class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <!-- Columna para control de expansión -->
          <th></th>
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
          <!-- Sin filtro en la columna de control -->
          <th></th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
          <th>
            <select class="form-select form-select-sm">
              <option value=""></option>
            </select>
          </th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($actividades as $actividad): ?>
          <tr>
            <!-- Celda para el botón de expansión (vacía) -->
            <td></td>
            <td><?= esc($actividad['id_actividad']) ?></td>
            <td><?= esc($actividad['nombre_actividad']) ?></td>
            <td><?= esc($actividad['tipo_titulo']) ?></td>
            <td>
              <a href="#" class="editable"
                data-type="text"
                data-pk="<?= esc($actividad['id_actividad']) ?>"
                data-name="responsable"
                data-url="<?= base_url('seguimientoactividades/updateField') ?>"
                data-title="Editar Responsable">
                <?= esc($actividad['responsable']) ?>
              </a>
            </td>
            <td>
              <a href="#" class="editable"
                data-type="select"
                data-pk="<?= esc($actividad['id_actividad']) ?>"
                data-name="estado"
                data-url="<?= base_url('seguimientoactividades/updateField') ?>"
                data-title="Editar Estado"
                data-source='[{"value": "abierto", "text": "Abierto"}, {"value": "gestionando", "text": "Gestionando"}, {"value": "cerrado", "text": "Cerrado"}]'>
                <?= esc($actividad['estado']) ?>
              </a>
            </td>
            <!-- Columna Fecha Apertura con data-order -->
            <td data-order="<?= esc($actividad['fecha_apertura']) ?>">
              <a href="#" class="editable"
                data-type="flatpickr"
                data-pk="<?= esc($actividad['id_actividad']) ?>"
                data-name="fecha_apertura"
                data-url="<?= base_url('seguimientoactividades/updateField') ?>"
                data-title="Editar Fecha de Apertura">
                <?= esc($actividad['fecha_apertura']) ?>
              </a>
            </td>
            <!-- Columna Fecha Vencimiento con data-order -->
            <td data-order="<?= esc($actividad['fecha_vencimiento']) ?>">
              <a href="#" class="editable"
                data-type="flatpickr"
                data-pk="<?= esc($actividad['id_actividad']) ?>"
                data-name="fecha_vencimiento"
                data-url="<?= base_url('seguimientoactividades/updateField') ?>"
                data-title="Editar Fecha de Vencimiento">
                <?= esc($actividad['fecha_vencimiento']) ?>
              </a>
            </td>
            <!-- Columna Avance (%) con data-order -->
            <td data-order="<?= esc($actividad['avance']) ?>">
              <a href="#" class="editable"
                data-type="number"
                data-pk="<?= esc($actividad['id_actividad']) ?>"
                data-name="avance"
                data-url="<?= base_url('seguimientoactividades/updateField') ?>"
                data-title="Editar Avance"
                data-min="0"
                data-max="100">
                <?= esc($actividad['avance']) ?>
              </a>%
            </td>
            <td>
              <a href="#" class="editable"
                data-type="textarea"
                data-pk="<?= esc($actividad['id_actividad']) ?>"
                data-name="comentarios"
                data-url="<?= base_url('seguimientoactividades/updateField') ?>"
                data-title="Editar Comentarios">
                <?= esc($actividad['comentarios']) ?>
              </a>
            </td>
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
  <!-- X-Editable JS -->
  <script src="https://cdn.jsdelivr.net/npm/x-editable@1.5.1/dist/bootstrap-editable/js/bootstrap-editable.min.js"></script>
  <!-- Flatpickr JS y localización en español -->
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
  <!-- Moment.js (opcional, para formateo adicional) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <!-- Extensión personalizada de X-Editable para Flatpickr con botón "Hoy" -->
  <script>
    (function($) {
      // Definición del nuevo input type "flatpickr" para X-Editable
      var FlatpickrInput = function(options) {
        this.init('flatpickr', options, FlatpickrInput.defaults);
      };

      $.fn.editableutils.inherit(FlatpickrInput, $.fn.editabletypes.abstractinput);

      $.extend(FlatpickrInput.prototype, {
        render: function() {
          var that = this;
          // Inicializa Flatpickr sobre el input con configuración común
          this.fp = flatpickr(this.$input[0], {
            dateFormat: "Y-m-d",
            locale: "es",
            defaultDate: this.$input.val() || null,
            onReady: function(selectedDates, dateStr, instance) {
              // Crear botón "Hoy" y agregarlo al contenedor del calendario
              var fpContainer = instance.calendarContainer;
              var todayButton = document.createElement("button");
              todayButton.type = "button";
              todayButton.textContent = "Hoy";
              todayButton.className = "btn btn-sm btn-secondary fp-today-button";
              todayButton.style.margin = "5px";
              todayButton.addEventListener("click", function(e) {
                e.preventDefault();
                instance.setDate(new Date(), true);
                instance.close();
              });
              fpContainer.appendChild(todayButton);
            },
            onChange: function(selectedDates, dateStr) {
              that.$input.val(dateStr);
            }
          });
        },
        value2str: function(value) {
          return value ? value : '';
        },
        str2value: function(str) {
          return str;
        },
        value2input: function(value) {
          this.$input.val(value);
          if (this.fp) {
            this.fp.setDate(value, true);
          }
        },
        input2value: function() {
          return this.$input.val();
        },
        activate: function() {
          this.$input.focus();
        },
        autosubmit: function() {
          this.$input.on('keydown', function(e) {
            if (e.which === 13) {
              $(this).closest('form').submit();
            }
          });
        }
      });

      FlatpickrInput.defaults = $.extend({}, $.fn.editabletypes.abstractinput.defaults, {
        tpl: '<input type="text" class="form-control flatpickr-input">'
      });

      $.fn.editabletypes.flatpickr = FlatpickrInput;
    }(window.jQuery));
  </script>

  <script>
    // Función que retorna el HTML con los detalles de la fila (30% para el nombre, 70% para el valor)
    function format(d) {
      // d es un array con los datos de la fila. Debido a que se agregó una columna extra al inicio,
      // el índice 0 es la columna de control y los datos reales inician en el índice 1.
      return '<div class="child-details" style="overflow:auto;">' +
        '<table cellpadding="5" cellspacing="0" border="0" style="width:100%;">' +
          '<tr>' +
            '<td style="width:30%;"><strong>ID</strong></td>' +
            '<td style="width:70%;">' + d[1] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Nombre de la Actividad</strong></td>' +
            '<td style="width:70%;">' + d[2] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Tipo de Actividad</strong></td>' +
            '<td style="width:70%;">' + d[3] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Responsable</strong></td>' +
            '<td style="width:70%;">' + d[4] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Estado</strong></td>' +
            '<td style="width:70%;">' + d[5] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Fecha Apertura</strong></td>' +
            '<td style="width:70%;">' + d[6] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Fecha Vencimiento</strong></td>' +
            '<td style="width:70%;">' + d[7] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Avance (%)</strong></td>' +
            '<td style="width:70%;">' + d[8] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Comentarios</strong></td>' +
            '<td style="width:70%;">' + d[9] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Documentos Adjuntos</strong></td>' +
            '<td style="width:70%;">' + d[10] + '</td>' +
          '</tr>' +
          '<tr>' +
            '<td style="width:30%;"><strong>Enlaces Adjuntos</strong></td>' +
            '<td style="width:70%;">' + d[11] + '</td>' +
          '</tr>' +
        '</table>' +
      '</div>';
    }

    $(document).ready(function() {
      // Configuración base para X-Editable
      var editableDefaults = {
        mode: 'inline',
        ajaxOptions: {
          type: 'POST',
          dataType: 'json'
        },
        success: function(response, newValue) {
          if (response && response.status === 'error') {
            return response.msg;
          }
        },
        error: function(response, newValue) {
          return 'Error al actualizar el campo. Por favor, intente nuevamente.';
        }
      };

      $.extend($.fn.editable.defaults, editableDefaults);

      // Inicializar campos de diferentes tipos
      $('.editable[data-type="text"]').editable();
      $('.editable[data-type="select"]').editable();
      $('.editable[data-type="number"]').editable({
        validate: function(value) {
          if (value < 0 || value > 100) {
            return 'El avance debe estar entre 0 y 100';
          }
        }
      });
      $('.editable[data-type="textarea"]').editable();

      // Inicializar campos de fecha con Flatpickr (para ambas columnas, apertura y vencimiento)
      $('.editable[data-type="flatpickr"]').editable({
        format: 'Y-m-d',
        display: function(value) {
          if (!value) {
            $(this).empty();
            return;
          }
          // Formatear la fecha a "d/m/Y" para mostrarla al usuario
          var fpDate = flatpickr.parseDate(value, "Y-m-d");
          var formatted = fpDate ? flatpickr.formatDate(fpDate, "d/m/Y") : value;
          $(this).text(formatted);
        }
      });

      // Inicializar DataTables con la columna de control para la fila expandible
      var table = $('#evaluacionesTable').DataTable({
        stateSave: true,
        responsive: true,
        dom: "<'row'<'col-sm-12 col-md-6'B>>" +
             "<'row'<'col-sm-12'tr>>" +
             "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [{
            extend: 'colvis',
            text: 'Columnas Visibles'
          },
          {
            extend: 'excelHtml5',
            text: 'Exportar a Excel'
          }
        ],
        // Definimos la primera columna (índice 0) para el botón de expansión
        columnDefs: [{
          orderable: false,
          className: 'details-control',
          targets: 0,
          data: null,
          defaultContent: '<i class="bi bi-plus-circle-fill"></i>'

        }],
        // Como la columna de control es la 0, la ordenación inicial se hace por la columna 1 (ID)
        order: [[1, 'asc']],
        initComplete: function() {
          this.api().columns().every(function() {
            var column = this;
            // Evitamos agregar filtro a la columna de control (índice 0)
            if (column.index() === 0) return;
            var select = $('select', column.footer());
            if (select.length) {
              var uniqueData = [];
              // Extraer el texto limpio de cada celda
              column.nodes().to$().each(function() {
                var cellText = $(this).text().trim();
                if (cellText !== "" && $.inArray(cellText, uniqueData) === -1) {
                  uniqueData.push(cellText);
                }
              });
              uniqueData.sort().forEach(function(d) {
                select.append('<option value="' + d + '">' + d + '</option>');
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

      // Evento para la expansión/contracción de la fila
      $('#evaluacionesTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
          // La fila ya está abierta: la cerramos
          row.child.hide();
          tr.removeClass('shown');
        } else {
          // Abrir la fila con la información extra
          row.child(format(row.data())).show();
          tr.addClass('shown');
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
