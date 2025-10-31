<?php


function view($view_name,$data = []){
    extract($data);
    include(str_replace('Helpers','',__DIR__).'View/'.$view_name.'.php')  ;
}


if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

            // $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), -1, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];

            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';

        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }

        return $base_url;
    }
}

// function saveFile($data_file,string $route, array $list_extension ): string{
//     if (!empty($data_file)) {
//         $extension = pathinfo($data_file['name'], PATHINFO_EXTENSION);
//         $extension = strtolower($extension);
//         /*$valid_extensions = ["jpg", "jpeg", "png", "gif", "PNG", "JPG", "JPEG"]*/;

//         if (in_array($extension, $list_extension)) {
//             $random = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);
//             $name_photo = $random . "_" . date("YmdHis") . "." . $extension;
//             $destination_route = $route . $name_photo;
//             $archivo_movido_ok = move_uploaded_file($data_file['tmp_name'], $destination_route);

//             return ($archivo_movido_ok) ? $name_photo: '';
//         }
//     }

//     return '';
// }