<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        
        // Si no hay sesión activa, redirigir al login
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Por favor inicie sesión para continuar.');
        }

        // Verificar tiempo de inactividad (30 minutos)
        if ($session->get('last_activity') && (time() - $session->get('last_activity') > 1800)) {
            $session->destroy();
            return redirect()->to('/login')->with('error', 'Su sesión ha expirado. Por favor inicie sesión nuevamente.');
        }

        // Actualizar tiempo de última actividad
        $session->set('last_activity', time());
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No necesitamos hacer nada después de la solicitud
    }
}
