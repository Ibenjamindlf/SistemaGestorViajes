<?php
// pasajero.php estable
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

// 5 funciones (buscar,listar,insertar,modificar,eliminar) -> phpMyAdmin

// Funcion para buscar un pasajero por DNI en la base de datos
// Return true si se encontró al pasajero, false si no
public static function buscar($numeroDoc){
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM pasajero WHERE numeroDocumento = '" . $numeroDoc . "'";
    $pasajeroEncontrado = null;

    if ($dataBase->iniciar()) {
        if ($dataBase->ejecutar($consulta)) {
            // Mientras $fila tenga valor el if se ejecuta
            if ($fila = $dataBase->registro()) {
                $pasajeroEncontrado = new Pasajero(
                        $fila['numeroDocumento'],
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['telefono'],
                        $fila['idViaje']
                    );
                $pasajeroEncontrado->setNumeroDocumento($numeroDoc);
            }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }

        return $pasajeroEncontrado;
}
// Funcion para listar toda la tabla Pasajero
// Return el arreglo con los pasajeros o null
    public static function listar($condicion = "") {
        $arrayPasajero = null;
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM pasajero";
        
        if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY nombre";

        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                $arrayPasajero = [];
                // Mientras $row tenga valor el while sigue reiterando
                while ($fila = $dataBase->registro()) {
                    $objPasajero = new Pasajero(
                        $fila['numeroDocumento'],
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['telefono'],
                        $fila['idviaje']
                    );
                    $objPasajero->setNumeroDocumento($fila['numeroDocumento']);
                    $arrayPasajero[] = $objPasajero;
                }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }
        return $arrayPasajero;
    }
// Funcion para insertar un nuevo pasajero
// Return
    public function insertar(){
        $dataBase = new DataBase();
        $respuesta = false;
        $consulta="INSERT INTO pasajero(numeroDocumento, nombre, apellido, telefono, idViaje)
                VALUES ('".$this->getNumeroDocumento()."','".$this->getNombre()."','".$this->getApellido()."','".$this->getTelefono()."','".$this->getViaje()."')";
        if($dataBase->iniciar()){
            $numeroDocInsertado = $dataBase->devuelveIDInsercion($consulta);
            if ($numeroDocInsertado !== null){
                $this->setNumeroDocumento($numeroDocInsertado);
                $respuesta = true;
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }

        return $respuesta;
    }
// Funcion para modificar los datos de un pasajero
// Return
    public function modificar(){
        $respuesta=false;
        $dataBase = new DataBase();
        $consulta = "UPDATE pasajero SET nombre='" . $this->getNombre() .
                                        "',apellido='" . $this->getApellido() .
                                        "',telefono='" . $this->getTelefono() .
                                        "',idViaje='" . $this->getViaje() .
                    "' WHERE numeroDocumento=" . $this->getNumeroDocumento() . ";";
        if($dataBase->iniciar()){
            if($dataBase->ejecutar($consulta)){
                $respuesta=true;
            }else{
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }
        return $respuesta;
    }
// Funcion para eliminar un Pasajero
// Return
    public function eliminar(){
        $respuesta = false;
        $dataBase = new DataBase();
        if($dataBase->iniciar()){
            $consulta="DELETE FROM pasajero WHERE numeroDocumento =".$this->getNumeroDocumento();
            if ($dataBase->ejecutar($consulta)) {
                $respuesta = true;
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }
        return $respuesta;
    }
}
?>