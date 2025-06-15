<?php
// Clase viaje
class Viaje{
    // Atributo estático
    private static int $idViajeStatic = 0;

    // Atributo de instancia 
    private int $idViaje;
    private string $destino;
    private int $cantMaxPasajeros;
    private Empresa $empresa;
    private Responsable $responsable;
    private float $importe;

    // Constructor
    public function __construct(
        string $destino,
        int $cantMaxPasajeros,
        Empresa $empresa,
        Responsable $responsable,
        float $importe
    ){
        self::$idViajeStatic++;// Incremento automático del código
        $this->idViaje = self::$idViajeStatic;
        $this->destino = $destino;
        $this->cantMaxPasajeros = $cantMaxPasajeros;
        $this->empresa = $empresa;
        $this->responsable = $responsable;
        $this->importe = $importe;
    }

    // GETTERS
    public function getIdViaje(): int{
        return $this->idViaje;
    }

    public function getDestino(): string{
        return $this->destino;
    }

    public function getCantMaxPasajeros(): int{
        return $this->cantMaxPasajeros;
    }

    public function getEmpresa(): Empresa{
        return $this->empresa;
    }

    public function getResponsable(): Responsable{
        return $this->responsable;
    }

    public function getImporte(): float{
        return $this->importe;
    }

    // SETTERS

    public function setDestino(string $destino): void {
        $this->destino = $destino;
    }

    public function setCantMaxPasajeros(int $cantMaxPasajeros): void {
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }

    public function setEmpresa(Empresa $empresa): void {
        $this->empresa = $empresa;
    }

    public function setResponsable(Responsable $responsable): void {
        $this->responsable = $responsable;
    }

    public function setImporte(float $importe): void {
        $this->importe = $importe;
    }

    // __TOSTRING
    public function __toString(): string{
        $numViaje = $this->getIdViaje();
        $destino = $this->getDestino();
        $cantMaxPasajeros = $this->getCantMaxPasajeros();
        $empresa = $this->getEmpresa();
        $responsable = $this->getResponsable();
        $importe = $this->getImporte();

        return
            "------- RESPONSABLE -------".
            "$responsable\n".
            "Número viaje: $numViaje\n".
            "Destino: $destino\n".
            "Cantidad máxima de pasajeros: $cantMaxPasajeros\n".
            "---------- EMPRESA ----------".
            "$empresa\n".
            "Importe: $$importe";
        ;
    }

}
?>