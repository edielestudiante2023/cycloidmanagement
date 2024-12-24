<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit User</h1>
        <form method="post" action="<?= base_url('users/edit/' . htmlspecialchars($user['id'])) ?>" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
                <div class="invalid-feedback">
                    Please provide a valid name.
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
                <div class="invalid-feedback">
                    Please provide a valid email address.
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password (leave blank to keep current)</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="profile_id" class="form-label">Profile</label>
                <select name="profile_id" id="profile_id" class="form-select" required>
                    <option value="">Select a profile</option>
                    <option value="1" <?= $user['profile_id'] == 1 ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= $user['profile_id'] == 2 ? 'selected' : '' ?>>Consultor</option>
                    <option value="3" <?= $user['profile_id'] == 3 ? 'selected' : '' ?>>Socio</option>
                    <option value="4" <?= $user['profile_id'] == 4 ? 'selected' : '' ?>>Calidad</option>
                </select>
                <div class="invalid-feedback">
                    Please select a profile.
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('users/list') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update</button>
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
            })
        })()
    </script>
</body>
</html>
