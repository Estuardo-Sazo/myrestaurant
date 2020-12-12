<?php

// Estabablecmos el modo de respuesta de tipo JSON
header("Content-type: application/json");

/// Guardamos el tipo de request para luego evalualro
$REQUETS =$_SERVER['REQUEST_METHOD'];
//Incluimos el dao encargao de hacer el CRUD de usuaios
include_once('../control/usuario.control.php');
$user =new DaoUser;

//Si el request es de tipo GET
if($REQUETS=='GET'){
    $r;/// Variable para enviar la respuesta a la peticion

    if(isset($_GET['id'])){
        $result['message']="Methd GET:ID";
    }else{
        $r= json_encode($user->getUsers());
    }
    
    echo $r;
}

//Si el request es de tipo POST
if($REQUETS=='POST'){
    $r;/// Variable para enviar la respuesta a la peticion

    //Evaluamos si es un login de usuario
    if(isset($_GET['login'])){
        $_POST= json_decode(file_get_contents('php://input'),true); // Almacenamos las respuesta de app cliente
        $rpt= $user->loginUser($_POST['usuario']);
       if(isset($rpt[0])){
            // Evaluamos si la comtra se;a es correcta
            if (password_verify($_POST['clave'], $rpt[0]['CLAVE']))
            {               
                $result['login']="true"; /// parametro de correcto             
                unset($rpt[0]['CLAVE']); // eliminamos el campo clave
                $result['us']=$rpt[0];  // agregamos los parametros del usuario

                $r= json_encode($result);
            }else{
                $result['message']="Error de clave"; 
                $r= json_encode($result); 
            }
       }else {
        $result['message']="Error de usuario"; 
        $r= json_encode($result);
       }

      
    }else if(isset($_GET['add'])){
        $_POST= json_decode(file_get_contents('php://input'),true); // Almacenamos las respuesta de app cliente
        //Evalamos si ya exste el correo
        $rpt= $user->evaCorreo($_POST['correo']); 
        //Evalamos si ya exste el usuario    
        $rptU= $user->evaUsuario($_POST['usuario']);
       if(isset($rpt[0])){
        $result['message']="Error Correo ya existe";
        $r= json_encode($result);         
       }else if(isset($rptU[0])){
        $result['message']="Error Usuario ya existe";
        $r= json_encode($result);       
      }else{
          $rr=$user->addUsuario($_POST);
        $result['message']="Correcto";
        $r= json_encode($result); 
      }  

    }   
    else{
    $result['message']="Methd POST";
    echo json_encode($result);
    }
    echo $r;
}

//Si el request es de tipo PUT
if($REQUETS=='PUT'){
    $result['message']="Methd PUT";
    echo json_encode($result);
}

//Si el request es de tipo DELETE
if($REQUETS=='DELETE'){
    $r;/// Variable para enviar la respuesta a la peticion

    if(isset($_GET['id'])){
        $user->delUsuario($_GET['id']);
        $result['message']="Eliminado Usuario ID: ".$_GET['id'];
       $r= json_encode($result);
    }else {
        $result['message']="Need ?id";
       $r= json_encode($result);
    }
    
    echo $r;
}



