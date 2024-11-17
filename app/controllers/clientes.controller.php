<?php
    
include_once 'app/models/clientes.model.php';
include_once 'app/views/json.view.php';

class ClientController {
    private $model;
    private $view;

public function __construct (){
    $this->model = new ClientModel();
    $this->view = new JSONView();
}

//METODOS 
    //A Y B
    public function GetAllClientes($req, $res) {
        $apellido = null;
        // Verificar si se desea filtrar por apellido
        if (isset($req->query->apellido)) {
            $apellido = $req->query->apellido;
        }

        $nombre = null;
        // Verificar si se desea filtrar por apellido
        if (isset($req->query->nombre)) {
            $nombre = $req->query->nombre;
        }

        $email = null;
        // Verificar si se desea filtrar por apellido
        if (isset($req->query->email)) {
            $email = $req->query->email;
        }

        $telefono = null;
        // Verificar si se desea filtrar por apellido
        if (isset($req->query->telefono)) {
            $telefono = $req->query->telefono;
        }
        
        $orderBy = false;
        // Verificar si se desea ordenar por algún criterio
        if (isset($req->query->asc)) {
            $orderBy = $req->query->asc;
        }
    
        // Obtener los clientes con filtros y orden
        $clientes = $this->model->GetAllClientes($apellido,$nombre, $orderBy);
        
        // Enviar la respuesta con los datos obtenidos
        return $this->view->response($clientes, 200);
    }
   //  A 
    public function updateClient($req, $res){
    $id = $req->params->id;
    
    $cliente = $this->model->getClientesById($id);  
    if(!$cliente){
        $this->view->response('No hay clientes con ese id', 404);
    } 

    $nombre = $req->body['nombre'];
    $apellido = $req->body['apellido'];
    $email = $req->body['email'];
    $telefono = $req->body['telefono'];

    if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono)) {
        $this->view->response('Faltan completar datos', 400);
    }

    $ClienteEditado = $this->model->EditClient($nombre, $apellido, $email, $telefono, $id);

    if($ClienteEditado){
        $cliente = $this->model->getClientesById($id);  
        $this->view->response('Cliente editado correctamente', 200);
    }else{
        $this->view->response('Error al editar cliente', 500);
    }

}
//B
    public function GetClientesById($req, $res){
        $id = $req->params->id;  
        $cliente = $this->model->getClientesById($id);  
        if(!$cliente){
            $this->view->response('No hay clientes registrados', 404);
        } 
            return $this->view->response($cliente, 200);
}

//B
    public function CreateClient($req, $res){
        $nombre = $req->body['nombre'];
        $apellido = $req->body['apellido'];
        $email = $req->body['email'];
        $telefono = $req->body['telefono'];

        if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono)) {
         $this->view->response('Faltan completar datos', 400);
        }

        $ClienteCreado = $this->model->insertClient($nombre, $apellido, $email, $telefono);

        if ($ClienteCreado) {
                $cliente = $this->model->GetClientesById($ClienteCreado);
                return $this->view->response($cliente , 201);
            } else {
                return $this->view->response("Error al insertar el", 500);
            }
    }   
  }
?>
