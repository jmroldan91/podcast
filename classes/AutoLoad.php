<?php

function autocargador($clase) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/podcast/classes/' . $clase . '.php';
}    

spl_autoload_register('autocargador');
