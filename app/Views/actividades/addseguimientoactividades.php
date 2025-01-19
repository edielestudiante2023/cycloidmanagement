<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Actividad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Agregar Nueva Actividad</h1>
    <form action="<?= base_url('actividades/addpost') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nombre_actividad" class="form-label">Nombre de la Actividad</label>
            <input type="text" id="nombre_actividad" name="nombre_actividad" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="id_tipo" class="form-label">Tipo de Actividad</label>
            <select id="id_tipo" name="id_tipo" class="form-select" required>
                <option value="" disabled selected>Seleccione un tipo</option>
                <?php foreach ($tipos as $tipo): ?>
                    <option value="<?= esc($tipo['id_tipo']) ?>"><?= esc($tipo['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" id="responsable" name="responsable" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="Pendiente">Pendiente</option>
                <option value="En Progreso">En Progreso</option>
                <option value="Completada">Completada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_apertura" class="form-label">Fecha de Apertura</label>
            <input type="date" id="fecha_apertura" name="fecha_apertura" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
            <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control">
        </div>
        <div class="mb-3">
            <label for="avance" class="form-label">Avance (%)</label>
            <input type="number" id="avance" name="avance" class="form-control" step="0.01" min="0" max="100">
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea id="comentarios" name="comentarios" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="documentos_adjuntos" class="form-label">Documento Adjunto</label>
            <input type="file" id="documentos_adjuntos" name="documentos_adjuntos" class="form-control" accept=".pdf,.doc,.docx">
        </div>
        <div class="mb-3">
            <label for="enlaces_adjuntos" class="form-label">Enlace Adjunto</label>
            <input type="url" id="enlaces_adjuntos" name="enlaces_adjuntos" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="<?= base_url('actividades/list') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
