<?php
// Clase Responsable
Class Responsable {
    // Atributo estático
    private static int $numeroEmpleadoStatic = 0;

    // Atributos
    private int $numeroEmpleado;
    private int $numeroLicencia;
    private string $nombre;
    private string $apellido;

    /// Constructor
    public function __construct(
        int $numeroLicencia,
        string $nombre,
        string $apellido
    ){
        self::$numeroEmpleadoStatic++;
        $this->numeroEmpleado = self::$numeroEmpleadoStatic;
        $this->numeroLicencia = $numeroLicencia;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
    }

    // GETTERS
    public function getNumeroEmpleado(): int{
        return $this->numeroEmpleado;
    }

    public function getNumeroLicencia(): int{
        return $this->numeroLicencia;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getApellido(): string{
        return $this->apellido;
    }

    // SETTERS
    public function setNumeroLicencia(int $numeroLicencia): void{
        $this->numeroLicencia = $numeroLicencia;
    }

    public function setNombre(string $nombre): void{
        $this->nombre = $nombre;
    }

    public function setApellido(string $apellido): void{
        $this->apellido = $apellido;
    }

    /// Metodo __toString
    public function __toString(): string{
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
}
?>