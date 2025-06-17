<?php
// Del responsable se conoce el numero de empleado, el numero de licencia, su nomre y su apellido
Class Responsable {
    // Atributo estático (id autoincrementado)
    private static int $numeroEmpleadoStatic = 0;
    // Atributos
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombre;
    private $apellido;
    /// Constructor
    public function __construct(
        $numeroLicencia,
        $nombre,
        $apellido
    ){
        self::$numeroEmpleadoStatic++;
        $this->numeroEmpleado = self::$numeroEmpleadoStatic;
        $this->numeroLicencia = $numeroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }
    // GETTERS
    public function getNumeroEmpleado(){
        return $this->numeroEmpleado;
    }

    public function getNumeroLicencia(){
        return $this->numeroLicencia;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }
    // SETTERS
    public function setNumeroLicencia($numeroLicencia){
        $this->numeroLicencia = $numeroLicencia;
    }

    public function setNombre($nombre){
        $this->nombre = $nombre;
    }

    public function setApellido($apellido){
        $this->apellido = $apellido;
    }

    /// Metodo __toString
    public function __toString(){
        $numeroEmpleado = $this->getNumeroEmpleado();
        $numeroLicencia = $this->getNumeroLicencia();
        $nombre = $this->getNombre();
        $apellido = $this->getApellido();
        return
            "Número empleado: $numeroEmpleado\n".
            "Número licencia: $numeroLicencia\n".
            "Nombre Responsable: $nombre $apellido\n".
            "-----------------------------";
        ;
    }
    // 5 funciones (buscar,listar,insertar,modificar,eliminar) -> SQL phpMyAdmin

    // Funcion para buscar un Responsable por su numero de empleado en la base de datos
    // Return true si se encontró al responsable, false si no
    public function buscar($numEmpleado) {
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM responsale WHERE numeroEmpleado = '". $numEmpleado . "'";
        $respuesta = false;

        if ($dataBase->iniciar()) {
            if($dataBase->ejecutar($consulta)) {
                // Mientras $fila tenga valor el if se ejecuta
                if($fila = $dataBase->registro()) {
                    $this->setNumeroLicencia($fila['numeroLicencia']);
                    $this->setNombre($fila['nombre']);
                    $this->setApellido($fila['apellido']);

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
    // Funcion para listar toda la tabla responsable
    // Return el arreglo con los responsables o null
    public static function listar($condicion = "") {
        $arrayResponsable = null;
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM responsable";

        if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY nombre";

        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                $arrayResponsable = [];

                while ($row = $dataBase->registro()) {
                    $objResponsable = new Responsable(
                        $row['numeroEmpleado'],
                        $row['numeroLicencia'],
                        $row['nombre'],
                        $row['apellido']
                    );
                    $arrayResponsable[] = $objResponsable;
                }
            } else {
                throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        } else {
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $arrayResponsable;
    }
    // Funcion para insertar un nuevo responsable
    // Return true si se logro insertar el responsable nuevo, si no false
    public function insertar() {
        $dataBase = new DataBase();
        $respuesta = false;
        $consulta = "INSERT INTO responsable(numeroEmpleado, numeroLIcencia, nombre, apellido)
                    VALUES ('".$this->getNumeroEmpleado()."','".$this->getNumeroLicencia()."','".$this->getNombre()."','".$this->getApellido()."')";
        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                        $respuesta = true;
            } else {
                        throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        } else {
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $respuesta;
    }
    // Funcion para modificar los datos de un responsable
    // Return
    public function modificar() {
        $respuesta = false;
        $dataBase = new DataBase();
        $consulta = "UPDATE responsable SET numeroLicencia='". $this->getNumeroLicencia() . 
                                            "',nombre='" . $this->getNombre() . 
                                            "',apellido=" . $this->getApellido() . 
                    "' WHERE numeroEmpleado='" . $this->getNumeroEmpleado() .";";
        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                $respuesta = true;
            } else {
                throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        } else {
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $respuesta;
    }
    // Funcion para eliminar un Pasajero
    // Return
    public function eliminar() {
        $respuesta = false;
        $dataBase = new DataBase();
        if($dataBase->iniciar()) {
            $consulta = "DELETE FROM responsable WHERE numeroEmpleado=" . $this->getNumeroEmpleado();
            if ($dataBase->ejecutar($consulta)) {
                $respuesta = true;
            } else {
                throw new Exception("Error: la consulta no se pudo ejecutar");
            }
        } else {
            throw new Exception("Error: la base de datos no se pudo iniciar");
        }
        return $respuesta;
    }
}
?>