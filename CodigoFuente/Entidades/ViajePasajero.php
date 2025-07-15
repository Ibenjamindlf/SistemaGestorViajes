<?php
class ViajePasajero{
    private $viaje;
    private $pasajero;

    public function __construct($viaje,$pasajero) {
        $this->viaje = $viaje;
        $this->pasajero = $pasajero;
    }
    // Getters
    public function getViaje() {
        return $this->viaje;
    }
    public function getPasajero() {
        return $this->pasajero;
    }
    // Setters
    public function setViaje($viaje) {
        $this->viaje = $viaje;
    }
    public function setPasajero($pasajero) {
        $this->pasajero = $pasajero;
    }
    public function __toString()
    {
        $viaje = $this->getViaje();
        $pasajero = $this->getPasajero();
        $cadena = "---------------------------------\n";
        $cadena .= "-- Datos Viaje: --\n$viaje";
        $cadena .= "---------------------------------\n";
        $cadena .= "-- Datos Pasajero: --\n$pasajero";
        return $cadena;
    }
        // 5 funciones (buscar,listar,insertar,modificar,eliminar) -> SQL phpMyAdmin
        // funcion para buscar un viaje segun el viaje
        // En el caso que encuentre un viaje debe llenar el array con todos los viajes de la tabla
public static function buscarPorViaje($idViaje) {
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM viaje_pasajero WHERE idViaje = $idViaje";
    $viajePasajeroEncontradoArray = [];

    if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)) {
        while ($fila = $dataBase->registro()) {
            $viaje = Viaje::buscar($fila['idViaje']);
            if ($viaje === null) {
                throw new Exception("Empresa no encontrada con ID: " . $fila['idEmpresa']);
            }

            $pasajero = Pasajero::buscar($fila['tipoDocumentoPasajero'], $fila['numeroDocumentoPasajero']);
            if ($pasajero === null) {
                throw new Exception("Pasajero no encontrado con documento: " . $fila['tipoDocumentoPasajero'] . " " . $fila['numeroDocumentoPasajero']);
            }

            $viajePasajeroEncontrado = new ViajePasajero(
                $viaje,
                $pasajero
            );

            $viajePasajeroEncontradoArray[] = $viajePasajeroEncontrado;
        }
    } else {
        throw new Exception($dataBase->getError());
    }

    return $viajePasajeroEncontradoArray;
}
// Espacio
public static function buscarPorPasajero($tipoDocPasajero,$numDocPasajero) {
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM viaje_pasajero 
                WHERE tipoDocumentoPasajero = '$tipoDocPasajero' 
                AND numeroDocumentoPasajero = $numDocPasajero";
    $viajePasajeroEncontradoArray = [];

    if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)) {
        while ($fila = $dataBase->registro()) {
            $viaje = Viaje::buscar($fila['idViaje']);
            if ($viaje === null) {
                throw new Exception("Empresa no encontrada con ID: " . $fila['idEmpresa']);
            }
            $pasajero = Pasajero::buscar($fila['tipoDocumentoPasajero'], $fila['numeroDocumentoPasajero']);
            if ($pasajero === null) {
                throw new Exception("Pasajero no encontrado con documento: " . $fila['tipoDocumentoPasajero'] . " " . $fila['numeroDocumentoPasajero']);
            }
            $viajePasajeroEncontrado = new ViajePasajero(
                $viaje,
                $pasajero
            );
            $viajePasajeroEncontradoArray[] = $viajePasajeroEncontrado;
        }
    } else {
        throw new Exception($dataBase->getError());
    }
    return $viajePasajeroEncontradoArray;
}
// espacio
public static function buscar($tipoDocPasajero,$numDocPasajero,$idViaje) {
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM viaje_pasajero 
                WHERE tipoDocumentoPasajero = '$tipoDocPasajero' 
                AND numeroDocumentoPasajero = $numDocPasajero
                AND idViaje = $idViaje";
    $viajePasajeroEncontradoArray = [];

    if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)) {
        while ($fila = $dataBase->registro()) {
            $viaje = Viaje::buscar($fila['idViaje']);
            if ($viaje === null) {
                throw new Exception("Empresa no encontrada con ID: " . $fila['idEmpresa']);
            }
            $pasajero = Pasajero::buscar($fila['tipoDocumentoPasajero'], $fila['numeroDocumentoPasajero']);
            if ($pasajero === null) {
                throw new Exception("Pasajero no encontrado con documento: " . $fila['tipoDocumentoPasajero'] . " " . $fila['numeroDocumentoPasajero']);
            }
            $viajePasajeroEncontrado = new ViajePasajero(
                $viaje,
                $pasajero
            );
            $viajePasajeroEncontradoArray[] = $viajePasajeroEncontrado;
        }
    } else {
        throw new Exception($dataBase->getError());
    }
    return $viajePasajeroEncontradoArray;
}
        // funcion para insertar un viajePasajero
    public function insertar(){
        $dataBase = new DataBase();
        $respuesta = false;
        $consulta = "INSERT INTO viaje_pasajero (
                                    tipoDocumentoPasajero,
                                    numeroDocumentoPasajero,
                                    idViaje
                    ) VALUES (
                                    '" . $this->getPasajero()->getTipoDocumento() . "',
                                    " . $this->getPasajero()->getNumeroDocumento() . ",
                                    " . $this->getViaje()->getIdViaje() . "
                                );";
        if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)){
            $respuesta = true;
        } else {
            throw new Exception($dataBase->getError());
        }
        return $respuesta;
    }
        // funcion para listar un viajePasajero
public static function listar($condicion="") {
    $arrayPasajero = [];
    $dataBase = new DataBase();
    $consulta ="SELECT * 
                FROM viaje_pasajero";
    if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY idViaje";
    if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)){
        $arrayPasajero = [];
        while ($fila = $dataBase->registro()){
            $objPasajero = Pasajero::buscar(
                                                $fila['tipoDocumentoPasajero'],
                                                $fila['numeroDocumentoPasajero']);
            $objViaje = Viaje::buscar($fila['idViaje']);
            $objViajePasajero = new ViajePasajero(
                $objViaje,
                $objPasajero
            );
            $arrayPasajero[] = $objViajePasajero;
        }
    } else {
        throw new Exception($dataBase->getError());
    }
    return $arrayPasajero;
} 
// function modificar(){
//     $respuesta = false;
//     $dataBase = new DataBase();
//     $idViaje= $this->getViaje()->getIdviaje();
//     $tipoDoc = $this->getPasajero()->getTipoDocumento();
//     $numDoc = $this->getPasajero()->getNumeroDocumento();
//     $consulta = "UPDATE viaje_pasajero SET
//                                             tipoDocumentoPasajero='" $tipoDOc "',
//                                             numeroDocumentoPasajero='"$numDoc"',
//                                             idViaje=" $idViaje "
//                 WHERE 

// }
public function eliminar(){
    $respuesta = false;
    $dataBase = new DataBase();
    $idViaje= $this->getViaje()->getIdviaje();
    $tipoDoc = $this->getPasajero()->getTipoDocumento();
    $numDoc = $this->getPasajero()->getNumeroDocumento();
    $consulta = "DELETE FROM viaje_pasajero 
                    WHERE tipoDocumentoPasajero = '" . $tipoDoc . "' 
                    AND numeroDocumentoPasajero = " . $numDoc . " 
                    AND idViaje = " . $idViaje;
    if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)){
        $respuesta = true;
    } else {
        throw new Exception($dataBase->getError());
    }
    return $respuesta;
}
}?>