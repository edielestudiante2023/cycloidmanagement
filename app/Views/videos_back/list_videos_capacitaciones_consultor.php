<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Videos de Capacitaciones</title>
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- FontAwesome (se utiliza solo uno para evitar duplicidad) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Lista de Videos de Capacitaciones</h1>
        <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('/dashboard-consultor'); ?>" class="btn btn-danger">Regresar</a>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <br>
                    <table class="table table-striped table-bordered" id="datatable" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Elemento</th>
                                <th>Detalles</th>
                                <th>Enlace</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($videos as $video) : ?>
                                <tr>
                                    <td><?php echo $video['id']; ?></td>
                                    <td><?php echo $video['elemento']; ?></td>
                                    <td><?php echo $video['detalles']; ?></td>
                                    <td class="text-center">
                                        <a href="<?php echo $video['enlace']; ?>" target="_blank" class="btn btn-link p-0">
                                            <i class="fas fa-external-link-alt fa-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- JavaScript de Bootstrap (Bundle con Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYQ8kYj3OmrYv+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        new DataTable('#datatable', {
            responsive: true,
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
            }
        });
    </script>
</body>

</html>
