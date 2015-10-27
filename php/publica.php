<?php
require_once '../classes/Autoload.php';
$session = new Session();
if($session->isLoggeg()){
    $cancion = new Cancion(Request::get('c'));    
    if($cancion!=null){
        if($cancion->getPrivada()){
            $p = "A";
        }else{
            $p = "P";
        }
        $cancion->setPrivada();
        $old = "../canciones/".$cancion->getNombre();
        $new = "../canciones/".$p.substr($cancion->getNombre(), 1);
        if(Files::renameFile($old, $new)){
            echo 'ok1';
        }
        if($cancion->getImagen()!=='default.jpg'){
            $old = "../caratulas/".$cancion->getImagen();
            $new = "../caratulas/".$p.substr($cancion->getImagen(), 1);
            if(Files::renameFile($old, $new)){
                echo 'ok2';
            }
        }
    }
}
Utils::redirect();
