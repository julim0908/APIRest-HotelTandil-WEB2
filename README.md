API Restfull - WEB 2

- En esta API podra consultar una tabla de clientes
  
- Miembro B: Montenegro Julieta
- Miembro A: Carceles Valentina

(COMO CONSUMIR/USAR LA API:)

- Clientes:

- Todos los clientes: GET -> http://localhost/APIHOTEL/api/clientes
(Si existen los clientes, devuelve los mismos, y si no, un error con un mensaje que los clientes no existen)

- Cliente por ID: GET -> - Todos los Clientes: GET ->http://localhost/APIHOTEL/api/clientes/:Id
(Si existe el cliente devuelve el mismo, y si no, un error con un mensaje que el id especificado no existe)

- ( MIEMBRO A - Ordenado por cualquier campo (opcional)) - Listar coleccion de Clientes por nombre de manera ASCENDENTE: GET -> 

http://localhost/APIHOTEL/api/clientes?nombre&asc=ASC

- (MIEMBRO B - Filtado (opcional)) - Filtrado por apellido: GET -> http://localhost/APIHOTEL/api/clientes?apellido=Montenegro
(Si hay clientes con ese apellido , los trae, si no da un mensaje de que no hay clientes)

- (MIEMBRO B - FILTRADO POR MAS DE UN CAMPO (OPCIONAL )) - GET -> ejemplos: 
- http://localhost/APIHOTEL/api/clientes?apellido=Montenegro&nombre=Juan
- http://localhost/APIHOTEL/api/clientes?apellido=Montenegro&nombre=Juan&email=juan@mail.com&telefono=123456789&orderBy=nombre&asc=ASC

- Crear un nuevo cliente: POST ->http://localhost/APIHOTEL/api/clientes

Para poder agregar un cliente: Debe de tener el siguiente patron: 

{
  "nombre": "Juani",
  "apellido": "Montenegro",
  "email": "juli@gmail.com",
  "telefono": "222"
}

- Actualizar un cliente: PUT -> http://localhost/APIHOTEL/api/clientes/:Id
(Si se actualiza el cliente devuelve un mensaje de exito, y si no, un error con un mensaje no se pudo actualizar)

Para poder actualizar un cliente: Debe de tener el siguiente patron: 

{
  "nombre": "Juani",
  "apellido": "Montenegro",
  "email": "juli@gmail.com",
  "telefono": "222"
}


