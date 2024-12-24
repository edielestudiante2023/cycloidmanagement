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
        $data['info_socios'] = $this->infoSociosModel->findAll();
        return view('partners/list_info_socios', $data);
    }

    public function add()
    {
        return view('partners/add_info_socios');
    }

    public function addPost()
    {
        $this->infoSociosModel->insert([
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ]);

        return redirect()->to('/info-socios');
    }

    public function edit($id)
    {
        $data['info_socio'] = $this->infoSociosModel->find($id);
        return view('partners/edit_info_socios', $data);
    }

    public function editPost($id)
    {
        $this->infoSociosModel->update($id, [
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ]);

        return redirect()->to('/info-socios');
    }

    public function delete($id)
    {
        $this->infoSociosModel->delete($id);
        return redirect()->to('/info-socios');
    }
}
