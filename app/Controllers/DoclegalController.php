<?php

namespace App\Controllers;

use App\Models\DoclegalModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class DoclegalController extends BaseController
{
    private $doclegalModel;

    public function __construct()
    {
        $this->doclegalModel = new DoclegalModel();
    }

    public function list_doclegales()
    {
        $data['doclegales'] = $this->doclegalModel->findAll();
        return view('doclegal/list_doclegales', $data);
    }

    public function add_doclegal()
    {
        return view('doclegal/add_doclegal');
    }

    public function add_doclegal_post()
    {
        $file = $this->request->getFile('documento');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

            // Cambiar la ruta a una carpeta personalizada (ejemplo: 'doclegal')
            $file->move(ROOTPATH . 'doclegal', $newName);

            $data = [
                'tipo_documento' => $this->request->getPost('tipo_documento'),
                'documento' => $newName,
                'observaciones' => $this->request->getPost('observaciones')
            ];

            $this->doclegalModel->save($data);

            return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal agregado exitosamente.');
        }

        return redirect()->back()->with('error', 'Error al subir el documento.');
    }

    public function edit_doclegal($id)
    {
        $data['doclegal'] = $this->doclegalModel->find($id);
        return view('doclegal/edit_doclegal', $data);
    }

    public function edit_doclegal_post($id)
    {
        $file = $this->request->getFile('documento');
        $doclegal = $this->doclegalModel->find($id);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();

            // Cambiar la ruta a una carpeta personalizada
            $file->move(ROOTPATH . 'doclegal', $newName);

            // Elimina el archivo anterior si existe
            if ($doclegal['documento'] && file_exists(ROOTPATH . 'doclegal/' . $doclegal['documento'])) {
                unlink(ROOTPATH . 'doclegal/' . $doclegal['documento']);
            }

            $doclegal['documento'] = $newName;
        }

        $doclegal['tipo_documento'] = $this->request->getPost('tipo_documento');
        $doclegal['observaciones'] = $this->request->getPost('observaciones');

        $this->doclegalModel->save($doclegal);

        return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal actualizado exitosamente.');
    }

    public function delete_doclegal($id)
    {
        $doclegal = $this->doclegalModel->find($id);

        if ($doclegal) {
            // Elimina el archivo asociado si existe
            if ($doclegal['documento'] && file_exists(ROOTPATH . 'doclegal/' . $doclegal['documento'])) {
                unlink(ROOTPATH . 'doclegal/' . $doclegal['documento']);
            }

            $this->doclegalModel->delete($id);

            return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal eliminado exitosamente.');
        }

        return redirect()->to('/doclegal/list-doclegales')->with('error', 'Documento legal no encontrado.');
    }
}
