<?php

namespace App\Controller\Pages;

use App\Model\DAO\User;
use App\Controller\Http\Response;

class UserController
{

    public function getAll()
    {
        $result = (new User())->getAll();
        // $result = (new User())->createTables();
        return new Response(200, json_encode($result));
    }

    public function get($id)
    {
        $result = (new User())->get($id['id']);
        return new Response(200, json_encode($result));
    }

    public function create()
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return new Response(201, (new User())->insert($data));
    }

    public function update($id)
    {
        $data = (array) json_decode(file_get_contents("php://input"), true);
        return new Response(204, (new User())->update($id['id'], $data));
    }

    public function delete($id)
    {
        return new Response(204, (new User())->delete($id['id']));
    }
}
