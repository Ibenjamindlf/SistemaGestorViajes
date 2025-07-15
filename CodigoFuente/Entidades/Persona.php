<?php
// include_once 'BaseDatos.php';
// pasajero.php estable
// De los pasajeros se conoce su nombre, apellido, número de documento y teléfono.
class Persona{
// Atributo de instancia
    // private  $idPersona = 0; 
    private  $nombre;
    private  $apellido;
    private  $tipoDocumento;
    private  $numeroDocumento;
    private  $telefono;
// Zona de metodos
// Constructor
    public function __construct(
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $telefono
    ){
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->tipoDocumento = $tipoDocumento;
        $this->numeroDocumento = $numeroDocumento;
        $this->telefono = $telefono;
    }
// Getters
    // public function getIdPersona() {
    //     return $this->idPersona;
    // }
    public function getNombre() {
        return $this->nombre;
    }
    public function getApellido() {
        return $this->apellido;
    }
    public function getTipoDocumento() {
        return $this->tipoDocumento;
    }
    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }
    public function getTelefono() {
        return $this->telefono;
    }
// Setters
    // public function setIdPersona($idPersona) {
    //     $this->idPersona = $idPersona;
    // }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }
    public function setTipoDocumento($tipoDocumento) {
        $this->tipoDocumento = $tipoDocumento;
    }
    public function setNumeroDocumento($numeroDocumento) {
        $this->numeroDocumento = $numeroDocumento;
    }
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function __toString(): string {
        // $idPersona = $this->getIdPersona();
        $nombre = $this->getNombre();
        $apellido = $this->getApellido();
        $tipoDocumento = $this->getTipoDocumento();
        $numeroDocumento = $this->getNumeroDocumento();
        $telefono = $this->getTelefono();

        return(
            // "---------- PERSONA ----------\n".
            // "id Persona: $idPersona \n".
            "Nombre: $nombre \n".
            "Apellido: $apellido \n".
            "Tipo Documento: $tipoDocumento\n".
            "Numero Documento: $numeroDocumento\n".
            "Telefono: $telefono"
        );
;
}

// 5 funciones (buscar,listar,insertar,modificar,eliminar) -> phpMyAdmin

// Funcion validad ✅
// Funcion para buscar una persona por su id en la base de datos
// Return true si se encontró a la persona, false si no
public static function buscar($tipoDoc,$numeroDoc){
    $dataBase = new DataBase();
    $consulta = "SELECT * FROM persona 
                WHERE tipoDocumento = '" . $tipoDoc . "' 
                AND numeroDocumento = '" . $numeroDoc . "'";
    $personaEncontrada = null;
    if ($dataBase->iniciar()) {
        if ($dataBase->ejecutar($consulta)) {
            // Mientras $fila tenga valor el if se ejecuta
            if ($fila = $dataBase->registro()) {
                $personaEncontrada = new Persona(
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['tipoDocumento'],
                        $fila['numeroDocumento'],
                        $fila['telefono']
                    );
                // $personaEncontrada->setTipoDocumento($tipoDoc);
                // $personaEncontrada->setNumeroDocumento($numeroDoc);
            }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }

    return $personaEncontrada;
}
// Funcion validada ✅
// Funcion para listar toda la tabla persona
// Return el arreglo con las personas o null
    public static function listar($condicion = "") {
        $arrayPersonas = null;
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM persona";
        
        if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY nombre";

        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                $arrayPersonas = [];
                // Mientras $row tenga valor el while sigue iterando
                while ($fila = $dataBase->registro()) {
                    $objPersona = new Persona(
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['tipoDocumento'],
                        $fila['numeroDocumento'],
                        $fila['telefono']
                    );
                    // $objPersona->setIdPersona($fila['idPersona']);
                    $arrayPersonas[] = $objPersona;
                }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }
        return $arrayPersonas;
    }
// Funcion validada ✅
// Funcion para insertar una nueva persona
// Return
public function insertar() {
    $dataBase = new DataBase();
    $respuesta = false;
    $consulta = "INSERT INTO persona (nombre, apellido, tipoDocumento, numeroDocumento, telefono)
                VALUES ('" . $this->getNombre() . "', '" . $this->getApellido() . "', '" .
                            $this->getTipoDocumento() . "', '" . $this->getNumeroDocumento() . "', '" .
                            $this->getTelefono() . "')";
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

// Funcion Validada ✅
public function modificar() {
    $respuesta = false;
    $dataBase = new DataBase();
    $consulta = "UPDATE persona SET nombre = '" . $this->getNombre() . "',
                                    apellido = '" . $this->getApellido() . "',
                                    telefono = '" . $this->getTelefono() . "'
                WHERE tipoDocumento = '" . $this->getTipoDocumento() . "'
                AND numeroDocumento = '" . $this->getNumeroDocumento() . "'";
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
// Función para eliminar una persona
public function eliminar() {
    $respuesta = false;
    $dataBase = new DataBase();
    if ($dataBase->iniciar()) {
        $consulta = "DELETE FROM persona 
                    WHERE tipoDocumento = '" . $this->getTipoDocumento() . "' 
                    AND numeroDocumento = '" . $this->getNumeroDocumento() . "'";
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