<?php
require_once 'app/models/model.php';
class ClientModel extends Model {

  public function GetAllClientes($apellido = null, $asc = false) {
    $sql = 'SELECT * FROM clientes';
    $params = [];

    // Filtro por apellido
    if ($apellido != null) {
        $sql .= ' WHERE apellido = ?';
        $params[] = $apellido;
    }

    // Ordenar por nombre de columna (validado) y dirección
    if ($asc) {
        $direction = strtolower($asc) === 'asc' ? 'ASC' : 'DESC'; // Validar asc/desc
        $sql .= ' ORDER BY apellido ' . $direction;
    }

    // Preparar y ejecutar consulta
    $query = $this->db->prepare($sql);
    $query->execute($params);

    // Retornar los datos
    return $query->fetchAll(PDO::FETCH_OBJ);

      // 2. Ejecuto la consulta
      $query = $this->db->prepare($sql);
      $query->execute($apellido,$asc);
  
      // 3. Obtengo los datos en un arreglo de objetos
      $clients = $query->fetchAll(PDO::FETCH_OBJ); 
  
      return $clients;
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