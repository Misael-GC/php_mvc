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

    public function validations($client):array{
        $error = [];
        if(empty($client['name'])) $error += ['name' => 'Insert name'];
        if(empty($client['lastName'])) $error += ['lastName' => 'Insert phone'];
        if(empty($client['age'])) $error += ['age' => 'Insert age'];
        if(empty($client['email'])) $error += ['email' => 'Insert email'];

        return $error;
    }

    public function store(Request $request, Response $response){
        // Lógica para almacenar el contacto
        // var_dump($request);
        $client = (array)$request->body;
        $errors = $this->validations($client);

        if(empty($errors)){
            $url = saveFile((array) $request->files->file,'assets/img/',['jpg','jpeg','png','gif', 'PNG', 'JPG', 'JPEG']);

            $HomeModel = new HomeModel();

            ($HomeModel->insertContact($client, $url))
                ? $response->status(200)->send(['data' => 'Datos insertados correctamente'])
                : $response->status(400)->send(['data' => 'Error al insertar los datos']);
            }else{
                $response->status(400)->send(['data' => $errors]);
            }

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

    public function edit(Request $request, Response $response){
        $data['id_contact'] = $request->params->id; 
        // var_dump('desde edit: ',$request);
        // var_dump('desde edit: ',$request->params->id);
        // Lógica para mostrar el formulario de edición un pre-llenado
        $homoeModel = new HomeModel();
        $data['contact'] = $homoeModel->getContactById((int)$request->params->id);
        // var_dump($data); //nos regresa todos los datos del contacto
        view('edit', $data);
    }

    public function update(Request $request, Response $response){
        // var_dump($request->params->id);
        // var_dump((array)$request->body);
        // Lógica para actualizar el contacto
        $id_contact = $request->params->id;
        $updatedData = (array)$request->body;

        $homeModel = new HomeModel();

        if($homeModel->updateContactById((int)$id_contact, $updatedData)){
            $response->status(200)->send(['data' => 'Contacto actualizado correctamente']);
        } else {
            $response->status(400)->send(['data' => 'Error al actualizar el contacto']);
        }
    }
}