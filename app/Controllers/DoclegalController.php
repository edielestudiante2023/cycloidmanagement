<?php

namespace App\Controllers;

use App\Models\DoclegalModel;

class DoclegalController extends BaseController
{
    private $doclegalModel;

    public function __construct()
    {
        $this->doclegalModel = new DoclegalModel();
    }

    // Listar documentos legales
    public function list_doclegales()
    {
        $session = session();
        $data['doclegales'] = $this->doclegalModel->findAll();
        
        if ($session->get('profile_id') == 2) { // Si es consultor
            return view('doclegal/list_doclegales_consultor', $data);
        } else {
            return view('doclegal/list_doclegales', $data);
        }
    }

    // Mostrar formulario para agregar documento legal
    public function add_doclegal()
    {
        $session = session();
        // Removed restriction for consultants
        return view('doclegal/add_doclegal');
    }

    // Procesar formulario para agregar documento legal
    public function add_doclegal_post()
    {
        $file = $this->request->getFile('documento');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/doclegal', $newName);

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

    // Mostrar formulario para editar documento legal
    public function edit_doclegal($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('doclegal/list-doclegales'))->with('error', 'No tiene permisos para esta acción');
        }

        $data['doclegal'] = $this->doclegalModel->find($id);
        return view('doclegal/edit_doclegal', $data);
    }

    // Procesar formulario para editar documento legal
    public function edit_doclegal_post($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('doclegal/list-doclegales'))->with('error', 'No tiene permisos para esta acción');
        }

        $file = $this->request->getFile('documento');
        $doclegal = $this->doclegalModel->find($id);

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/doclegal', $newName);

            // Eliminar el archivo anterior si existe
            if ($doclegal['documento'] && file_exists(FCPATH . 'uploads/doclegal/' . $doclegal['documento'])) {
                unlink(FCPATH . 'uploads/doclegal/' . $doclegal['documento']);
            }

            $doclegal['documento'] = $newName;
        }

        $doclegal['tipo_documento'] = $this->request->getPost('tipo_documento');
        $doclegal['observaciones'] = $this->request->getPost('observaciones');

        $this->doclegalModel->save($doclegal);

        return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal actualizado exitosamente.');
    }

    // Eliminar documento legal
    public function delete_doclegal($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('doclegal/list-doclegales'))->with('error', 'No tiene permisos para esta acción');
        }

        $doclegal = $this->doclegalModel->find($id);

        if ($doclegal) {
            // Eliminar el archivo asociado si existe
            if ($doclegal['documento'] && file_exists(FCPATH . 'uploads/doclegal/' . $doclegal['documento'])) {
                unlink(FCPATH . 'uploads/doclegal/' . $doclegal['documento']);
            }

            $this->doclegalModel->delete($id);

            return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal eliminado exitosamente.');
        }

        return redirect()->to('/doclegal/list-doclegales')->with('error', 'Documento legal no encontrado.');
    }
}
