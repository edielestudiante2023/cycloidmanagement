<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Bienvenido al Dashboard de Administrador</h1>
        <p class="text-center">Aquí puedes gestionar la plataforma, el mantenimiento y los desarrollos.</p>

        <table id="gestionTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Elemento</th>
                    <th>Detalle</th>
                    <th>Enlace</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Archivos de gestión</td>
                    <td>Conciliaciones e Indicadores</td>
                    <td>
                        <a href="<?php echo base_url('/info-socios'); ?>" target="_blank" class="btn btn-primary">
                            Ver Dashboards
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Planillas de Seguridad Social</td>
                    <td>Soporte planilla PDF</td>
                    <td>
                        <a href="<?php echo base_url('/planillas/list-planillas'); ?>" target="_blank" class="btn btn-primary">
                            Ver Dashboards
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Videos Tutoriales</td>
                    <td>Aprendizaje Organizativo</td>
                    <td>
                        <a href="<?php echo base_url('videos-capacitaciones'); ?>" target="_blank" class="btn btn-primary">
                            Ver Dashboards
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Perfiles</td>
                    <td>Lista de perfiles</td>
                    <td>
                        <button onclick="window.location.href='http://localhost/cycloidmanagement/public/profiles/list'" class="btn btn-secondary">
                            Ir a la Lista de Perfiles
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Usuarios</td>
                    <td>Lista de usuarios</td>
                    <td>
                        <button onclick="window.location.href='http://localhost/cycloidmanagement/public/users/list'" class="btn btn-secondary">
                            Ir a la Lista de Usuarios
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Botón de cerrar sesión al final -->
        <div class="text-end mt-4">
            <a href="<?= base_url('logout') ?>" class="btn btn-danger">Cerrar Sesión</a>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#gestionTable').DataTable();
        });
    </script>
</body>
</html>
