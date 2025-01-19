<?php

namespace App\Controllers;

use App\Models\VideosBackModel;

class VideosBackController extends BaseController
{
    public function list()
    {
        $videosModel = new VideosBackModel();
        $data['videos'] = $videosModel->findAll();
        return view('videos_back/list_videos_capacitaciones', $data);
    }

    public function add()
    {
        return view('videos_back/add_videos_capacitaciones');
    }

    public function addPost()
    {
        $videosModel = new VideosBackModel();

        $data = [
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ];

        try {
            if ($videosModel->insert($data)) {
                return redirect()->to('/videos-capacitaciones-back')->with('success', 'Video agregado exitosamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', 'Error al agregar el video.');
    }

    public function edit($id)
    {
        $videosModel = new VideosBackModel();
        $data['video'] = $videosModel->find($id);
        return view('videos_back/edit_videos_capacitaciones', $data);
    }

    public function editPost($id)
    {
        $videosModel = new VideosBackModel();

        $data = [
            'elemento' => $this->request->getPost('elemento'),
            'detalles' => $this->request->getPost('detalles'),
            'enlace' => $this->request->getPost('enlace'),
        ];

        try {
            if ($videosModel->update($id, $data)) {
                return redirect()->to('/videos-capacitaciones-back')->with('success', 'Video actualizado exitosamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', 'Error al actualizar el video.');
    }

    public function delete($id)
    {
        $videosModel = new VideosBackModel();

        try {
            if ($videosModel->delete($id)) {
                return redirect()->to('/videos-capacitaciones-back')->with('success', 'Video eliminado exitosamente.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('error', 'Error al eliminar el video.');
    }
}
