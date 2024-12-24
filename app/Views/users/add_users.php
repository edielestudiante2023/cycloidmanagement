<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add User</h1>

        <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>


        <form method="post" action="<?= base_url('users/add') ?>" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
                <div class="invalid-feedback">
                    Please provide a valid name.
                </div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
                <div class="invalid-feedback">
                    Please provide a valid email address.
                </div>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
                <div class="invalid-feedback">
                    Please provide a password.
                </div>
            </div>

            <div class="mb-3">
                <label for="profile_id" class="form-label">Profile</label>
                <select name="profile_id" id="profile_id" class="form-select" required>
                    <option value="">Select a profile</option>
                    <option value="1">Admin</option>
                    <option value="2">Consultor</option>
                    <option value="3">Socio</option>
                    <option value="4">Calidad</option>
                </select>
                <div class="invalid-feedback">
                    Please select a profile.
                </div>
            </div>


            <div class="d-flex justify-content-between">
                <a href="<?= base_url('users/list') ?>" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Form validation -->
    <script>
        (function() {
            'use strict'

            const forms = document.querySelectorAll('.needs-validation')

            Array.from(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
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