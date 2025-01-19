<?php

namespace App\Controllers;

use App\Models\TipoModel;
use CodeIgniter\Controller;

class TipoController extends Controller
{
    public function listTipoactividad()
    {
        $tipoModel = new TipoModel();
        $data['tipos'] = $tipoModel->findAll();
        return view('pendientes/list', $data);
    }

    public function addTipoactividad()
    {
        return view('pendientes/add');
    }

    public function addPostTipoactividad()
    {
        $tipoModel = new TipoModel();
        $tipoModel->save([
            'titulo' => $this->request->getPost('titulo'),
        ]);
        return redirect()->to('/pendientes')->with('success', 'Tipo de actividad creado correctamente.');
    }

    public function editTipoactividad($id)
    {
        $tipoModel = new TipoModel();
        $data['tipo'] = $tipoModel->find($id);
        return view('pendientes/edit', $data);
    }

    public function editPostTipoactividad($id)
    {
        $tipoModel = new TipoModel();
        $tipoModel->update($id, [
            'titulo' => $this->request->getPost('titulo'),
        ]);
        return redirect()->to('/pendientes')->with('success', 'Tipo de actividad actualizado correctamente.');
    }

    public function deleteTipoactividad($id)
    {
        $tipoModel = new TipoModel();
        $tipoModel->delete($id);
        return redirect()->to('/pendientes')->with('success', 'Tipo de actividad eliminado correctamente.');
    }
}
