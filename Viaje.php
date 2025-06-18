<?php
include_once 'BaseDatos.php';

    class Viaje {
        // Atributos de instancia 
        private int $idViaje = 0;
        private string $destino;
        private int $cantMaxPasajeros;
        private int $idEmpresa;
        private int $numResponsable;
        private float $importe;

        // Constructor
        public function __construct (
            string $destino,
            int $cantMaxPasajeros,
            int $idEmpresa,
            int $numResponsable,
            float $importe
        ){
            $this -> destino = $destino;
            $this -> cantMaxPasajeros = $cantMaxPasajeros;
            $this -> idEmpresa = $idEmpresa;
            $this -> numResponsable = $numResponsable;
            $this -> importe = $importe;
        }

        // GETTERS
        public function getIdViaje(): int{
            return $this -> idViaje;
        }

        public function getDestino(): string{
            return $this -> destino;
        }

        public function getCantMaxPasajeros(): int{
            return $this -> cantMaxPasajeros;
        }

        public function getIdEmpresa(): int{
            return $this -> idEmpresa;
        }

        public function getNumResponsable(): int{
            return $this -> numResponsable;
        }

        public function getImporte(): float{
            return $this -> importe;
        }

        // SETTERS
        public function setIdViaje(int $idViaje): void{
            $this->idViaje = $idViaje;
        }

        public function setDestino(string $destino): void{
            $this->destino = $destino;
        }

        public function setCantMaxPasajeros(int $cantMaxPasajeros): void{
            $this->cantMaxPasajeros = $cantMaxPasajeros;
        }

        public function setIdEmpresa(int $idEmpresa): void{
            $this->idEmpresa = $idEmpresa;
        }

        public function setNumResponsable(int $numResponsable): void{
            $this->numResponsable = $numResponsable;
        }

        public function setImporte(float $importe): void{
            $this->importe = $importe;
        }

        // Metodo __toString
        public function __toString () {
            $numViaje = $this -> getIdViaje ();
            $destino = $this -> getDestino ();
            $cantMaxPasajeros = $this -> getCantMaxPasajeros ();
            $idEmpresa = $this -> getIdEmpresa ();
            $numResponsable = $this -> getNumResponsable ();
            $importe = $this->getImporte ();

            return
                "------- RESPONSABLE -------".
                "$numResponsable\n".
                "Número viaje: $numViaje\n".
                "Destino: $destino\n".
                "Cantidad máxima de pasajeros: $cantMaxPasajeros\n".
                "---------- EMPRESA ----------".
                "$idEmpresa\n".
                "Importe: $$importe";
            ;
        }

        // 5 funciones (buscar,listar,insertar,modificar,eliminar) -> SQL phpMyAdmin

        /**
         * Función para buscar viaje segun idViaje.
         * Retorna true si la encuentra, falso caso contrario.
         * 
         * @param int numeroEmpleadp
         * @return Viaje||null
        */
        public static function buscar (int $idViaje): ?Viaje {
            $dataBase = new DataBase ();
            $consulta = "SELECT * FROM Viaje WHERE idViaje = '" . $idViaje . "'";
            $viajeEncontrado = null;

            if ($dataBase -> iniciar ()) {
                if ($dataBase -> ejecutar ($consulta)) {
                    // Mientras $fila tenga valor el if se ejecuta
                    if ($fila = $dataBase -> registro ()) {
                        
                        $viajeEncontrado = new Viaje(
                            $fila['destino'],
                            $fila['cantMaxPasajeros'],
                            $fila['idEmpresa'],
                            $fila['numeroEmpleado'],
                            $fila['importe']
                        );

                        $viajeEncontrado->setIdViaje($idViaje);
                    }
                }
                else {
                    throw new Exception ($dataBase->getError());
                }
            }
            else {
                throw new Exception ($dataBase->getError());
            }

            return $viajeEncontrado;
        }

        /**
         * Función para listar toda la tabla Viaje
         * 
         * @param string $condicion
         * @return array
        */
        public static function listar ($condicion = ""): array{
            $arrayViaje = [];
            $dataBase = new DataBase ();
            $consulta = "SELECT * FROM viaje";

            if ($condicion != "") {
                $consulta .= " WHERE " . $condicion;
            }
            $consulta .= " ORDER BY destino";

            if ($dataBase -> iniciar ()) {
                if ($dataBase -> ejecutar ($consulta)) {
                    // Mientras $fila tenga valor el if se ejecuta
                    while ($fila = $dataBase -> registro ()) {
                        $objViaje = new Viaje (
                            $fila["destino"],
                            $fila["cantMaxPasajeros"],
                            $fila["idEmpresa"],
                            $fila["numeroEmpleado"],
                            $fila["importe"]
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
        public function insertar(): bool{
            $dataBase = new DataBase ();
            $respuesta = false;
            $consulta =
                "INSERT INTO viaje(destino, cantMaxPasajeros, idEmpresa, numeroEmpleado, importe)
                VALUES ('" . $this -> getDestino () ."',". $this -> getCantMaxPasajeros () . "," . $this -> getIdEmpresa () . ", " . $this -> getNumResponsable () . ", " . $this -> getImporte () . ");"
            ;

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
        public function modificar () {
            $respuesta = false;
            $dataBase = new DataBase ();
            $consulta =
                "UPDATE viaje 
                SET destino = '" . $this -> getDestino () . "',
                cantMaxPasajeros = " . $this -> getCantMaxPasajeros () . ",
                idEmpresa = " . $this -> getIdEmpresa () .",
                numeroEmpleado = " . $this -> getNumResponsable () . ",
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