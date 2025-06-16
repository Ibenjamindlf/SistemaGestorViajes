<?php
// Empresa.php inicio
class Empresa{
    // Atributo estático
    private static int $idEmpresaStatic = 0;

    // Atributos de instacia
    private int $idEmpresa;
    private string $nombre;
    private string $direccion;

    // Constructor
    public function __construct(
        string $nombre,
        string $direccion
    ){
        self::$idEmpresaStatic++;// Incremento automático del código
        $this->idEmpresa = self::$idEmpresaStatic;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
    }

    // GETTERS
    public function getIdEmpresa(): int{
        return $this->idEmpresa;
    }

    public function getNombre(): string{
        return $this->nombre;
    }

    public function getDireccion(): string{
        return $this->direccion;
    }

    // SETTERS
    public function setNombre(string $nombre): void{
        $this->nombre = $nombre;
    }

    public function setDireccion(string $direccion): void{
        $this->direccion = $direccion;
    }

    // __TOSTRING
    public function __toString(): string{
        $numEmpresa = $this->getIdEmpresa();
        $nombre = $this->getNombre();
        $direccion = $this->getDireccion();

        return
        "Número empresa: $numEmpresa\n".
        "Nombre: $nombre\n".
        "Dirección: $direccion\n".
        "-----------------------------";
    }
}
?>