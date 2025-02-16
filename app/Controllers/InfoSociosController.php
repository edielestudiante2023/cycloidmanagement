<?php

namespace App\Controllers;

use App\Models\InfoSociosModel;

class InfoSociosController extends BaseController
{
    protected $infoSociosModel;

    public function __construct()
    {
        $this->infoSociosModel = new InfoSociosModel();
    }

    public function list()
    {
        $session = session();
        $data['info_socios'] = $this->infoSociosModel->findAll();
        
        if ($session->get('profile_id') == 2) { // Si es consultor
            return view('partners/list_info_socios_consultor', $data);
        } else {
            return view('partners/list_info_socios', $data);
        }
    }

    public function add()
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }
        return view('partners/add_info_socios');
    }

    public function addPost()
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }

        $this->infoSociosModel->insert([
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ]);

        return redirect()->to('/info-socios')->with('success', 'Información agregada exitosamente');
    }

    public function edit($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }
        $data['info_socio'] = $this->infoSociosModel->find($id);
        return view('partners/edit_info_socios', $data);
    }

    public function editPost($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }

        $this->infoSociosModel->update($id, [
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ]);

        return redirect()->to('/info-socios')->with('success', 'Información actualizada exitosamente');
    }

    public function delete($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }
        $this->infoSociosModel->delete($id);
        return redirect()->to('/info-socios');
    }
}
