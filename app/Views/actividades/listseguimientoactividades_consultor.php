<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Listado de Actividades</title>

  <!-- Estilos de Bootstrap y DataTables -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet"/>
  <link href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet"/>
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
          <!-- Columna para control de expansión (index 0) -->
          <th></th>
          <th>ID</th>
          <th>Nombre de la Actividad</th>
          <th>Tipo de Actividad</th>
          <th>Responsable</th>
          <th>Enlaces Adjuntos</th>
          <th>Estado</th>
          <th>Fecha Apertura</th>
          <th>Fecha Vencimiento</th>
          <th>Avance (%)</th>
          <th>Comentarios</th>
          <!-- Documentos Adjuntos (se ocultará con DataTables, index 11) -->
          <th>Documentos Adjuntos</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <!-- Sin filtro en la columna de control (index 0) -->
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
          <!-- Columna de Documentos Adjuntos (index 11). 
               Se deja la <th> pero sin <select> -->
          <th></th>
        </tr>
      </tfoot>
      <tbody>
        <?php foreach ($actividades as $actividad): ?>
          <tr>
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
              <?php if (!empty($actividad['enlaces_adjuntos'])): ?>
                <a href="<?= esc($actividad['enlaces_adjuntos']) ?>"
                   target="_blank" class="btn btn-light btn-sm" data-bs-toggle="tooltip" title="Ir al enlace">
                  <i class="bi bi-link-45deg"></i>
                </a>
              <?php else: ?>
                <span class="text-muted">No disponible</span>
              <?php endif; ?>
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
            <!-- Documentos Adjuntos (oculto con DataTables) -->
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
      var FlatpickrInput = function(options) {
        this.init('flatpickr', options, FlatpickrInput.defaults);
      };

      $.fn.editableutils.inherit(FlatpickrInput, $.fn.editabletypes.abstractinput);

      $.extend(FlatpickrInput.prototype, {
        render: function() {
          var that = this;
          this.fp = flatpickr(this.$input[0], {
            dateFormat: "Y-m-d",
            locale: "es",
            defaultDate: this.$input.val() || null,
            onReady: function(selectedDates, dateStr, instance) {
              // Botón "Hoy"
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
    // Expansión de la fila para mostrar detalles
    function format(row) {
      var $rowCells = $(row.node()).children('td');

      // Extraemos el HTML que se ve en cada celda
      var colID           = $rowCells.eq(1).html();
      var colNombre       = $rowCells.eq(2).html();
      var colTipo         = $rowCells.eq(3).html();
      var colResponsable  = $rowCells.eq(4).html();
      var colEnlaces      = $rowCells.eq(5).html();
      var colEstado       = $rowCells.eq(6).html();
      var colFApertura    = $rowCells.eq(7).html();
      var colFVencimiento = $rowCells.eq(8).html();
      var colAvance       = $rowCells.eq(9).html();
      var colComentarios  = $rowCells.eq(10).html();
      var colDocumentos   = $rowCells.eq(11).html(); // oculto en la tabla, pero lo mostramos

      return `
        <div class="child-details" style="overflow:auto;">
          <table cellpadding="5" cellspacing="0" border="0" style="width:100%;">
            <tr>
              <td style="width:30%;"><strong>ID</strong></td>
              <td style="width:70%;">${colID}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Nombre de la Actividad</strong></td>
              <td style="width:70%;">${colNombre}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Tipo de Actividad</strong></td>
              <td style="width:70%;">${colTipo}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Responsable</strong></td>
              <td style="width:70%;">${colResponsable}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Enlaces Adjuntos</strong></td>
              <td style="width:70%;">${colEnlaces}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Estado</strong></td>
              <td style="width:70%;">${colEstado}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Fecha Apertura</strong></td>
              <td style="width:70%;">${colFApertura}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Fecha Vencimiento</strong></td>
              <td style="width:70%;">${colFVencimiento}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Avance (%)</strong></td>
              <td style="width:70%;">${colAvance}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Comentarios</strong></td>
              <td style="width:70%;">${colComentarios}</td>
            </tr>
            <tr>
              <td style="width:30%;"><strong>Documentos Adjuntos</strong></td>
              <td style="width:70%;">${colDocumentos}</td>
            </tr>
          </table>
        </div>
      `;
    }

    $(document).ready(function() {
      // Configuración base para X-Editable
      var editableDefaults = {
        mode: 'inline',
        ajaxOptions: {
          type: 'POST',
          dataType: 'json'
        },
        success: function(response) {
          if (response && response.status === 'error') {
            return response.msg;
          }
        },
        error: function() {
          return 'Error al actualizar el campo. Por favor, intente nuevamente.';
        }
      };
      $.extend($.fn.editable.defaults, editableDefaults);

      // Inicializar x-editable
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
      $('.editable[data-type="flatpickr"]').editable({
        format: 'Y-m-d',
        display: function(value) {
          if (!value) {
            $(this).empty();
            return;
          }
          var fpDate = flatpickr.parseDate(value, "Y-m-d");
          var formatted = fpDate ? flatpickr.formatDate(fpDate, "d/m/Y") : value;
          $(this).text(formatted);
        }
      });

      // Inicializar DataTables
      var table = $('#evaluacionesTable').DataTable({
        stateSave: true,
        responsive: true,
        dom:
          "<'row'<'col-sm-12 col-md-6'B>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
          {
            extend: 'colvis',
            text: 'Columnas Visibles'
          },
          {
            extend: 'excelHtml5',
            text: 'Exportar a Excel'
          }
        ],
        columnDefs: [
          {
            // Columna para expandir fila
            targets: 0,
            orderable: false,
            className: 'details-control',
            data: null,
            defaultContent: '<i class="bi bi-plus-circle-fill"></i>'
          },
          {
            // Ocultamos Documentos Adjuntos (index 11)
            targets: 11,
            visible: false
          }
        ],
        order: [[1, 'asc']], // Ordenar por ID (index 1)
        initComplete: function() {
          this.api().columns().every(function() {
            var column = this;
            // Omitir la columna de expansión (0) y la oculta (11)
            if (column.index() === 0 || column.index() === 11) return;

            var select = $('select', column.footer());
            if (select.length) {
              var uniqueData = [];
              column.nodes().to$().each(function() {
                // Tomamos solo el texto (sin HTML)
                var cellText = $(this).text().trim();
                if (cellText && $.inArray(cellText, uniqueData) === -1) {
                  uniqueData.push(cellText);
                }
              });
              uniqueData.sort().forEach(function(d) {
                select.append('<option value="' + d + '">' + d + '</option>');
              });
              // Aquí cambiamos la búsqueda a un modo más flexible:
              select.on('change', function() {
                var val = $(this).val() || '';
                // Búsqueda como subcadena (NO regex estricto)
                column.search(val, false, false).draw();
              });
            }
          });
        },
        drawCallback: function() {
          // Inicializar tooltips de Bootstrap
          var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
          tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
          });
        }
      });

      // Control para expandir/ocultar la fila hija
      $('#evaluacionesTable tbody').on('click', 'td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
        if (row.child.isShown()) {
          row.child.hide();
          tr.removeClass('shown');
        } else {
          row.child(format(row)).show();
          tr.addClass('shown');
        }
      });

      // Botón para limpiar filtros (stateSave)
      $('#clearState').on('click', function() {
        localStorage.removeItem('DataTables_evaluacionesTable_/');
        table.state.clear();
        location.reload();
      });
    });
  </script>
</body>
</html>
