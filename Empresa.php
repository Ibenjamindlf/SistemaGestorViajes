<?php
include_once 'BaseDatos.php';

class Empresa{
    // Atributos de instancia
    private int $idEmpresa = 0;
    private string $nombre;
    private string $direccion;

    // Constructor
    public function __construct(
        string $nombre,
        string $direccion
    ){
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
    private function setIdEmpresa(int $idEmpresa): void{
        $this->idEmpresa = $idEmpresa;
    }

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

    // 5 funciones (buscar,listar,insertar,modificar,eliminar) -> phpMyAdmin
    
    /**
     * Función para buscar empresa segun idEmpresa.
     * Retorna true si la encuentra, falso caso contrario.
     * 
     * @param int idEmpresa
     * @return Empresa||null
    */
    public static function buscar(int $idEmpresa): ?Empresa{
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM empresa WHERE idEmpresa = '" . $idEmpresa . "'";
        $empresaEncontrada = null;

        if($dataBase->iniciar()) {
            if($dataBase->ejecutar($consulta)){
                // Mientras $fila tenga valor el if se ejecuta
                if ($fila = $dataBase->registro()) {

                    $empresaEncontrada = new Empresa(
                        $fila['nombre'],
                        $fila['direccion']
                    );

                    $empresaEncontrada->setIdEmpresa($idEmpresa);
                }
            }else{
                throw new Exception ($dataBase->getError());
            }
        }else{
            throw new Exception ($dataBase->getError());
        }

        return $empresaEncontrada;
    }

    /**
     * Función para listar toda la tabla Empresa
     * 
     * @param string $condicion
     * @return array
    */
    public static function listar(string $condicion = ""): array{
        $arrayEmpresa = [];
        $dataBase = new DataBase();
        $consulta = "SELECT * FROM empresa";

        if($condicion != ""){
            $consulta .= " WHERE " . $condicion;
        }
        $consulta .= " ORDER BY nombre";

        if($dataBase->iniciar()) {
            if($dataBase->ejecutar($consulta)){
                // Mientras $fila tenga valor el if se ejecuta
                while ($fila = $dataBase->registro()) {
                    $objEmpresa = new Empresa(
                        $fila['nombre'],
                        $fila['direccion']
                    );
                    $objEmpresa->setIdEmpresa($fila['idEmpresa']);

                    $arrayEmpresa[] = $objEmpresa;
                }
            }else{
                throw new Exception ($dataBase->getError());
            }
        }else{
            throw new Exception ($dataBase->getError());
        }

        return $arrayEmpresa;
    }

    /**
     * Función para insertar registro de Empresa.
     * Retorna true en caso de éxito
     * 
     * @return bool
    */
    public function insertar(): bool{
        $dataBase = new DataBase();
        $respuesta = false;
        $consulta =
            "INSERT INTO empresa(nombre, direccion)
            VALUES ('".$this->getNombre()."', '".$this->getDireccion()."');"
        ;

        if($dataBase->iniciar()) {
            $idInsertado = $dataBase->devuelveIDInsercion($consulta);
            
            if($idInsertado !== null){
                $this->setIdEmpresa($idInsertado);
                $respuesta = true;
            }else{
                throw new Exception ($dataBase->getError()); 
            }
        }else{
            throw new Exception ($dataBase->getError());
        }

        return $respuesta;
    }

    /**
     * Función para modificar datos de Empresa.
     * Retorna true en caso de éxito
     * 
     * @return bool
    */
    public function modificar(): bool{
        $respuesta = false;
        $dataBase = new DataBase();
        $consulta =
            "UPDATE empresa 
            SET nombre = '".$this->getNombre()."',
            direccion = '".$this->getDireccion()."'
            WHERE idEmpresa = ".$this->getIdEmpresa().";"
        ;

        if($dataBase->iniciar()) {
            if($dataBase->ejecutar($consulta)){
                $respuesta = true;
            }else{
                throw new Exception ($dataBase->getError()); 
            }
        }else{
            throw new Exception ($dataBase->getError());
        }

        return $respuesta;
    }

    /**
     * Función para eliminar registro de Empresa.
     * Retorna true en caso de éxito
     * 
     * @return bool
    */
    public function eliminar(): bool{
        $respuesta = false;
        $dataBase = new DataBase();

        if($dataBase->iniciar()) {
            $consulta = 
                "DELETE FROM empresa
                WHERE idEmpresa = ".$this->getIdEmpresa().";"
            ;

            if($dataBase->ejecutar($consulta)){
                $respuesta = true;
            }else{
                throw new Exception ($dataBase->getError()); 
            }
        }else{
            throw new Exception($dataBase->getError());
        }

        return $respuesta;
    }
}
?>