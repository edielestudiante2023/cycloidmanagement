<?php
namespace App\Controllers;

use App\Models\PlanillasModel;
use CodeIgniter\HTTP\Files\UploadedFile;

class PlanillasController extends BaseController
{
    private $planillasModel;

    public function __construct()
    {
        $this->planillasModel = new PlanillasModel();
    }

    public function list_planillas()
    {
        $data['planillas'] = $this->planillasModel->findAll();
        return view('planillas/list_planillas', $data);
    }

    public function add_planilla()
    {
        return view('planillas/add_planillas');
    }

    public function add_planilla_post()
    {
        $file = $this->request->getFile('documento');
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'planillas', $newName);

            $data = [
                'year' => $this->request->getPost('year'),
                'month' => $this->request->getPost('month'),
                'planilla' => $this->request->getPost('planilla'),
                'documento' => $newName,
                'observaciones' => $this->request->getPost('observaciones'),
            ];

            $this->planillasModel->save($data);

            return redirect()->to('/planillas/list-planillas')->with('success', 'Planilla agregada exitosamente.');
        }

        return redirect()->back()->with('error', 'Error al subir el documento.');
    }

    public function edit_planilla($id)
    {
        $data['planilla'] = $this->planillasModel->find($id);
        return view('planillas/edit_planillas', $data);
    }

    public function edit_planilla_post($id)
    {
        $file = $this->request->getFile('documento');
        $planilla = $this->planillasModel->find($id);

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'planillas', $newName);
            if ($planilla['documento']) {
                unlink(FCPATH . 'planillas/' . $planilla['documento']);
            }
            $planilla['documento'] = $newName;
        }

        $planilla['year'] = $this->request->getPost('year');
        $planilla['month'] = $this->request->getPost('month');
        $planilla['planilla'] = $this->request->getPost('planilla');
        $planilla['observaciones'] = $this->request->getPost('observaciones');

        $this->planillasModel->save($planilla);

        return redirect()->to('/planillas/list-planillas')->with('success', 'Planilla actualizada exitosamente.');
    }

    public function delete_planilla($id)
    {
        $planilla = $this->planillasModel->find($id);
        if ($planilla && $planilla['documento']) {
            unlink(FCPATH . 'planillas/' . $planilla['documento']);
        }

        $this->planillasModel->delete($id);

        return redirect()->to('/planillas/list-planillas')->with('success', 'Planilla eliminada exitosamente.');
    }
}
