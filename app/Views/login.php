<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Modern color scheme */
        body {
            background-color: #f8f9fa;
        }

        h3 {
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

<body class="bg-light">
    <!-- Navbar con espacio para logos -->
    <nav class="navbar navbar-light bg-white shadow-sm mb-4">
        <div class="container">
            <div class="row w-100 text-center">
                <div class="col-4">
                    <!-- Espacio para logo 1 -->
                    <img src="<?= base_url('/imagenes/logocycloidsinfondo.png') ?>" alt="Logo 1" class="img-fluid" style="max-height: 200px;">
                </div>
                <div class="col-4">
                    <!-- Espacio para logo 2 -->
                    <img src="<?= base_url('/imagenes/psicloidmethod.png') ?>" alt="Logo 2" class="img-fluid" style="max-height: 200px;">
                </div>
                <div class="col-4">
                    <!-- Espacio para logo 3 -->
                    <img src="<?= base_url('/imagenes/psiclodmind2.png') ?>" alt="Logo 3" class="img-fluid" style="max-height: 200px;">
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor del formulario -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center mb-4">Cycloid Mind - Management Center</h3>

                        <!-- Mensaje de error -->
                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <!-- Formulario -->
                        <form action="/cycloidmanagement/public/login" method="post">
                            <!-- Protección CSRF -->
                            <?= csrf_field() ?>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Tu correo electrónico" required>
                            </div>

                            <!-- Contraseña -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Tu contraseña" required>
                            </div>

                            <!-- Perfil -->
                            <div class="mb-3">
                                <label for="profile" class="form-label">Perfil</label>
                                <select name="profile" id="profile" class="form-select" required>
                                    <option value="Admin">Admin</option>
                                    <option value="Consultor">Consultor</option>
                                    <option value="Socio">Socio</option>
                                </select>
                            </div>

                            <!-- Botón de enviar -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-moderno btn-lg">Iniciar Sesión</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="light text-white py-4">
        <div class="container text-center">
            <div class="row justify-content-center align-items-center">
                <div class="col-4 text-center">
                    <!-- Espacio para Logo 1 -->
                    <img src="<?= base_url('/imagenes/2.png') ?>" alt="Logo 1" class="img-fluid" style="max-height: 250px;">
                </div>
                <div class="col-4 text-center">
                    <!-- Espacio para Logo 2 -->
                    <img src="<?= base_url('/imagenes/3.png') ?>" alt="Logo 2" class="img-fluid" style="max-height: 250px;">
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
