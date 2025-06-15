<?php
// De los pasajeros se conoce su nombre, apellido, número de documento y teléfono.
class Pasajero{
// Atributo de instancia 
    private  $numeroDocumento;
    private  $nombre;
    private  $apellido;
    private  $telefono;
    private  $viaje;
// Zona de metodos
// Constructor
    public function __construct(
        $numeroDocumento,
        $nombre,
        $apellido,
        $telefono,
        $viaje
    ){
        $this->numeroDocumento = $numeroDocumento;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->viaje = $viaje;
    }
// Getters
    public function getNumeroDocumento(){
        return $this->numeroDocumento;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    public function getViaje(){
        return $this->viaje;
    }
// Setters
    public function setNumeroDocumento($newNumeroDocumento){
        $this->numeroDocumento = $newNumeroDocumento;
    }
    public function setNombre($newNombre){
        $this->nombre = $newNombre;
    }
    public function setApellido($newApellido){
        $this->apellido = $newApellido;
    }
    public function setTelefono($newTelefono){
        $this->telefono = $newTelefono;
    }
    public function setViaje($newViaje){
        $this->viaje = $newViaje;
    }
    public function __toString(): string {
        $numeroDocumento = $this->getNumeroDocumento();
        $nombre = $this->getNombre();
        $apellido = $this->getApellido();
        $telefono = $this->getTelefono();
        $viaje = $this->getViaje();

        return
            "---------- PASAJERO ----------\n".
            "Numero Documento: $numeroDocumento\n".
            "Nombre: $nombre \n".
            "Apellido: $apellido \n".
            "Telefono: $telefono \n".
            "---------- VIAJE ----------\n".
            "$viaje\n".
            "-----------------------------"
;
}
// Funcion para buscar un pasajero por DNI en la base de datos
// Return true si se encontró al pasajero, false si no
public function buscar($numeroDoc){
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM pasajero WHERE idpasajero = '" . $numeroDoc . "'";
    $respuesta = false;

    if ($dataBase->iniciar()) {
        if ($dataBase->ejecutar($consulta)) {
            if ($fila = $dataBase->registro()) {
                $this->setNumeroDocumento($fila['numeroDocumento']);
                $this->setNombre($fila['nombre']);
                $this->setApellido($fila['apellido']);
                $this->setTelefono($fila['telefono']);
                $this->setViaje($fila['idViaje']);

                $respuesta = true;
            }
        } else {
            throw new Exception("Error: la consulta no se pudo ejecutar");
        }
    } else {
        throw new Exception("Error: la base de datos no se pudo iniciar");
    }

    return $respuesta;
}
// Funcion para listar toda la tabla Pasajero
// Return el arreglo con los pasajeros o null
    public function listar($condicion = "") {
    $arrayPasajero = null;
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM pasajero";

    if ($condicion != "") {
        $consulta .= " WHERE " . $condicion;
    }

    $consulta .= " ORDER BY nombre";

    if ($dataBase->iniciar()) {
        if ($dataBase->ejecutar($consulta)) {
            $arrayPasajero = array();
            while ($fila = $dataBase->registro()) {
                // Creamos el objeto pasajero con valores "nulos"
                $pasajero = new Pasajero(0,"","",0,0);

                // Asignamos directamente los datos del array
                $pasajero->setNumeroDocumento($fila['numeroDocumento']);
                $pasajero->setNombre($fila['nombre']);
                $pasajero->setApellido($fila['apellido']);
                $pasajero->setTelefono($fila['telefono']);
                $pasajero->setViaje($fila['idviaje']);

                // Lo agregamos al array
                array_push($arrayPasajero, $pasajero);
            }
        } else {
            throw new Exception("Error: la consulta no se pudo ejecutar");
        }
    } else {
        throw new Exception("Error: la base de datos no se pudo iniciar");
    }

    return $arrayPasajero;
}
// Funcion para insertar un nuevo pasajero
// Return
    public function insertar(){
        $dataBase = new DataBase();
        $respuesta = false;
        $consulta="INSERT INTO persona(numeroDocumento, nombre, apellido, telefono, idViaje)
                VALUES ('".$this->getNumeroDocumento()."','".$this->getNombre()."','".$this->getApellido()."','".$this->getTelefono()."','".$this->getViaje()."')";
        if($dataBase->iniciar()){
            if($dataBase->ejecutar($consulta)){
                $respuesta=true;
            }
            else{
            throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        }
        else{
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $respuesta;
    }
// Funcion para modificar los datos de un pasajero
// Return
    public function modificar(){
        $respuesta=false;
        $dataBase = new DataBase();
        $consulta = "UPDATE persona SET nombre='" . $this->getNombre() .
                                        "',apellido='" . $this->getApellido() .
                                        "',telefono='" . $this->getTelefono() .
                                        "',idViaje='" . $this->getViaje() .
                    "' WHERE documento=" . $this->getNumeroDocumento() . ";";
        if($dataBase->iniciar()){
            if($dataBase->ejecutar($consulta)){
                $resp=true;
            }else{
                throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        }else{
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $respuesta;
    }
// Funcion para eliminar un Pasajero
// Return
    public function eliminar(){
        $respuesta = false;
        $dataBase = new DataBase();
        if($dataBase->iniciar()){
            $consulta="DELETE FROM persona WHERE documento=".$this->getNumeroDocumento();
            if($dataBase->ejecutar($consulta)){
                $resp=true;
            }else{
                throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        }else{
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $respuesta;
    }
}
?>