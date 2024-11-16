<?php
require_once 'app/views/auth.view.php';
require_once 'app/models/user.model.php';

class AuthController{

 function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

function showLogin(){
    return $this->view->showLoginForm();
}

function Login(){

    //IMPORTANTE PARA EL PARCIAL HACER LAS VERIFICACIONES
            
    if(empty($_POST['usuario']) || empty($_POST['contraseña'])){
        return $this->view->showLoginForm("Falta llenar el campo usuario.");
    }

    //GUARDO LOS DATOS ENVIADOS POR POST EN VARIABLES.

    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];

    $usuarioByDB = $this->model->getUser($usuario);

    if ($usuarioByDB && password_verify($password, $usuarioByDB->contraseña)){
        //GUARDO EL ID DEL USUARIO EN LA SESION 
        session_start();
        $_SESSION['ID_USER'] = $usuarioByDB->id_usuario;
        $_SESSION['USUARIO'] = $usuarioByDB->usuario;

        header('Location: ' . BASE_URL . 'hola');
        
    }
}
}