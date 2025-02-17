<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Session\Handlers\BaseHandler;
use CodeIgniter\Session\Handlers\FileHandler;

class Session extends BaseConfig
{
    public string $driver = FileHandler::class;

    public string $cookieName = 'ci_session';

    // Reducir a 30 minutos para mayor seguridad
    public int $expiration = 1800;

    public string $savePath = WRITEPATH . 'session';

    // Habilitar verificación de IP para mayor seguridad
    public bool $matchIP = true;

    // Reducir tiempo de regeneración de ID para mayor seguridad
    public int $timeToUpdate = 180;

    // Destruir datos antiguos al regenerar ID
    public bool $regenerateDestroy = true;

    public ?string $DBGroup = null;

    // Configuraciones de seguridad adicionales
    public array $cookieParams = [
        'lifetime' => 1800,
        'path'     => '/',
        'domain'   => '',
        'secure'   => true,     // Solo HTTPS
        'httponly' => true,     // Prevenir acceso JavaScript
        'samesite' => 'Strict'  // Protección CSRF
    ];

    public int $lockRetryInterval = 100_000;

    public int $lockMaxRetries = 300;
}
