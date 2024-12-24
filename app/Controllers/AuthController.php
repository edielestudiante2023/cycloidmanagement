<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('login'); // Carga la vista del formulario de login
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            // Verificar contraseña
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'user_email' => $user['email'],
                    'user_role' => $user['role'],
                    'isLoggedIn' => true
                ]);
                return redirect()->to('/dashboard'); // Cambia '/dashboard' según tu ruta de inicio
            } else {
                $session->setFlashdata('error', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'El usuario no existe.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
