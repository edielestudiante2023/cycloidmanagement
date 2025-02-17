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

    public function add_doclegal()
    {
        $session = session();
        return view('doclegal/add_doclegal');
    }

    public function add_doclegal_post()
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
                
                // Intentar mover el archivo
                if (!$file->move(FCPATH . 'uploads/doclegal', $newName)) {
                    throw new \Exception('Error al mover el archivo.');
                }

                $data = [
                    'tipo_documento' => $this->request->getPost('tipo_documento'),
                    'documento' => $newName,
                    'observaciones' => $this->request->getPost('observaciones')
                ];

                // Intentar guardar en la base de datos
                if (!$this->doclegalModel->save($data)) {
                    // Si falla el guardado, eliminar el archivo
                    if (file_exists(FCPATH . 'uploads/doclegal/' . $newName)) {
                        unlink(FCPATH . 'uploads/doclegal/' . $newName);
                    }
                    throw new \Exception('Error al guardar los datos del documento.');
                }

                return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal agregado exitosamente.');
            } catch (\Exception $e) {
                // Asegurarse de limpiar archivos temporales si existen
                if (isset($newName) && file_exists(FCPATH . 'uploads/doclegal/' . $newName)) {
                    unlink(FCPATH . 'uploads/doclegal/' . $newName);
                }
                return redirect()->back()->with('error', 'Error al procesar el documento: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Error al subir el documento.');
    }

    public function edit_doclegal($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('doclegal/list-doclegales'))->with('error', 'No tiene permisos para esta acción');
        }

        $data['doclegal'] = $this->doclegalModel->find($id);
        if (!$data['doclegal']) {
            return redirect()->back()->with('error', 'Documento no encontrado.');
        }
        
        return view('doclegal/edit_doclegal', $data);
    }

    public function edit_doclegal_post($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('doclegal/list-doclegales'))->with('error', 'No tiene permisos para esta acción');
        }

        try {
            $doclegal = $this->doclegalModel->find($id);
            if (!$doclegal) {
                return redirect()->back()->with('error', 'Documento no encontrado.');
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
                if ($doclegal['documento']) {
                    $oldFile = FCPATH . 'uploads/doclegal/' . $doclegal['documento'];
                }

                // Mover el nuevo archivo
                if (!$file->move(FCPATH . 'uploads/doclegal', $newName)) {
                    throw new \Exception('Error al mover el nuevo archivo.');
                }
            }

            // Actualizar datos
            $doclegal['tipo_documento'] = $this->request->getPost('tipo_documento');
            $doclegal['observaciones'] = $this->request->getPost('observaciones');
            
            if ($newName) {
                $doclegal['documento'] = $newName;
            }

            // Intentar guardar en la base de datos
            if (!$this->doclegalModel->save($doclegal)) {
                // Si falla el guardado y habíamos subido un nuevo archivo, eliminarlo
                if ($newName && file_exists(FCPATH . 'uploads/doclegal/' . $newName)) {
                    unlink(FCPATH . 'uploads/doclegal/' . $newName);
                }
                throw new \Exception('Error al guardar los datos en la base de datos.');
            }

            // Solo después de confirmar que todo está bien, eliminar el archivo antiguo
            if ($oldFile && file_exists($oldFile)) {
                unlink($oldFile);
            }

            return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal actualizado exitosamente.');
        } catch (\Exception $e) {
            // Asegurarse de limpiar cualquier archivo nuevo si ocurre un error
            if ($newName && file_exists(FCPATH . 'uploads/doclegal/' . $newName)) {
                unlink(FCPATH . 'uploads/doclegal/' . $newName);
            }
            return redirect()->back()->with('error', 'Error al actualizar el documento: ' . $e->getMessage());
        }
    }

    public function delete_doclegal($id)
    {
        $session = session();
        if ($session->get('profile_id') == 2) { // Si es consultor
            return redirect()->to(base_url('doclegal/list-doclegales'))->with('error', 'No tiene permisos para esta acción');
        }

        try {
            $doclegal = $this->doclegalModel->find($id);
            if (!$doclegal) {
                return redirect()->back()->with('error', 'Documento no encontrado.');
            }

            // Primero intentar eliminar de la base de datos
            if (!$this->doclegalModel->delete($id)) {
                throw new \Exception('Error al eliminar el registro de la base de datos.');
            }

            // Solo después de confirmar la eliminación en la base de datos, eliminar el archivo
            if ($doclegal['documento'] && file_exists(FCPATH . 'uploads/doclegal/' . $doclegal['documento'])) {
                if (!unlink(FCPATH . 'uploads/doclegal/' . $doclegal['documento'])) {
                    // Loguear este error pero no revertir la operación
                    log_message('error', 'No se pudo eliminar el archivo: ' . $doclegal['documento']);
                }
            }

            return redirect()->to('/doclegal/list-doclegales')->with('success', 'Documento legal eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el documento: ' . $e->getMessage());
        }
    }
}
