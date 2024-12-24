<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function admin()
    {
        // Cargar la vista del dashboard para Admin
        return view('dashboard_admin');
    }

    public function consultor()
    {
        // Cargar la vista del dashboard para Consultor
        return view('dashboard_consultor');
    }

    public function socio()
    {
        // Cargar la vista del dashboard para Socio
        return view('dashboard_socio');
    }
}
