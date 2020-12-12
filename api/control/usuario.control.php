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

// Get Users
public function getUsers(){
    $sql= "SELECT * FROM usuarios ";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute();

    while($result = $stmt->fetchAll()){
        return $result;
    }
}

// Evalua correo
public function evaCorreo($correo){
    $sql= "SELECT * FROM usuarios WHERE CORREO=?";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute([$correo]);

    while($result = $stmt->fetchAll()){
        return $result;
    }
}

// Evalua Usuario
public function evaUsuario($usuario){
    $sql= "SELECT * FROM usuarios WHERE USUARIO=?";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute([$usuario]);

    while($result = $stmt->fetchAll()){
        return $result;
    }
}

// Add Usuario
public function addUsuario($US){
    $sql= "INSERT INTO  usuarios (NOMBRE,TELEFONO,CORREO,USUARIO,CLAVE,NACIMIENTO,TIPO) VALUES(:nombre,:telefono,:correo,:usuario,:clave,:nacimiento,:tipo)";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute($US);

    while($result = $stmt->fetchAll()){
        return $result;
    }
}
// Evalua Usuario
public function delUsuario($id){
    $sql= "DELETE FROM usuarios WHERE ID=?";
    $stmt= $this->connect()->prepare($sql);
    $stmt->execute([$id]);

}


    
}