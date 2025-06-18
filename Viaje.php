<?php
    class Viaje {
        // Atributo estático
        private static $idViajeStatic = 0;

        // Atributo de instancia 
        private $idViaje;
        private $destino;
        private $cantMaxPasajeros;
        private $empresa;
        private $responsable;
        private $importe;

        // Constructor
        public function __construct ($destino, $cantMaxPasajeros, $empresa, $responsable, $importe) {
            self :: $idViajeStatic ++; // Incremento automático del ID
            $this -> idViaje = self :: $idViajeStatic;
            $this -> destino = $destino;
            $this -> cantMaxPasajeros = $cantMaxPasajeros;
            $this -> empresa = $empresa;
            $this -> responsable = $responsable;
            $this -> importe = $importe;
        }

        // Getters
        public function getIdViaje () {
            return $this -> idViaje;
        }

        public function getDestino () {
            return $this -> destino;
        }

        public function getCantMaxPasajeros () {
            return $this -> cantMaxPasajeros;
        }

        public function getEmpresa () {
            return $this -> empresa;
        }

        public function getResponsable () {
            return $this -> responsable;
        }

        public function getImporte() {
            return $this -> importe;
        }

        // Setters
        public function setDestino ($destino) {
            $this -> destino = $destino;
        }

        public function setCantMaxPasajeros ($cantMaxPasajeros) {
            $this -> cantMaxPasajeros = $cantMaxPasajeros;
        }

        public function setEmpresa ($empresa) {
            $this -> empresa = $empresa;
        }

        public function setResponsable ($responsable) {
            $this -> responsable = $responsable;
        }

        public function setImporte ($importe) {
            $this -> importe = $importe;
        }

        // A String
        public function __toString () {
            $numViaje = $this -> getIdViaje ();
            $destino = $this -> getDestino ();
            $cantMaxPasajeros = $this -> getCantMaxPasajeros ();
            $empresa = $this -> getEmpresa ();
            $responsable = $this -> getResponsable ();
            $importe = $this->getImporte ();

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

        // Propias de la clase

        /**
         * Funcion en revisión ❔
         * Buscar un viaje por su ID en la base de datos
         * @param int identificadorViaje
         * @return boolean
         */
        public function buscar ($identificadorViaje) {
            $dataBase = new DataBase ();
            $consulta = "SELECT * FROM Viaje WHERE idViaje = '" . $identificadorViaje . "'";
            $respuesta = false;

            if ($dataBase -> iniciar ()) {
                if ($dataBase -> ejecutar ($consulta)) {
                    if ($fila = $dataBase -> registro ()) {
                        $this -> setDestino ($fila["destino"]);
                        $this -> setCantMaxPasajeros ($fila["cantMaxPasajeros"]);
                        $this -> setEmpresa ($fila["idEmpresa"]);
                        $this -> setResponsable ($fila["numeroEmpleado"]);
                        $this -> setImporte ($fila["importe"]);
                        $respuesta = true;
                    }
                }
                else {
                    throw new Exception ("Error: la consulta no se pudo ejecutar");
                }
            }
            else {
                throw new Exception ("Error: la base de datos no se pudo iniciar");
            }
            return $respuesta;
        }

        /**
         * Funcion en revisión ❔
         * Listar toda la tabla Viaje
         * @return array|null
         */
        public function listar ($condicion = "") {
            $coleccionViajes = null;
            $dataBase = new DataBase ();
            $consulta = "SELECT * FROM Viaje";

            if ($condicion != "") {
                $consulta .= " WHERE " . $condicion;
            }
            $consulta .= " ORDER BY destino";

            if ($dataBase -> iniciar ()) {
                if ($dataBase -> ejecutar ($consulta)) {
                    $coleccionViajes = [];
                    while ($row = $dataBase -> registro ()) {
                        $objViaje = new Viaje (
                            $row["destino"],
                            $row["cantMaxPasajeros"],
                            $row["idEmpresa"],
                            $row["numeroEmpleado"],
                            $row["importe"]
                        );
                        $coleccionViajes [] = $objViaje;
                    }
                }
                else {
                    throw new Exception ("Error: la consulta no se pudo ejecutar");   
                }
            }
            else {
                throw new Exception ("Error: la base de datos no se pudo iniciar");
            }
            return $coleccionViajes;
        }

        /**
         * Funcion en revisión ❔
         * Permite insertar un nuevo viaje a la tabla
         * @return boolean
         */
        public function insertar () {
            $dataBase = new DataBase ();
            $respuesta = false;
            $consulta = "INSERT INTO Viaje(destino, cantMaxPasajeros, idEmpresa, numeroEmpleado, importe)
                VALUES ('" . $this -> getDestino () ."','". $this -> getCantMaxPasajeros () . "','" . $this -> getEmpresa () . "','" . $this -> getResponsable () . "','".$this -> getImporte () . "')";
            if ($dataBase -> iniciar ()) {
                if ($dataBase -> ejecutar ($consulta)) {
                    $respuesta = true;
                }
                else {
                    throw new Exception ("Error: la consulta no se pudo ejecutar");
                }
            }
            else {
                throw new Exception ("Error: la base de datos no se pudo iniciar");
            }
            return $respuesta;
        }

        /**
         * Funcion en revisión ❔
         * Modificar los datos de un viaje
         * @return boolean
         */
        public function modificar () {
            $respuesta = false;
            $dataBase = new DataBase ();
            $consulta = "UPDATE Viaje SET destino = '" . $this -> getDestino () .
                                            "',cantMaxPasajeros = '" . $this -> getCantMaxPasajeros () .
                                            "',idEmpresa = '" . $this -> getEmpresa () .
                                            "',numeroEmpleado = '" . $this -> getResponsable () .
                                            "',importe = '" . $this -> getImporte () .
                                            "' WHERE idViaje = " . $this -> getIdViaje () . ";";
        }

        /**
         * Funcion en revisión ❔
         * Permite eliminar un viaje
         * @return boolean
         */
        public function eliminar () {
            $respuesta = false;
            $dataBase = new DataBase ();
            if ($dataBase -> iniciar ()) {
                $consulta = "DELETE FROM Viaje WHERE idViaje = " . $this -> getIdViaje ();
                if ($dataBase -> ejecutar ($consulta)) {
                    $respuesta = true;
                }
                else {
                    throw new Exception ("Error: la consulta no se pudo ejecutar");
                }
            }
            else {
                throw new Exception ("Error: la base de datos no se pudo iniciar");
            }
            return $respuesta;
        }
    }
?>