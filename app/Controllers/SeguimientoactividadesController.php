<?php

namespace App\Controllers;

use App\Models\ActividadModel;
use App\Models\TipoModel;
use CodeIgniter\Controller;

class SeguimientoactividadesController extends Controller
{
    public function updateField()
    {
        $session = session();
        
        // Verificar si la solicitud es AJAX
        if (!$this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'msg' => 'Invalid request']);
        }

        // Obtener los datos enviados
        $pk = $this->request->getPost('pk');  // id_actividad
        $name = $this->request->getPost('name');  // nombre del campo
        $value = $this->request->getPost('value');  // nuevo valor

        // Validar los campos
        $validation = \Config\Services::validation();
        
        $rules = [
            'estado' => 'in_list[abierto,gestionando,cerrado]',
            'fecha_apertura' => 'valid_date',
            'fecha_vencimiento' => 'valid_date',
            'avance' => 'integer|greater_than_equal_to[0]|less_than_equal_to[100]'
        ];

        // Solo validar si existe una regla para el campo
        if (isset($rules[$name])) {
            if (!$validation->check($value, $rules[$name])) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'msg' => $validation->getError($name)
                ]);
            }
        }

        try {
            $actividadModel = new ActividadModel();
            $actividad = $actividadModel->find($pk);

            if (!$actividad) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'msg' => 'Actividad no encontrada'
                ]);
            }

            // Actualizar el campo
            $actividad[$name] = $value;
            $actividadModel->save($actividad);

            return $this->response->setJSON([
                'status' => 'success',
                'msg' => 'Campo actualizado correctamente'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'msg' => 'Error al actualizar el campo: ' . $e->getMessage()
            ]);
        }
    }

    public function listseguimientoactividades()
    {
        $actividadModel = new ActividadModel();
        $tipoModel = new TipoModel();
        $session = session();

        $actividades = $actividadModel->findAll();
        $tipos = $tipoModel->findAll();

        // Crear un mapa de tipos para acceso rápido
        $mapaTipos = [];
        foreach ($tipos as $tipo) {
            $mapaTipos[$tipo['id_tipo']] = $tipo['titulo'];
        }

        // Mapear el título del tipo en las actividades
        foreach ($actividades as &$actividad) {
            $actividad['tipo_titulo'] = $mapaTipos[$actividad['id_tipo']] ?? 'Sin Tipo';
        }

        $data['actividades'] = $actividades;

        // Verificar el rol del usuario y cargar la vista correspondiente
        if ($session->get('profile_id') == 2) { // Asumiendo que 2 es el ID del perfil consultor
            return view('actividades/listseguimientoactividades_consultor', $data);
        } else {
            return view('actividades/listseguimientoactividades', $data);
        }
    }


    public function addseguimientoactividades()
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('actividades/list'))->with('error', 'No tiene permisos para esta acción');
        }

        $tipoModel = new TipoModel();
        $data['tipos'] = $tipoModel->findAll();

        return view('actividades/addseguimientoactividades', $data);
    }

    public function addpostseguimientoactividades()
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('actividades/list'))->with('error', 'No tiene permisos para esta acción');
        }

        $actividadModel = new ActividadModel();
        $file = $this->request->getFile('documentos_adjuntos');

        $documentPath = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $documentPath = $file->getRandomName();
            $file->move(FCPATH . 'uploads/actividades', $documentPath);
        }

        $data = [
            'nombre_actividad' => $this->request->getPost('nombre_actividad'),
            'id_tipo' => $this->request->getPost('id_tipo'),
            'responsable' => $this->request->getPost('responsable'),
            'estado' => $this->request->getPost('estado'),
            'fecha_apertura' => $this->request->getPost('fecha_apertura'),
            'fecha_vencimiento' => $this->request->getPost('fecha_vencimiento'),
            'avance' => $this->request->getPost('avance'),
            'comentarios' => $this->request->getPost('comentarios'),
            'documentos_adjuntos' => $documentPath,
            'enlaces_adjuntos' => $this->request->getPost('enlaces_adjuntos'),
        ];

        $actividadModel->save($data);

        return redirect()->to(base_url('actividades/list'))->with('success', 'Actividad creada correctamente.');
    }

    public function editseguimientoactividades($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('actividades/list'))->with('error', 'No tiene permisos para esta acción');
        }

        $actividadModel = new ActividadModel();
        $tipoModel = new TipoModel();

        $data['actividad'] = $actividadModel->find($id);
        $data['tipos'] = $tipoModel->findAll();

        return view('actividades/editseguimientoactividades', $data);
    }

    public function editpostseguimientoactividades($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('actividades/list'))->with('error', 'No tiene permisos para esta acción');
        }

        $actividadModel = new ActividadModel();
        $actividad = $actividadModel->find($id);
        $file = $this->request->getFile('documentos_adjuntos');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/actividades', $newName);

            if (!empty($actividad['documentos_adjuntos'])) {
                unlink(FCPATH . 'uploads/actividades/' . $actividad['documentos_adjuntos']);
            }

            $actividad['documentos_adjuntos'] = $newName;
        }

        $actividad['nombre_actividad'] = $this->request->getPost('nombre_actividad');
        $actividad['id_tipo'] = $this->request->getPost('id_tipo');
        $actividad['responsable'] = $this->request->getPost('responsable');
        $actividad['estado'] = $this->request->getPost('estado');
        $actividad['fecha_apertura'] = $this->request->getPost('fecha_apertura');
        $actividad['fecha_vencimiento'] = $this->request->getPost('fecha_vencimiento');
        $actividad['avance'] = $this->request->getPost('avance');
        $actividad['comentarios'] = $this->request->getPost('comentarios');
        $actividad['enlaces_adjuntos'] = $this->request->getPost('enlaces_adjuntos');

        $actividadModel->save($actividad);

        return redirect()->to(base_url('actividades/list'))->with('success', 'Actividad actualizada correctamente.');
    }

    public function deleteseguimientoactividades($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('actividades/list'))->with('error', 'No tiene permisos para esta acción');
        }

        $actividadModel = new ActividadModel();
        $actividad = $actividadModel->find($id);

        if ($actividad && !empty($actividad['documentos_adjuntos'])) {
            unlink(FCPATH . 'uploads/actividades/' . $actividad['documentos_adjuntos']);
        }

        $actividadModel->delete($id);

        return redirect()->to(base_url('actividades/list'))->with('success', 'Actividad eliminada correctamente.');
    }
}
