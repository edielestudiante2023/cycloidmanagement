<?php

namespace App\Controllers;

use App\Models\VideosFrontModel;

class VideosFrontController extends BaseController
{
    public function list()
    {
        $videosModel = new VideosFrontModel();
        $data['videos'] = $videosModel->findAll();
        return view('videos_front/list_videos_capacitaciones', $data);
    }

    public function add()
    {
        return view('videos_front/add_videos_capacitaciones');
    }

    public function addPost()
    {
        $videosModel = new VideosFrontModel();

        $data = [
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ];

        try {
            if ($videosModel->insert($data)) {
                return redirect()->to('/videos-capacitaciones-front')->with('success', 'Video agregado exitosamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', 'Error al agregar el video.');
    }

    public function edit($id)
    {
        $videosModel = new VideosFrontModel();
        $data['video'] = $videosModel->find($id);
        return view('videos_front/edit_videos_capacitaciones', $data);
    }

    public function editPost($id)
    {
        $videosModel = new VideosFrontModel();

        $data = [
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ];

        try {
            if ($videosModel->update($id, $data)) {
                return redirect()->to('/videos-capacitaciones-front')->with('success', 'Video actualizado exitosamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', 'Error al actualizar el video.');
    }

    public function delete($id)
    {
        $videosModel = new VideosFrontModel();

        try {
            if ($videosModel->delete($id)) {
                return redirect()->to('/videos-capacitaciones-front')->with('success', 'Video eliminado exitosamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', 'Error al eliminar el video.');
    }
}
