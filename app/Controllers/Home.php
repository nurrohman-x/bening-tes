<?php

namespace App\Controllers;

use App\Models\Chat;
use App\Models\Conversation;
use App\Models\User;

class Home extends BaseController
{
    protected $modelUser,
        $user,
        $modelConversation,
        $modelChat,
        $db;

    public function __construct()
    {
        $this->modelUser = new User();
        $this->modelConversation = new Conversation();
        $this->modelChat = new Chat();
        $this->user = session('user');
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (empty(session('user'))) {
            return redirect()->to('/');
        }

        $sql = $this->modelConversation
            ->where('user_1', $this->user->id)
            ->orWhere('user_2', $this->user->id)
            ->orderBy('id', 'DESC')
            ->findAll();

        $data_user = [];
        $result = [];
        $associativeArray = [];

        foreach ($sql as $dt) {
            $data_user[] = $dt->user_1;
            $data_user[] = $dt->user_2;
        }
        $data_user = array_filter($data_user, function ($data) {
            return $data != $this->user->id;
        });

        foreach ($data_user as $id) {
            $uniqueKey = $id;
            if (!array_key_exists($uniqueKey, $associativeArray)) {
                $associativeArray[$uniqueKey] = true;
                $res = $this->modelUser->where('id', $id)->first();

                $chat = $this->modelChat->where('from_id', $res->id)->orderBy('id', 'desc')->first();

                $result[] = ['id' => $res->id, 'username' => $res->username, 'email' => $res->email, 'opened' => $chat->opened ?? ''];
            }
        }

        $user = $this->modelUser->whereNotIn('id', [$this->user->id])->findAll();

        return view('dashboard', [
            'data' => $result,
            'user' => $user
        ]);
    }
    public function user_chat($id)
    {
        if (empty(session('user'))) {
            return redirect()->to('/');
        }
        $data = $this->modelConversation
            ->where('user_1', $id)->orWhere('user_1', $this->user->id)
            ->where('user_2', $this->user->id)->orWhere('user_2', $id)
            ->first();

        if ($data) {
            $conver_id = $data->id;
        } else {
            $conver_id = $this->modelConversation->insert([
                'user_1' => $this->user->id,
                'user_2' => $id
            ]);
        }

        $this->modelChat->where('from_id', $id)->set(['opened' => 1])->update();

        return view('user-chat', [
            'user' => $this->modelUser->where('id', $id)->first(),
            'data' => $this->modelChat->where('conversation_id', $conver_id)->findAll(),
            'id_conv' => $conver_id
        ]);
    }

    public function do_user_chat()
    {
        $data = [
            'from_id' => $this->user->id,
            'to_id' => $this->request->getPost('to_id'),
            'message' => $this->request->getPost('message'),
            'conversation_id' => $this->request->getPost('conv_id')
        ];

        $this->modelChat->insert($data);

        echo json_encode($data);
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
            return redirect()->to('/');
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
}
