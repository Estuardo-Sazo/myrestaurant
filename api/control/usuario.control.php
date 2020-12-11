<?php

include "../include/base.connect.php";


class DaoUser extends Base{
// function login

public function loginUser($usuario){
    $sql= "SELECT * FROM usuarios WHERE USUARIO=?";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute([$usuario]);

    while($result = $stmt->fetchAll()){
        return $result;
    }
}
    
}