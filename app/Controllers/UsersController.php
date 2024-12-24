<?php
namespace App\Controllers;
use App\Models\UserModel;

class UsersController extends BaseController
{
    public function list()
    {
        $userModel = new UserModel();
        $data['users'] = $userModel->findAll();
        return view('users/list_users', $data);
    }

    public function add()
    {
        return view('users/add_users');
    }

    public function addPost()
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'profile_id' => $this->request->getPost('profile_id'),
        ];

        try {
            if ($userModel->insert($data)) {
                return redirect()->to('/users/list')->with('success', 'User added successfully.');
            }
        } catch (\Exception $e) {
            // Captura el mensaje de error y redirige con el mensaje.
            return redirect()->back()->with('error', $e->getMessage());
        }
    
        // En caso de que no entre al bloque try (fallo sin excepción explícita)
        return redirect()->back()->with('error', 'Failed to add user.');

        /* if ($userModel->insert($data)) {
            return redirect()->to('/users/list')->with('success', 'User added successfully.');
        }
        return redirect()->back()->with('error', 'Failed to add user.'); */
    }

    public function edit($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);
        return view('users/edit_users', $data);
    }

    public function editPost($id)
    {
        $userModel = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'profile_id' => $this->request->getPost('profile_id'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        try {
            if ($userModel->update($id, $data)) {
                return redirect()->to('/users/list')->with('success', 'User updated successfully.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    
        return redirect()->back()->with('error', 'Failed to update user.');
        /* if ($userModel->update($id, $data)) {
            return redirect()->to('/users/list')->with('success', 'User updated successfully.');
        }
        return redirect()->back()->with('error', 'Failed to update user.'); */
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        if ($userModel->delete($id)) {
            return redirect()->to('/users/list')->with('success', 'User deleted successfully.');
        }
        return redirect()->back()->with('error', 'Failed to delete user.');
    }
}