<?php
// Responsable.php inicio
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
    // Realizar las 5 funciones (buscar,listar,insertar,modificar,eliminar) -> SQL phpMyAdmin
}
?>