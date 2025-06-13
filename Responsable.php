<?php
/// Clase Responsable
Class Responsable {
    /// Atributos
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombre;
    private $apellido;

    /// Constructor
    public function __construct($numeroEmpleado, $numeroLicencia, $nombre, $apellido) {
        $this->numeroEmpleado = $numeroEmpleado;
        $this->numeroLicencia = $numeroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    /// Metodos de acceso / Getters
    public function getNumeroEmpleado() {
        return $this->numeroEmpleado;
    }

    public function getNumeroLicencia() {
        return $this->numeroLicencia;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    /// Metodos de modificacion / Setters
    public function setNumeroEmpleado($numeroEmpleado) {
        $this->numeroEmpleado = $numeroEmpleado;
    }

    public function setNumeroLicencia($numeroLicencia) {
        $this->numeroLicencia = $numeroLicencia;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    /// Metodo __toString
    public function __toString() {
        $cadena = ("Numero Empleado: " . $this->getNumeroEmpleado() . 
                    "\nNumero Licencia: " . $this->getNumeroLicencia() . 
                    "\nNombre: " . $this->getNombre() . 
                    "\nApellido: " . $this->getApellido());
        return $cadena;
    }
}
?>