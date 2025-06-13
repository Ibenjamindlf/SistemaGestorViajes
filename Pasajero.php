<?php
// De los pasajeros se conoce su nombre, apellido, número de documento y teléfono.
class Pasajero{
// Atributo de instancia 
    private int $numeroDocumento;
    private string $nombre;
    private string $apellido;
    private int $telefono;
    private Viaje $viaje;
// Zona de metodos
// Constructor
    public function __construct(
        int $numeroDocumento,
        string $nombre,
        string $apellido,
        int $telefono,
        Viaje $viaje
    ){
        $this->numeroDocumento = $numeroDocumento;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->viaje = $viaje;
    }
// Getters
    public function getNumeroDocumento(): int {
        return $this->numeroDocumento;
    }
    public function getNombre(): string {
        return $this->nombre;
    }
    public function getApellido(): string {
        return $this->apellido;
    }
    public function getTelefono(): int {
        return $this->telefono;
    }
    public function getViaje(): Viaje {
        return $this->viaje;
    }
// Setters
    public function setNumeroDocumento(int $numeroDocumento): void {
        $this->numeroDocumento = $numeroDocumento;
    }
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }
    public function setApellido(string $apellido): void {
        $this->apellido = $apellido;
    }
    public function setTelefono(int $telefono): void {
        $this->telefono = $telefono;
    }
    public function setViaje(Viaje $viaje): void {
        $this->viaje = $viaje;
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

}
?>