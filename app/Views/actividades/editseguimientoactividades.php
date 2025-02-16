<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Modern color scheme */
        body {
            background-color: #f8f9fa;
            color: #343a40;
        }

        h1 {
            color: #007bff;
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
<div class="container mt-5">
    <h1 class="mb-4">Editar Actividad</h1>
    <form action="<?= base_url('actividades/editpost/' . esc($actividad['id_actividad'])) ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="mb-3">
            <label for="nombre_actividad" class="form-label">Nombre de la Actividad</label>
            <input type="text" id="nombre_actividad" name="nombre_actividad" class="form-control" value="<?= esc($actividad['nombre_actividad']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_tipo" class="form-label">Tipo de Actividad</label>
            <select id="id_tipo" name="id_tipo" class="form-select" required>
                <option value="" disabled>Seleccione un tipo</option>
                <?php foreach ($tipos as $tipo): ?>
                    <option value="<?= esc($tipo['id_tipo']) ?>" <?= $tipo['id_tipo'] == $actividad['id_tipo'] ? 'selected' : '' ?>>
                        <?= esc($tipo['titulo']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" id="responsable" name="responsable" class="form-control" value="<?= esc($actividad['responsable']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-select">
                <option value="Pendiente" <?= $actividad['estado'] == 'Pendiente' ? 'selected' : '' ?>>Pendiente</option>
                <option value="En Progreso" <?= $actividad['estado'] == 'En Progreso' ? 'selected' : '' ?>>En Progreso</option>
                <option value="Completada" <?= $actividad['estado'] == 'Completada' ? 'selected' : '' ?>>Completada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_apertura" class="form-label">Fecha de Apertura</label>
            <input type="date" id="fecha_apertura" name="fecha_apertura" class="form-control" value="<?= esc($actividad['fecha_apertura']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
            <input type="date" id="fecha_vencimiento" name="fecha_vencimiento" class="form-control" value="<?= esc($actividad['fecha_vencimiento']) ?>">
        </div>
        <div class="mb-3">
            <label for="avance" class="form-label">Avance (%)</label>
            <input type="number" id="avance" name="avance" class="form-control" step="0.01" min="0" max="100" value="<?= esc($actividad['avance']) ?>">
        </div>
        <div class="mb-3">
            <label for="comentarios" class="form-label">Comentarios</label>
            <textarea id="comentarios" name="comentarios" class="form-control" rows="3"><?= esc($actividad['comentarios']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="documentos_adjuntos" class="form-label">Documento Adjunto</label>
            <?php if (!empty($actividad['documentos_adjuntos'])): ?>
                <p>Documento Actual: <a href="<?= base_url('uploads/actividades/' . esc($actividad['documentos_adjuntos'])) ?>" target="_blank">Ver Documento</a></p>
            <?php endif; ?>
            <input type="file" id="documentos_adjuntos" name="documentos_adjuntos" class="form-control" accept=".pdf,.doc,.docx">
        </div>
        <div class="mb-3">
            <label for="enlaces_adjuntos" class="form-label">Enlace Adjunto</label>
            <input type="url" id="enlaces_adjuntos" name="enlaces_adjuntos" class="form-control" value="<?= esc($actividad['enlaces_adjuntos']) ?>">
        </div>
        <button type="submit" class="btn btn-success btn-moderno">Actualizar</button>
        <a href="<?= base_url('actividades/list') ?>" class="btn btn-secondary btn-moderno">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
