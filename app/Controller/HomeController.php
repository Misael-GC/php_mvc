<?php

namespace App\Controller;

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
        var_dump($request);
    }
}