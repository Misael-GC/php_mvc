<?php

namespace App\Controller;
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
}