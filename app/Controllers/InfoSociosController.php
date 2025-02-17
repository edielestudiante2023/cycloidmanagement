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
        try {
            $session = session();
            $data['info_socios'] = $this->infoSociosModel->findAll();
            
            if ($session->get('profile_id') == 2) { // Si es consultor
                return view('partners/list_info_socios_consultor', $data);
            } else {
                return view('partners/list_info_socios', $data);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar la lista de información: ' . $e->getMessage());
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

        try {
            $data = [
                'elemento' => $this->request->getPost('elemento'),
                'detalles' => $this->request->getPost('detalles'),
                'enlace' => $this->request->getPost('enlace'),
            ];

            // Validar datos requeridos
            if (empty($data['elemento']) || empty($data['detalles'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Los campos Elemento y Detalles son requeridos.');
            }

            if (!$this->infoSociosModel->insert($data)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error al guardar la información.');
            }

            return redirect()->to('/info-socios')->with('success', 'Información agregada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al procesar la información: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $session = session();
            if ($session->get('profile_id') == 2) { // Si es consultor
                return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
            }

            $data['info_socio'] = $this->infoSociosModel->find($id);
            if (!$data['info_socio']) {
                return redirect()->to('/info-socios')->with('error', 'Información no encontrada');
            }

            return view('partners/edit_info_socios', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar la información: ' . $e->getMessage());
        }
    }

    public function editPost($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }

        try {
            // Verificar que el registro existe
            $existingData = $this->infoSociosModel->find($id);
            if (!$existingData) {
                return redirect()->to('/info-socios')->with('error', 'Información no encontrada');
            }

            $data = [
                'elemento' => $this->request->getPost('elemento'),
                'detalles' => $this->request->getPost('detalles'),
                'enlace' => $this->request->getPost('enlace'),
            ];

            // Validar datos requeridos
            if (empty($data['elemento']) || empty($data['detalles'])) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Los campos Elemento y Detalles son requeridos.');
            }

            if (!$this->infoSociosModel->update($id, $data)) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Error al actualizar la información.');
            }

            return redirect()->to('/info-socios')->with('success', 'Información actualizada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar la información: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('info-socios'))->with('error', 'No tiene permisos para esta acción');
        }

        try {
            // Verificar que el registro existe
            $existingData = $this->infoSociosModel->find($id);
            if (!$existingData) {
                return redirect()->to('/info-socios')->with('error', 'Información no encontrada');
            }

            if (!$this->infoSociosModel->delete($id)) {
                throw new \Exception('Error al eliminar el registro');
            }

            return redirect()->to('/info-socios')->with('success', 'Información eliminada exitosamente');
        } catch (\Exception $e) {
            return redirect()->to('/info-socios')->with('error', 'Error al eliminar la información: ' . $e->getMessage());
        }
    }
}
