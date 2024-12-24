<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Información de Socio</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Agregar Información de Socio</h1>
        <form action="<?= base_url('info-socios/add-post') ?>" method="post" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="elemento" class="form-label">Elemento:</label>
                <input type="text" name="elemento" id="elemento" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor, ingresa un elemento válido.
                </div>
            </div>

            <div class="mb-3">
                <label for="detalles" class="form-label">Detalles:</label>
                <textarea name="detalles" id="detalles" class="form-control" rows="4" required></textarea>
                <div class="invalid-feedback">
                    Por favor, ingresa detalles válidos.
                </div>
            </div>

            <div class="mb-3">
                <label for="enlace" class="form-label">Enlace:</label>
                <input type="url" name="enlace" id="enlace" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor, ingresa un enlace válido.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('info-socios') ?>" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Form validation -->
    <script>
        (function () {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })()
        })()
    </script>
</body>
</html>