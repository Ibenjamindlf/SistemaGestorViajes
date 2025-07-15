<?php
// include_once 'BaseDatos.php';

class Viaje {
        // Atributos de instancia 
        private int $idViaje = 0;
        private string $destino;
        private int $cantMaxPasajeros;
        private $empresa;
        private float $importe;
        private $responsable;
        private $colPasajeros;

        // Constructor
        public function __construct (
            $destino,
            $cantMaxPasajeros,
            $empresa,
            $importe,
            $responsable
        ){
            $this -> destino = $destino;
            $this -> cantMaxPasajeros = $cantMaxPasajeros;
            $this -> empresa = $empresa;
            $this -> importe = $importe;
            $this-> responsable = $responsable;
        }

    // Getters
    public function getIdViaje() {
        return $this->idViaje;
    }
    public function getDestino() {
        return $this->destino;
    }
    public function getCantMaxPasajeros() {
        return $this->cantMaxPasajeros;
    }
    public function getEmpresa() {
        return $this->empresa;
    }
    public function getImporte() {
        return $this->importe;
    }
    public function getResponsable() {
        return $this->responsable;
    }
    // Setters
    public function setIdViaje($idViaje) {
        $this->idViaje = $idViaje;
    }
    public function setDestino($destino) {
        $this->destino = $destino;
    }
    public function setCantMaxPasajeros($cantMaxPasajeros) {
        $this->cantMaxPasajeros = $cantMaxPasajeros;
    }
    public function setEmpresa($empresa) {
        $this->empresa = $empresa;
    }
    public function setImporte($importe) {
        $this->importe = $importe;
    }
    public function setResponsable($responsable) {
        $this->responsable = $responsable;
    }
        // Metodo __toString
        public function __toString () {
            $idViaje = $this -> getIdViaje ();
            $destino = $this -> getDestino ();
            $cantMaxPasajeros = $this -> getCantMaxPasajeros ();
            $empresa = $this->getEmpresa();
            $importe = $this->getImporte ();
            $responsable = $this->getResponsable();

            $cadena = "idViaje: $idViaje \n";
            $cadena .= "Destino: $destino \n";
            $cadena .= "Importe: $importe USD\n";
            $cadena .= "Cantidad Maxima de pasajeros: $cantMaxPasajeros \n";
            $cadena .= "---------------------------------\n";
            $cadena .= "Empresa que realiza el viaje: \n$empresa";
            $cadena .= "---------------------------------\n";
            $cadena .= "Responsable a cargo: \n$responsable";
            return $cadena;
        }

        // 5 funciones (buscar,listar,insertar,modificar,eliminar) -> SQL phpMyAdmin

    /**
     * Función para buscar un viaje según su id.
     * Retorna un objeto Viaje si lo encuentra, o null en caso contrario.
     */
    // Funcion validada ✅
    public static function buscar(int $idViaje): ?Viaje {
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM Viaje WHERE idViaje = $idViaje";
        $viajeEncontrado = null;

        if ($dataBase->iniciar() && $dataBase->ejecutar($consulta)) {
            if ($fila = $dataBase->registro()) {
                $empresa = Empresa::buscar($fila['idEmpresa']);
                if ($empresa === null) {
                    throw new Exception("Empresa no encontrada con ID: " . $fila['idEmpresa']);
                }
                $responsable = Responsable::buscar($fila['tipoDocumentoResponsable'], $fila['numeroDocumentoResponsable']);
                if ($responsable === null) {
                    throw new Exception("Responsable no encontrado con documento: " . $fila['tipoDocumentoResponsable'] . " " . $fila['numeroDocumentoResponsable']);
                }
                $viajeEncontrado = new Viaje(
                    $fila['destino'],
                    $fila['cantMaxPasajeros'],
                    $empresa,
                    $fila['importe'],
                    $responsable,
                );
                $viajeEncontrado->setIdViaje($idViaje);
            }
        } else {
            throw new Exception($dataBase->getError());
        }

        return $viajeEncontrado;
    }


        /**
         * Función para listar toda la tabla Viaje
         * 
         * @param string $condicion
         * @return array
        */
        // Funcion en pre-validada ✅
        public static function listar ($condicion = ""): array{
            $arrayViaje = [];
            $dataBase = new DataBase ();
            $consulta = "SELECT * FROM viaje";

            if ($condicion != "") {
                $consulta .= " WHERE " . $condicion;
            }
            $consulta .= " ORDER BY idViaje";

            if ($dataBase -> iniciar ()) {
                if ($dataBase -> ejecutar ($consulta)) {
                    // Mientras $fila tenga valor el if se ejecuta
                    while ($fila = $dataBase -> registro ()) {
                        $empresa = Empresa::buscar($fila['idEmpresa']);
                        if ($empresa === null) {
                            throw new Exception("Empresa no encontrada con ID: " . $fila['idEmpresa']);
                        }
                        $responsable = Responsable::buscar($fila['tipoDocumentoResponsable'], $fila['numeroDocumentoResponsable']);
                        if ($responsable === null) {
                            throw new Exception("Responsable no encontrado con documento: " . $fila['tipoDocumentoResponsable'] . " " . $fila['numeroDocumentoResponsable']);
                        }
                        $objViaje = new Viaje(
                        $fila['destino'],
                        $fila['cantMaxPasajeros'],
                        $empresa,
                        $fila['importe'],
                        $responsable,
                    );
                    $objViaje->setIdViaje($fila['idViaje']);

                        $arrayViaje[] = $objViaje;
                    }
                }
                else {
                    throw new Exception ($dataBase->getError());   
                }
            }
            else {
                throw new Exception ($dataBase->getError());
            }
            return $arrayViaje;
        }

        /**
         * Función para insertar registro de Viaje.
         * Retorna true en caso de éxito
         * 
         * @return bool
        */
        // Funcion Validada ✅
        public function insertar(): bool{
            $dataBase = new DataBase ();
            $respuesta = false;
            $consulta = "INSERT INTO viaje (
                                    destino, 
                                    cantMaxPasajeros, 
                                    idEmpresa, 
                                    tipoDocumentoResponsable, 
                                    numeroDocumentoResponsable, 
                                    importe
                        ) VALUES (
                                    '" . $this->getDestino() . "',
                                    " . $this->getCantMaxPasajeros() . ",
                                    " . $this->getEmpresa()->getIdEmpresa() . ",
                                    '" . $this->getResponsable()->getTipoDocumento() . "',
                                    " . $this->getResponsable()->getNumeroDocumento() . ",
                                    " . $this->getImporte() . "
                                );";
            if ($dataBase -> iniciar ()) {
                $idInsertado = $dataBase->devuelveIDInsercion($consulta);
                if ($idInsertado !== null) {
                    $this->setIdViaje($idInsertado);
                    $respuesta = true;
                }
                else {
                    throw new Exception ($dataBase->getError());
                }
            }
            else {
                throw new Exception ($dataBase->getError());
            }
            
            return $respuesta;
        }

        /**
         * Función para modificar datos de Responsable.
         * Retorna true en caso de éxito
         * 
         * @return bool
        */
        // Funcion en revision ⏳
        public function modificar () {
            $respuesta = false;
            $dataBase = new DataBase ();
            $idEmpresa = $this->getEmpresa()->getIdEmpresa();
            $tipoDocResponsable = $this->getResponsable()->getTipoDocumento();
            $numeroDocResponsable = $this->getResponsable()->getNumeroDocumento();
            $consulta =
                "UPDATE viaje 
                SET destino = '" . $this -> getDestino () . "',
                cantMaxPasajeros = " . $this -> getCantMaxPasajeros () . ",
                idEmpresa = " . $idEmpresa .",
                tipoDocumentoResponsable = '" . $tipoDocResponsable . "',
                numeroDocumentoResponsable = " . $numeroDocResponsable . ",
                importe = " . $this -> getImporte () . "
                WHERE idViaje = " . $this -> getIdViaje () . ";"
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
        // Funcion en revision ⏳
        public function eliminar () {
            $respuesta = false;
            $dataBase = new DataBase ();

            if ($dataBase -> iniciar ()) {
                $consulta =
                    "DELETE FROM viaje
                    WHERE idViaje = " . $this->getIdViaje() . ";"
                ;

                if ($dataBase -> ejecutar ($consulta)) {
                    $respuesta = true;
                }
                else {
                    throw new Exception ($dataBase->getError());
                }
            }
            else {
                throw new Exception ($dataBase->getError());
            }
            return $respuesta;
        }
    }
?>