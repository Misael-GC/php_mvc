<?php

namespace App\Controller;

use App\Model\HomeModel;
use EasyProjects\SimpleRouter\Request;
use EasyProjects\SimpleRouter\Response;

class HomeController
{
    public function index()
    {
        $contacts = new HomeModel();
        $data['contacts'] = $contacts->getAllContacts();
        view('home', $data);
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

    public function destroy(Request $request, Response $response){
        // Lógica para eliminar el contacto
        $id_contact = $request->params->id;

        $homeModel = new HomeModel();
        $img = $homeModel->getContactImg((int)$id_contact)[0]['coct_url_img_profile'];

        if($homeModel->deleteContactById((int)$id_contact)){
            // Eliminar la imagen del servidor
            $imagePath = 'assets/img/' . $img;
            if (file_exists($imagePath)) {
                unlink($imagePath); // Elimina el archivo
            }
            $response->status(200)->send(['data' => 'Contacto eliminado correctamente']);
        } else {
            $response->status(400)->send(['data' => 'Error al eliminar el contacto']);
        }
    }
}