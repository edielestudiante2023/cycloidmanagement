<?php
namespace App\Controllers;

use App\Models\ProfileModel;
use CodeIgniter\HTTP\RedirectResponse;

class ProfilesController extends BaseController
{
    public function list(): string
    {
        $profileModel = new ProfileModel();
        $data['profiles'] = $profileModel->findAll();
        return view('profiles/list_profiles', $data);
    }

    public function add(): string
    {
        return view('profiles/add_profiles');
    }

    public function addPost(): RedirectResponse
    {
        $profileModel = new ProfileModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($profileModel->insert($data)) {
            return redirect()->to('/profiles/list')->with('message', 'Perfil creado con éxito.');
        }

        return redirect()->back()->with('error', 'Error al crear el perfil.');
    }

    public function edit($id): string
    {
        $profileModel = new ProfileModel();
        $data['profile'] = $profileModel->find($id);

        if (!$data['profile']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Perfil no encontrado.');
        }

        return view('profiles/edit_profiles', $data);
    }

    public function editPost($id): RedirectResponse
    {
        $profileModel = new ProfileModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ];

        if ($profileModel->update($id, $data)) {
            return redirect()->to('/profiles/list')->with('message', 'Perfil actualizado con éxito.');
        }

        return redirect()->back()->with('error', 'Error al actualizar el perfil.');
    }

    public function delete($id): RedirectResponse
    {
        $profileModel = new ProfileModel();
        if ($profileModel->delete($id)) {
            return redirect()->to('/profiles/list')->with('message', 'Perfil eliminado con éxito.');
        }

        return redirect()->back()->with('error', 'Error al eliminar el perfil.');
    }
}