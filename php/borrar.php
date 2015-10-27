<?php
require_once '../classes/Autoload.php';
$session = new Session();

if($session->isLoggeg()){
    $cancion = new Cancion(Request::get('c'));   
    var_dump($cancion);
    if($cancion!=null){
        $rutaCan = "../canciones/".$cancion->getNombre();
        $rutaImg = "../caratulas/".$cancion->getImagen();
        Files::delFile($rutaCan);
        if(is_file($rutaImg) && Files::getFileName($rutaCan) === Files::getFileName($rutaImg)){
            Files::delFile($rutaImg);
        }
    }
}
Utils::redirect();

