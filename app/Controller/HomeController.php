<?php

namespace App\Controller;

use App\Model\HomeModel;
use EasyProjects\SimpleRouter\Request;
use EasyProjects\SimpleRouter\Response;

class HomeController
{
    public function index()
    {
        view('home');
    }

    public function create()
    {
        view('create');
    }

    public function store(Request $request, Response $response){
        // Lógica para almacenar el contacto
        // var_dump($request);
        $client = (array)$request->body;
        $url = saveFile((array) $request->files->file,'assets/img/',['jpg','jpeg','png','gif', 'PNG', 'JPG', 'JPEG']);

        $HomeModel = new HomeModel();

        ($HomeModel->insertContact($client, $url))
            ? $response->status(200)->send(['data' => 'Datos insertados correctamente'])
            : $response->status(400)->send(['data' => 'Error al insertar los datos']);
    } 
}