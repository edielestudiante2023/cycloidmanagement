<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\Cors;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\PerformanceMetrics;
use CodeIgniter\Filters\SecureHeaders;
use App\Filters\AuthFilter;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'cors'          => Cors::class,
        'forcehttps'    => ForceHTTPS::class,
        'pagecache'     => PageCache::class,
        'performance'   => PerformanceMetrics::class,
        'auth'          => AuthFilter::class,
    ];

    public array $required = [
        'before' => [
            'forcehttps',
            'pagecache',
        ],
        'after' => [
            'pagecache',
            'performance',
            'toolbar',
        ],
    ];

    public array $globals = [
        'before' => [
            'csrf',
            'invalidchars',
            'secureheaders',
        ],
        'after' => [
            'secureheaders',
        ],
    ];

    public array $methods = [
        'post' => ['csrf'],
    ];

    public array $filters = [
        'auth' => [
            'before' => [
                'dashboard/*',
                'profiles/*',
                'users/*',
                'info-socios/*',
                'planillas/*',
                'videos-capacitaciones*',
                'pendientes/*',
                'actividades/*',
                'doclegal/*',
                // Excluir rutas públicas
                'login' => ['except' => ['login', 'login/*']],
            ]
        ]
    ];
}
