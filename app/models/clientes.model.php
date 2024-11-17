<?php
require_once 'app/models/model.php';
class ClientModel extends Model {

  public function GetAllClientes($apellido = null, $nombre = null , $email = null , $telefono = null , $orderBy = false) {
    $sql = 'SELECT * FROM clientes';
    $params = [];

    // Filtrar por apellido si está especificado
    if ($apellido != null) {
        $sql .= ' WHERE apellido LIKE ?';
        $params[] = "%$apellido%";
    }

    if ($nombre != null) {
      $sql .= ' WHERE nombre LIKE ?';
      $params[] = "%$nombre%";
  }
      if ($email != null) {
        $sql .= ' WHERE email LIKE ?';
        $params[] = "%$email%";
    }
    if ($telefono != null) {
      $sql .= ' WHERE telefono LIKE ?';
      $params[] = "%$telefono%";
    }

    // Ordenar por columna si está especificado
    if ($orderBy) {
        switch ($orderBy) {
            case 'nombre':
                $sql .= ' ORDER BY nombre';
                break;
            case 'apellido':
                $sql .= ' ORDER BY apellido';
                break;
            case 'email':
                $sql .= ' ORDER BY email';
                break;
            case 'telefono':
                $sql .= ' ORDER BY telefono';
                break;
            
        }
    }
    // Ejecutar consulta preparada
    $query = $this->db->prepare($sql);
    $query->execute($params);

    // Retornar los resultados como un arreglo de objetos
    return $query->fetchAll(PDO::FETCH_OBJ);
}


public function getClientesById($id){
  $query = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
  $query->execute([$id]);  // Asegúrate de pasar el parámetro correcto
  $cliente = $query->fetch(PDO::FETCH_OBJ);  
  return $cliente;
}

function insertClient($nombre, $apellido, $email, $telefono){
  $query = $this->db->prepare("INSERT INTO clientes (nombre, apellido, email, telefono) VALUES (?, ?, ?, ?)");
  $query->execute([$nombre, $apellido, $email, $telefono]);
  return $this->db->lastInsertId();
}

function EditClient($nombre, $apellido, $email, $telefono, $id){
  $query = $this->db->prepare("UPDATE clientes SET nombre = ?, apellido = ?, email = ?, telefono = ? WHERE id_cliente = ?");
  $query->execute([$nombre, $apellido, $email, $telefono, $id]);
  return $query;
}

}