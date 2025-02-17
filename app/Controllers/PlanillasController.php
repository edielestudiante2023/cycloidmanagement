
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
        $session = session();
        $data['planillas'] = $this->planillasModel->findAll();
        
        if ($session->get('profile_id') == 2) { // Si es consultor
            return view('planillas/list_planillas_consultor', $data);
        } else {
            return view('planillas/list_planillas', $data);
        }
    }

    public function add_planilla()
    {
        $session = session();
        return view('planillas/add_planillas');
    }

    public function add_planilla_post()
    {
        $file = $this->request->getFile('documento');
        
        // Validar tipo de archivo
        $validTypes = ['application/pdf'];
        if (!in_array($file->getMimeType(), $validTypes)) {
            return redirect()->back()->with('error', 'Solo se permiten archivos PDF.');
        }

        if ($file->isValid() && !$file->hasMoved()) {
            try {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'planillas', $newName);

                $data = [
                    'year' => $this->request->getPost('year'),
                    'month' => $this->request->getPost('month'),
                    'planilla' => $this->request->getPost('planilla'),
                    'documento' => $newName,
                    'observaciones' => $this->request->getPost('observaciones'),
                ];

                if (!$this->planillasModel->save($data)) {
                    // Si falla el guardado en la base de datos, eliminar el archivo
                    unlink(FCPATH . 'planillas/' . $newName);
                    return redirect()->back()->with('error', 'Error al guardar los datos de la planilla.');
                }

                return redirect()->to('/planillas/list-planillas')->with('success', 'Planilla agregada exitosamente.');
            } catch (\Exception $e) {
                // Si ocurre cualquier error, asegurarse de limpiar archivos temporales
                if (file_exists(FCPATH . 'planillas/' . $newName)) {
                    unlink(FCPATH . 'planillas/' . $newName);
                }
                return redirect()->back()->with('error', 'Error al procesar la planilla: ' . $e->getMessage());
            }
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
        try {
            $planilla = $this->planillasModel->find($id);
            if (!$planilla) {
                return redirect()->back()->with('error', 'Planilla no encontrada.');
            }

            $file = $this->request->getFile('documento');
            $oldFile = null;
            $newName = null;

            if ($file && $file->isValid() && !$file->hasMoved()) {
                // Validar tipo de archivo
                $validTypes = ['application/pdf'];
                if (!in_array($file->getMimeType(), $validTypes)) {
                    return redirect()->back()->with('error', 'Solo se permiten archivos PDF.');
                }

                $newName = $file->getRandomName();
                
                // Guardar referencia al archivo antiguo
                if ($planilla['documento']) {
                    $oldFile = FCPATH . 'planillas/' . $planilla['documento'];
                }

                // Mover el nuevo archivo
                if (!$file->move(FCPATH . 'planillas', $newName)) {
                    throw new \Exception('Error al mover el nuevo archivo.');
                }
            }

            // Actualizar datos
            $planilla['year'] = $this->request->getPost('year');
            $planilla['month'] = $this->request->getPost('month');
            $planilla['planilla'] = $this->request->getPost('planilla');
            $planilla['observaciones'] = $this->request->getPost('observaciones');
            
            if ($newName) {
                $planilla['documento'] = $newName;
            }

            // Intentar guardar en la base de datos
            if (!$this->planillasModel->save($planilla)) {
                // Si falla el guardado y habíamos subido un nuevo archivo, eliminarlo
                if ($newName && file_exists(FCPATH . 'planillas/' . $newName)) {
                    unlink(FCPATH . 'planillas/' . $newName);
                }
                throw new \Exception('Error al guardar los datos en la base de datos.');
            }

            // Solo después de confirmar que todo está bien, eliminar el archivo antiguo
            if ($oldFile && file_exists($oldFile)) {
                unlink($oldFile);
            }

            return redirect()->to('/planillas/list-planillas')->with('success', 'Planilla actualizada exitosamente.');
        } catch (\Exception $e) {
            // Asegurarse de limpiar cualquier archivo nuevo si ocurre un error
            if ($newName && file_exists(FCPATH . 'planillas/' . $newName)) {
                unlink(FCPATH . 'planillas/' . $newName);
            }
            return redirect()->back()->with('error', 'Error al actualizar la planilla: ' . $e->getMessage());
        }
    }

    public function delete_planilla($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('planillas/list-planillas'))->with('error', 'No tiene permisos para esta acción');
        }

        try {
            $planilla = $this->planillasModel->find($id);
            if (!$planilla) {
                return redirect()->back()->with('error', 'Planilla no encontrada.');
            }

            // Primero intentar eliminar de la base de datos
            if (!$this->planillasModel->delete($id)) {
                throw new \Exception('Error al eliminar el registro de la base de datos.');
            }

            // Solo después de confirmar la eliminación en la base de datos, eliminar el archivo
            if ($planilla['documento'] && file_exists(FCPATH . 'planillas/' . $planilla['documento'])) {
                if (!unlink(FCPATH . 'planillas/' . $planilla['documento'])) {
                    // Loguear este error pero no revertir la operación
                    log_message('error', 'No se pudo eliminar el archivo: ' . $planilla['documento']);
                }
            }

            return redirect()->to('/planillas/list-planillas')->with('success', 'Planilla eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar la planilla: ' . $e->getMessage());
        }
    }
}
