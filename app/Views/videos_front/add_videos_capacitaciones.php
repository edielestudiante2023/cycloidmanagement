<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Agregar Video Front Office</h1>
    <form action="<?= base_url('videos-capacitaciones-front/add') ?>" method="post">
        <div class="mb-3">
            <label for="elemento" class="form-label">Elemento</label>
            <input type="text" class="form-control" id="elemento" name="elemento" required>
        </div>
        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <textarea class="form-control" id="detalles" name="detalles"></textarea>
        </div>
        <div class="mb-3">
            <label for="enlace" class="form-label">Enlace</label>
            <input type="url" class="form-control" id="enlace" name="enlace" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
</body>
</html>
