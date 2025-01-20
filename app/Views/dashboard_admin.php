<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin Simplificado</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <style>
        /* Espacio entre la navbar y el contenido */
        body {
            padding-top: 20px;
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

        /* Ajustar el tamaño de las imágenes en la navbar */
        .navbar img {
            max-height: 100px;
        }
    </style>
</head>

<body>
    <!-- Barra de navegación superior sin posición fija -->
    <nav class="navbar navbar-dark  mb-4">
        <div class="container">
            <div class="row w-100 text-center">
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('/imagenes/logocycloidsinfondo.png') ?>" alt="Logo 1" class="img-fluid">
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('/imagenes/psicloidmethod.png') ?>" alt="Logo 2" class="img-fluid">
                </div>
                <div class="col-4 d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('/imagenes/psiclodmind2.png') ?>" alt="Logo 3" class="img-fluid">
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container">
        <h1 class="text-center">Bienvenido al Dashboard de Administrador</h1>
        <p class="text-center">Aquí puedes gestionar la plataforma, el mantenimiento y los desarrollos.</p>

        <div class="card mt-4">
            <div class="card-header">
                Gestión de Elementos
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                    <a href="<?= base_url('/info-socios'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Planillas de Seguridad Social</td>
                                <td>Soporte planilla PDF</td>
                                <td>
                                    <a href="<?= base_url('/planillas/list-planillas'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Otros Videos Tutoriales</td>
                                <td>Temas Administrativos</td>
                                <td>
                                    <a href="<?= base_url('videos-capacitaciones'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Perfiles</td>
                                <td>Lista de perfiles</td>
                                <td>
                                    <a href="<?= base_url('/profiles/list'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Usuarios</td>
                                <td>Lista de usuarios</td>
                                <td>
                                    <a href="<?= base_url('/users/list'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tipos de Elementos a Hacer Seguimiento</td>
                                <td>Lista de ítems</td>
                                <td>
                                    <a href="<?= base_url('/pendientes'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Seguimiento a Compromisos</td>
                                <td>Avances Estratégicos, tácticos y operativos</td>
                                <td>
                                    <a href="<?= base_url('/actividades/list'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Videos del Back</td>
                                <td>Procesos del Back</td>
                                <td>
                                    <a href="<?= base_url('/videos-capacitaciones-back'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Videos del Front</td>
                                <td>Procesos del Front</td>
                                <td>
                                    <a href="<?= base_url('/videos-capacitaciones-front'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Documentos Legales</td>
                                <td>Documentos para clientes y entidades de Control</td>
                                <td>
                                    <a href="<?= base_url('/doclegal/list-doclegales'); ?>" target="_blank" class="btn btn-primary btn-moderno px-4 py-2">
                                        Acceder al recurso
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
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
        $(document).ready(function() {
            $('#gestionTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json'
                }
            });
        });
    </script>
</body>

</html>