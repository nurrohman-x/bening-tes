<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Chat;
use App\Models\Conversation;
use App\Models\User;

class UserController extends BaseController
{
    protected $modelUser, $modelConver, $modelChat, $user;

    public function __construct()
    {
        $this->user = session('user');
        $this->modelUser = new User();
        $this->modelChat = new Chat();
        $this->modelConver = new Conversation();
    }
    public function index()
    {
        if (empty(session('user'))) {
            return redirect()->to('/');
        }

        return view('user-index', [
            'data' => $this->modelUser->findAll()
        ]);
    }

    public function create()
    {
        return view('user-create');
    }

    public function store()
    {
        $password = $this->request->getPost('password');

        $data = $this->modelUser->insert([
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        if ($data) {
            return redirect()->to('/user-index');
        } else {
            echo 'register error';
        }
    }

    public function edit($id)
    {
        if (empty(session('user'))) {
            return redirect()->to('/');
        }

        return view('user-edit', [
            'data' => $this->modelUser->where(['id' => $id])->first()
        ]);
    }
    public function update($id)
    {
        if (empty(session('user'))) {
            return redirect()->to('/');
        }

        $password = $this->request->getPost('password');

        $this->modelUser->where('id', $id)->set(
            [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]
        )->update();

        return redirect()->to('user-index');
    }
    public function destroy($id)
    {
        $this->modelUser->where('id', $id)->delete();
        $this->modelChat->where('from_id', $id)->orWhere('to_id', $id)->delete();
        $this->modelConver->where('user_1', $id)->orWhere('user_2', $id)->delete();

        return redirect()->to('/user-index');
    }
}
