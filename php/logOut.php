<?php
require_once '../classes/AutoLoad.php';
$session = new Session();
$session->destroy();
Utils::redirect();
