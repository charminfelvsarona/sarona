<?php
namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        return view('auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            $pass = $user['password'];
            if (password_verify($password, $pass)) {
                $sessionData = [
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'email'     => $user['email'],
                    'role'      => $user['role'],
                    'logged_in' => true,
                ];
                $session->set($sessionData);
                return redirect()->to('/employees');
            } else {
                return redirect()->back()->with('error', 'Incorrect password');
            }
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }

    public function register()
    {
        helper(['form']);
        return view('auth/register');
    }

    public function registerPost()
    {
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'admin'
        ];

        $userModel->save($data);
        return redirect()->to('/login')->with('success', 'Registration successful! Please login.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
