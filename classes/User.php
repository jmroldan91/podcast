<?php

class User {
    private $userName;
    private $userPass;
    
    function __construct($userName, $userPass='') {
        $this->userName = $userName;
        $this->userPass = $userPass;
    }
    
    function getUserName() {
        return $this->userName;
    }

    function getUserPass() {
        return $this->userPass;
    }
    
    public function __toString() {
        return $this->userName;
    }

}
