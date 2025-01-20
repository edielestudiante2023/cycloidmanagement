<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Documento Legal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar Documento Legal</h1>
        <form action="<?= base_url('/doclegal/add-doclegal-post') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                <input type="text" class="form-control" id="tipo_documento" name="tipo_documento" required>
            </div>
            <div class="mb-3">
                <label for="documento" class="form-label">Documento (PDF)</label>
                <input type="file" class="form-control" id="documento" name="documento" accept="application/pdf" required>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observaciones" name="observaciones" rows="4"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="<?= base_url('/doclegal/list-doclegales') ?>" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
