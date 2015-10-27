<?php

/**
 * Description of Canciones Lista
 *
 * @author juanma
 */
class Cancion {
    private $nombre;
    private $usuario;
    private $categoria;
    private $imagen;
    private $privada;
    
    function __construct($nombre) {
        $this->nombre = $nombre;
        $this->usuario = $this->genUsuario();
        $this->categoria = $this->genCategoria();
        $this->imagen = $this->genImagen();
        $this->privada = $this->esPrivada();
    }
    private function esPrivada(){
        if(substr($this->nombre, 0, 1) === 'P'){
            return true;
        }
        return false;
    }
    private function genImagen(){
        $name = Files::getFileName($this->nombre);
        if(file_exists(Server::getRoot().'/podcast/caratulas/'.$name.'.jpg')){
            return $name.'.jpg';
        }else{
            return 'default.jpg';
        }
    }
    private function genUsuario(){
        $parte1 = strpos($this->nombre, "_");
        $parte2 = $parte1+1+strpos(substr($this->nombre, $parte1+1), "_");
        $parte3 = $parte2+1+strpos(substr($this->nombre, $parte2+1), "_");
        return substr($this->nombre, $parte1+1, -(strlen($this->nombre)-$parte2));
    }
    private function genCategoria(){
        $parte1 = strpos($this->nombre, "_");     
        $parte2 = $parte1+1+strpos(substr($this->nombre, $parte1+1), "_");
        $parte3 = $parte2+1+strpos(substr($this->nombre, $parte2+1), "_");
        return substr($this->nombre, $parte2+1, -(strlen($this->nombre)-$parte3));
    }            
    function getNombre() {
        return $this->nombre;
    }
    function getImagen() {
        return $this->imagen;
    }
    function getPrivada() {
        return $this->privada;
    }
    function getUsuario() {
        return $this->usuario;
    }
    function getCategoria() {
        return $this->categoria;
    }
    
    function setPrivada(){
        $this->privada=!$this->privada;
    }
    
    public static function getCanciones($usuario=null, $categoria=null, $ini=null, $cant=null){
        $sesion = new Session();
        $files = Files::getDirContent('./canciones');
        $result = array();
        if($cant===null){
            $cant = count($files);
        }
        if($ini===null){
            $ini = 0;
        }
        $i=0;
        while($ini<count($files) && $i<$cant){
            $file = new Cancion($files[$ini]);
            if($usuario===null && $categoria===null){
                if($file->esPrivada()){
                    if($sesion->isLoggeg() && $sesion->get('user')->getUserName() === $file->getUsuario()){                        
                        array_push($result, $file);
                        $ini++;
                        $i++;
                    }else{
                        $ini++;
                    }
                }else{
                    array_push($result, $file);
                    $ini++;
                    $i++;
                }                
            }else if($usuario!==null && $categoria === null){
                if(!$file->esPrivada() && $usuario === $file->getUsuario()){
                    array_push($result, $file);
                    $ini++;
                    $i++;
                }else if($file->esPrivada() && $sesion->isLoggeg() && $file->getUsuario() === $sesion->get('user')->getUserName()){
                    array_push($result, $file);
                    $ini++;
                    $i++;
                }else{
                    $ini++;
                }
            }else if($usuario===null && $categoria !== null){
                if(!$file->esPrivada() && $categoria === $file->getCategoria()){
                    array_push($result, $file);
                    $ini++;
                    $i++;
                }else{
                    $ini++;
                }
            }else{
                if(!$file->esPrivada() && $usuario === $file->getUsuario() && $categoria === $file->getCategoria()){
                    array_push($result, $file);
                    $ini++;
                    $i++;
                }else{
                    $ini++;
                }
            }
        }
        return $result;
    }
}
