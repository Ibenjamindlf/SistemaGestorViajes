<?php
// include_once 'BaseDatos.php';

Class Responsable extends Persona{
    // Atributos de instancia
    private $numeroEmpleado;
    private $legajo;

    /// Constructor
    public function __construct(
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $telefono,
        $numeroEmpleado,
        $legajo
    ){
        parent::__construct($nombre,$apellido,$tipoDocumento,$numeroDocumento,$telefono);
        $this->numeroEmpleado = $numeroEmpleado;
        $this->legajo = $legajo;
    }
    // Getters
    public function getNumeroEmpleado() {
        return $this->numeroEmpleado;
    }
    public function getLegajo() {
        return $this->legajo;
    }
    // Setters
    public function setNumeroEmpleado($numeroEmpleado) {
        $this->numeroEmpleado = $numeroEmpleado;
    }
    public function setLegajo($legajo) {
        $this->legajo = $legajo;
    }
    // Metodo __toString
    public function __toString(){
        $numeroEmpleado = $this->getNumeroEmpleado();
        $legajo = $this->getLegajo();
        $cadena = parent::__toString();
        $cadena .= "\nNumero Empleado: $numeroEmpleado\n";
        $cadena .= "Legajo: $legajo\n";
        return $cadena;
    }

    // 5 funciones (buscar,listar,insertar,modificar,eliminar) -> SQL phpMyAdmin
 
    /**
     * Función para buscar empleado segun numeroEmpleado.
     * Retorna true si la encuentra, falso caso contrario.
     * 
     * @param int numeroEmpleadp
     * @return Responsable||null
    */
    // Funcion pre-validada ✅
    public static function buscar($tipoDocumento,$numeroDocumento){
        $dataBase = new DataBase();
        // $consulta = "SELECT * FROM responsable WHERE numeroEmpleado = '". $numeroEmpleado . "'";
        $consulta = "SELECT p.*, r.numeroEmpleado, r.legajo 
                FROM persona p 
                JOIN responsable r 
                ON p.tipoDocumento = r.tipoDocumento 
                AND p.numeroDocumento = r.numeroDocumento
                WHERE p.tipoDocumento = '" . $tipoDocumento . "' 
                AND p.numeroDocumento = '" . $numeroDocumento . "'";
        $responsableEncontrado = null;

        if ($dataBase->iniciar()) {
            if($dataBase->ejecutar($consulta)) {
                // Mientras $fila tenga valor el if se ejecuta
                if($fila = $dataBase->registro()) {
                    $responsableEncontrado = new Responsable(
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['tipoDocumento'],
                        $fila['numeroDocumento'],
                        $fila['telefono'],
                        $fila['numeroEmpleado'],
                        $fila['legajo']
                    );
                    // $responsableEncontrado->setNumeroEmpleado($numeroEmpleado);
                }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }

        return $responsableEncontrado;
    }

    /**
     * Función para listar toda la tabla Responsable
     * 
     * @param string $condicion
     * @return array
    */
    // Funcion pre-validada ✅
    public static function listar($condicion = ""){
        $arrayResponsable = [];
        $dataBase = new DataBase();
        // $consulta = "SELECT * FROM responsable";
        $consulta = $consulta = "SELECT p.*, r.numeroEmpleado, r.legajo 
                                FROM persona p 
                                JOIN responsable r 
                                ON p.tipoDocumento = r.tipoDocumento 
                                AND p.numeroDocumento = r.numeroDocumento";

        if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY r.numeroEmpleado";

        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                // Mientras $fila tenga valor el if se ejecuta
                while ($fila = $dataBase->registro()) {
                    $objResponsable = new Responsable(
                        $fila['nombre'],
                        $fila['apellido'],
                        $fila['tipoDocumento'],
                        $fila['numeroDocumento'],
                        $fila['telefono'],
                        $fila['numeroEmpleado'],
                        $fila['legajo']
                    );
                    //$objResponsable->setNumeroEmpleado($fila['numeroEmpleado']);
                    $arrayResponsable[] = $objResponsable;
                }
            } else {
                throw new Exception($dataBase->getError());
            }
        } else {
            throw new Exception($dataBase->getError());
        }
        return $arrayResponsable;
    }

    /**
     * Función para insertar registro de Responsable.
     * Retorna true en caso de éxito
     * 
     * @return bool
    */
    // Funcion pre-validada ✅
    public function insertar(): bool{
        $dataBase = new DataBase();
        $respuesta = false;
        // $consulta =
        //     "INSERT INTO responsable(numeroEmpleado,legajo)
        //     VALUES (".$this->getNumeroEmpleado().",'".$this->getLegajo()."','".$this->getApellido()."');"
        // ;
        $consulta = "INSERT INTO responsable(tipoDocumento, numeroDocumento, numeroEmpleado, legajo)
                    VALUES (
                            '" . parent::getTipoDocumento() . "',
                            '" . parent::getNumeroDocumento() . "',
                            '" . $this->getNumeroEmpleado() . "',
                            '" . $this->getLegajo() . "'
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

    /**
     * Función para modificar datos de Responsable.
     * Retorna true en caso de éxito
     * 
     * @return bool
    */
    // Funcion pre-validada ✅
    public function modificar() {
        $respuesta = false;
        $dataBase = new DataBase();
        // $consulta =
        //     "UPDATE responsable SET 
        //                             numeroLicencia = '". $this->getNumeroLicencia() . "',
        //                             nombre = '" . $this->getNombre() . "',
        //     apellido = '" . $this->getApellido() . "'
        //     WHERE numeroEmpleado = " . $this->getNumeroEmpleado() . ";"
        // ;
        $consulta = "UPDATE responsable SET 
                                        numeroEmpleado='" . $this->getNumeroEmpleado() . "',
                                        legajo='" . $this->getLegajo() . "' 
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

    /**
     * Función para eliminar registro de Responsable.
     * Retorna true en caso de éxito
     * 
     * @return bool
    */
    // Funcion pre-validada ✅
    public function eliminar() {
        $respuesta = false;
        $dataBase = new DataBase();
        if($dataBase->iniciar()) {
            // $consulta =
            // "DELETE FROM responsable
            // WHERE numeroEmpleado = " . $this->getNumeroEmpleado() . ";"
            // ;
            $consulta = "DELETE FROM responsable 
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