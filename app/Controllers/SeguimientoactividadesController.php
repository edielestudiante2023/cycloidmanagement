<?php

namespace App\Controllers;

use App\Models\ActividadModel;
use App\Models\TipoModel;
use CodeIgniter\Controller;

class SeguimientoactividadesController extends Controller
{
    public function listseguimientoactividades()
    {
        $actividadModel = new ActividadModel();
        $tipoModel = new TipoModel();

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
        return view('actividades/listseguimientoactividades', $data);
    }


    public function addseguimientoactividades()
    {
        $tipoModel = new TipoModel();
        $data['tipos'] = $tipoModel->findAll();

        return view('actividades/addseguimientoactividades', $data);
    }

    public function addpostseguimientoactividades()
    {
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
        $actividadModel = new ActividadModel();
        $tipoModel = new TipoModel();

        $data['actividad'] = $actividadModel->find($id);
        $data['tipos'] = $tipoModel->findAll();

        return view('actividades/editseguimientoactividades', $data);
    }

    public function editpostseguimientoactividades($id)
    {
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
        $actividadModel = new ActividadModel();
        $actividad = $actividadModel->find($id);

        if ($actividad && !empty($actividad['documentos_adjuntos'])) {
            unlink(FCPATH . 'uploads/actividades/' . $actividad['documentos_adjuntos']);
        }

        $actividadModel->delete($id);

        return redirect()->to(base_url('actividades/list'))->with('success', 'Actividad eliminada correctamente.');
    }
}
