<?php
require_once '../classes/AutoLoad.php';
$session = new Session();
$user = Request::post('login');
if($user!==null && $user!==""){
    $session->set('user', new User($user));
}
Utils::redirect();

