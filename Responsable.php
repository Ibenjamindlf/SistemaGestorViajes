<?php
include_once 'BaseDatos.php';

Class Responsable {
    // Atributos de instancia
    private int $numeroEmpleado = 0;
    private int $numeroLicencia;
    private string $nombre;
    private string $apellido;

    /// Constructor
    public function __construct(
        int $numeroLicencia,
        string $nombre,
        string $apellido
    ){
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
    public function setNumeroEmpleado(int $numeroEmpleado): void{
        $this->numeroEmpleado = $numeroEmpleado;
    }

    public function setNumeroLicencia(int $numeroLicencia): void{
        $this->numeroLicencia = $numeroLicencia;
    }

    public function setNombre(string $nombre): void{
        $this->nombre = $nombre;
    }

    public function setApellido(string $apellido): void{
        $this->apellido = $apellido;
    }

    // Metodo __toString
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

    /**
     * Función para buscar empleado segun numeroEmpleado.
     * Retorna true si la encuentra, falso caso contrario.
     * 
     * @param int numeroEmpleadp
     * @return Responsable||null
    */
    public static function buscar(int $numeroEmpleado): ?Responsable {
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM responsable WHERE numeroEmpleado = '". $numeroEmpleado . "'";
        $responsableEncontrado = null;

        if ($dataBase->iniciar()) {
            if($dataBase->ejecutar($consulta)) {
                // Mientras $fila tenga valor el if se ejecuta
                if($fila = $dataBase->registro()) {

                    $responsableEncontrado = new Responsable(
                        $fila['numeroLicencia'],
                        $fila['nombre'],
                        $fila['apellido']
                    );

                    $responsableEncontrado->setNumeroEmpleado($numeroEmpleado);
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
    public static function listar($condicion = ""): array{
        $arrayResponsable = [];
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM responsable";

        if ($condicion != "") {
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY nombre";

        if ($dataBase->iniciar()) {
            if ($dataBase->ejecutar($consulta)) {
                // Mientras $fila tenga valor el if se ejecuta
                while ($fila = $dataBase->registro()) {
                    $objResponsable = new Responsable(
                        $fila['numeroLicencia'],
                        $fila['nombre'],
                        $fila['apellido']
                    );
                    $objResponsable->setNumeroEmpleado($fila['numeroEmpleado']);

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
    public function insertar(): bool{
        $dataBase = new DataBase();
        $respuesta = false;
        $consulta =
            "INSERT INTO responsable(numeroLicencia, nombre, apellido)
            VALUES (".$this->getNumeroLicencia().",'".$this->getNombre()."','".$this->getApellido()."');"
        ;
        
        if ($dataBase->iniciar()) {
            $idInsertado = $dataBase->devuelveIDInsercion($consulta);

            if ($idInsertado !== null){
                $this->setNumeroEmpleado($idInsertado);
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
    public function modificar() {
        $respuesta = false;
        $dataBase = new DataBase();
        $consulta =
            "UPDATE responsable
            SET numeroLicencia = '". $this->getNumeroLicencia() . "',
            nombre = '" . $this->getNombre() . "',
            apellido = '" . $this->getApellido() . "'
            WHERE numeroEmpleado = " . $this->getNumeroEmpleado() . ";"
        ;

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
    public function eliminar() {
        $respuesta = false;
        $dataBase = new DataBase();

        if($dataBase->iniciar()) {
            $consulta =
            "DELETE FROM responsable
            WHERE numeroEmpleado = " . $this->getNumeroEmpleado() . ";"
            ;

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