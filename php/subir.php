<?php
require_once '../classes/Autoload.php';
$session = new Session();
if(Request::post('categoria')!==null){
    $usuario = $session->get('user')->getUserName();
    $categoria = Request::post('categoria');
    if(Request::post('privado')!==null){
        $privado = "P";
    }else{
        $privado = "A";
    }
    if(isset($_FILES['cancion'])){
        $cancion = new uploadFile($_FILES['cancion']);
        $nombre_tipado = $privado.'_'.$usuario.'_'.$categoria.'_'.$cancion->getName();
        if($cancion->getError()===UPLOAD_ERR_OK && $cancion->getExt()==="mp3"){
            $cancion->setName($nombre_tipado);
            if(!$cancion->upload()){
                echo "<h2>Error: ".$cancion->getError_message()."</h2>";
                echo $cancion;
            }else{
                echo "<h2>Error: ".$cancion->getError_message()."</h2>";
            }       
        }else{            
            echo "<h2>No ha llegado ninguna cancion: ".$cancion->getError_message()."</h2>";
        }        
        if(isset($_FILES['img'])){
            $imagen = new UploadFile($_FILES['img']);
            if($imagen->getError()===UPLOAD_ERR_OK && $imagen->getExt()==="jpg"){
                $imagen->setName($nombre_tipado);
                if(!$imagen->upload()){
                    echo "<h2>Error: ".$imagen->getError_message()."</h2>";
                }
            }else{
                echo "<h2>Error: ".$imagen->getError_message()."</h2>";
            }            
        }else{
            echo "<h2>No ha subido ninguna imagen</h2>";
        }       
    }else{
        echo "<h2>No ha subido ninguna canción</h2>";
    }
}else{
    echo "EEEEEEEEEEEEEEEEEEEE";
}
Utils::redirect();