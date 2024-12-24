<?php

namespace App\Controllers;

use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        // Cargar la vista de login
        return view('login'); // Asegúrate de que el archivo `login.php` esté en `app/Views/`
    }

    public function authenticate()
    {
        // Captura los datos enviados por el formulario
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cargar el modelo de usuario
        $userModel = new UserModel();

        // Buscar usuario por email
        $user = $userModel->where('email', $email)->first();

        if ($user) {
            // Verificar la contraseña (asumiendo que está almacenada como hash)
            if (password_verify($password, $user['password'])) {
                // Iniciar sesión y almacenar información del usuario
                $session = session();
                $session->set([
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'profile_id' => $user['profile_id'],
                    'is_logged_in' => true,
                ]);

                // Redirigir según el perfil del usuario
                if ($user['profile_id'] == 1) {
                    return redirect()->to('/dashboard/admin');
                } elseif ($user['profile_id'] == 2) {
                    return redirect()->to('/dashboard/consultor');
                } elseif ($user['profile_id'] == 3) {
                    return redirect()->to('/dashboard/socio');
                } elseif ($user['profile_id'] == 4) {
                    return redirect()->to('/dashboard/calidad');
                } else {
                    return redirect()->to('login')->with('error', 'Perfil desconocido.');
                }
            } else {
                // Contraseña incorrecta
                return redirect()->to('login')->with('error', 'Contraseña incorrecta.');
            }
        } else {
            // Usuario no encontrado
            return redirect()->to('login')->with('error', 'Usuario no encontrado.');
        }
    }

    public function logout()
    {
        // Destruir la sesión
        session()->destroy();

        // Redirigir al formulario de login
        return redirect()->to('login');
    }
}
