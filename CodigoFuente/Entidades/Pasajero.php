<?php
// pasajero.php estable
// De los pasajeros se conoce su nombre, apellido, número de documento y teléfono.
class Pasajero extends Persona{
    // Atributo de instancia 
    private $nacionalidad;
    private $necesitaAsistencia;
    // Zona de metodos
    // Constructor
    public function __construct(
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $telefono,
        $nacionalidad,
        $necesitaAsistencia
    ){
        parent :: __construct($nombre,$apellido,$tipoDocumento,$numeroDocumento,$telefono);
        $this->nacionalidad = $nacionalidad;
        $this->necesitaAsistencia = $necesitaAsistencia;
    }
    // Getters
    public function getNacionalidad() {
        return $this->nacionalidad;
    }
    public function getNecesitaAsistencia() {
        return $this->necesitaAsistencia;
    }
    // Setters
    public function setNacionalidad($nacionalidad) {
        $this->nacionalidad = $nacionalidad;
    }
    public function setNecesitaAsistencia($necesitaAsistencia) {
        $this->necesitaAsistencia = $necesitaAsistencia;
    }
    public function __toString(): string {
        $nacionalidad = $this->getNacionalidad();
        $necesitaAsistencia = $this->getNecesitaAsistencia();
        $cadena = parent :: __toString();
        $cadena .= "\nNacionalidad: $nacionalidad\n";
        $cadena .= "Necesita asistencia: " . ($necesitaAsistencia ? "sí" : "no") . "\n";
        return $cadena;
            // "---------- PASAJERO ----------\n".
            // "Numero Documento: $numeroDocumento\n".
            // "Nombre: $nombre \n".
            // "Apellido: $apellido \n".
            // "Telefono: $telefono \n".
            // "---------- VIAJE ----------\n".
            // "$viaje\n".
            // "-----------------------------"
}

// 5 funciones (buscar,listar,insertar,modificar,eliminar) -> phpMyAdmin

// Funcion validada ✅
// Funcion para buscar un pasajero por tipo y numero de documento en la base de datos
// Return true si se encontró al pasajero, false si no
public static function buscar($tipoDocumento,$numeroDocumento){
    $dataBase = new DataBase();
    $consulta = "SELECT p.*, pa.nacionalidad, pa.necesitaAsistencia 
                FROM persona p 
                JOIN pasajero pa 
                ON p.tipoDocumento = pa.tipoDocumento 
                AND p.numeroDocumento = pa.numeroDocumento
                WHERE p.tipoDocumento = '" . $tipoDocumento . "' 
                AND p.numeroDocumento = '" . $numeroDocumento . "'";
    $pasajeroEncontrado = null;

    if ($dataBase->iniciar()) {
        if ($dataBase->ejecutar($consulta)) {
            // Mientras $fila tenga valor el if se ejecuta
            if ($fila = $dataBase->registro()) {
                $pasajeroEncontrado = new Pasajero(
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['tipoDocumento'],
                        $fila['numeroDocumento'],
                        $fila['telefono'],
                        $fila['nacionalidad'],
                        $fila['necesitaAsistencia']
                    );
                // $pasajeroEncontrado->setNumeroDocumento($numeroDoc);
            }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }

        return $pasajeroEncontrado;
}
// Funcion en validada ✅
// Funcion para listar toda la tabla Pasajero
// Return el arreglo con los pasajeros o null
    public static function listar($condicion = "") {
        $arrayPasajero = [];
        $dataBase = new DataBase();
        $consulta = "SELECT p.*, pa.nacionalidad, pa.necesitaAsistencia 
                    FROM persona p 
                    JOIN pasajero pa 
                    ON p.tipoDocumento = pa.tipoDocumento 
                    AND p.numeroDocumento = pa.numeroDocumento";
;
        
        if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY p.nombre";

        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                $arrayPasajero = [];
                // Mientras $row tenga valor el while sigue reiterando
                while ($fila = $dataBase->registro()) {
                    $objPasajero = new Pasajero(
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['tipoDocumento'],
                        $fila['numeroDocumento'],
                        $fila['telefono'],
                        $fila['nacionalidad'],
                        $fila['necesitaAsistencia']
                    );
                    // $objPasajero->setNumeroDocumento($fila['numeroDocumento']);
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
// Funcion en validada ✅
// Funcion para insertar un nuevo pasajero
// Return
    public function insertar(){
        $dataBase = new DataBase();
        $respuesta = false;
        // En $consulta (int)$this->getNecesitaAsistencia() no va con '"__"' por que es un numero, no una cadena
        $consulta = "INSERT INTO pasajero(tipoDocumento, numeroDocumento, nacionalidad, necesitaAsistencia)
                    VALUES (
                            '" . parent::getTipoDocumento() . "',
                            '" . parent::getNumeroDocumento() . "',
                            '" . $this->getNacionalidad() . "',
                            " . (int)$this->getNecesitaAsistencia() . "
                            )";
        if ($dataBase->iniciar()) {
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
// Funcion validada ✅
// Funcion para modificar los datos de un pasajero
// Return
    public function modificar(){
        $respuesta = false;
        $dataBase = new DataBase();
        $consulta = "UPDATE pasajero SET 
                                        nacionalidad='" . $this->getNacionalidad() . "',
                                        necesitaAsistencia=" . (int)$this->getNecesitaAsistencia() . " 
                    WHERE tipoDocumento = '" . $this->getTipoDocumento() . "'
                    AND numeroDocumento = '" . $this->getNumeroDocumento() . "'";
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
// Funcion validad ✅
// Funcion para eliminar un Pasajero
// Return
    public function eliminar(){
        $respuesta = false;
        $dataBase = new DataBase();
        if($dataBase->iniciar()){
            $consulta = "DELETE FROM pasajero 
                    WHERE tipoDocumento = '" . parent::getTipoDocumento() . "' 
                    AND numeroDocumento = '" . parent::getNumeroDocumento() . "'";
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