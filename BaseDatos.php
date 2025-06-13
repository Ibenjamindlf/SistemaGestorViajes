<?php
// clase BaseDatos
class BaseDatos{
    private $HOSTNAME;
    private $BASEDATOS;
    private $USUARIO;
    private $CLAVE;
    private $CONEXION;
    private $QUERY;
    private $RESULT;
    private $ERROR;

    /**
     * Constructor que inicia las variables instancias de la clase
     * vinculadas a la coneccion con el Servidor de BD
    */
    public function __construct(){
        $this->HOSTNAME = "localhost";
        $this->BASEDATOS = "bdviajes";
        $this->USUARIO = "root";
        $this->CLAVE = "";
        $this->CONEXION = null;
        $this->QUERY = "";
        $this->RESULT = null;
        $this->ERROR = "";
    }

    // GETTERS
    private function getHostname() {
        return $this->HOSTNAME;
    }

    private function getBasedatos() {
        return $this->BASEDATOS;
    }

    private function getUsuario() {
        return $this->USUARIO;
    }

    private function getClave() {
        return $this->CLAVE;
    }

    private function getConexion() {
        return $this->CONEXION;
    }

    private function getQuery() {
        return $this->QUERY;
    }

    public function getResult() {
        return $this->RESULT;
    }

    public function getError() {
        return $this->ERROR;
    }

    // SETTERS
    private function setHostname($hostname) {
        $this->HOSTNAME = $hostname;
    }

    private function setBaseDatos($baseDatos) {
        $this->BASEDATOS = $baseDatos;
    }

    private function setUsuario($usuario) {
        $this->USUARIO = $usuario;
    }

    private function setClave($clave) {
        $this->CLAVE = $clave;
    }

    private function setConexion($conexion) {
        $this->CONEXION = $conexion;
    }

    private function setQuery($query) {
        $this->QUERY = $query;
    }

    private function setResult($result) {
        $this->RESULT = $result;
    }

    private function setError($error) {
        $this->ERROR = $error;
    }

    // FUNCIONES

    /**
     * Inicia la coneccion con el Servidor y la  Base Datos Mysql.
     * Retorna true si la coneccion con el servidor se pudo establecer y false en caso contrario.
     *
     * @return boolean
    */
    public  function conectar(){
        $exito  = false;

        $conexion = mysqli_connect(
            $this->getHostname(),
            $this->getUsuario(),
            $this->getClave(),
            $this->getBasedatos()
        );

        if ($conexion){
            $this->setConexion($conexion);
            $this->setQuery('');
            $this->setError('');

            $exito = true;
        }else{
            $this->setError(mysqli_connect_errno() . ": " . mysqli_connect_error());
        }

        return $exito;
    }

    /**
     * Ejecuta una consulta en la Base de Datos.
     * Recibe la consulta en una cadena enviada por parametro.
     *
     * @param string $consulta
     * @return boolean
    */
    public function consultar($consulta){
        $exito = false;

        $this->setQuery($consulta);
        $conexion = $this->getConexion();

        if($conexion){
            $resultado = mysqli_query($conexion, $consulta);

            if($resultado){
                $this->setResult($resultado);
                $exito = true;
            }else{
                $this->setError(mysqli_errno($conexion).": ". mysqli_error($conexion));
            }
        }else{
            $this->setError("Fallo en la conexión a la base de datos.");
        }

        return $exito;
    }

    /**
     * Devuelve el resultado de ejecutar una consulta.
     * El puntero se desplaza al siguiente registro de la consulta.
     *
     * @return array|null
    */
    public function obtenerFila() {
        $registro = null;
        $conexion = $this->getConexion();
        
        if($conexion){
            
            $resultado = $this->getResult();
            if ($resultado instanceof mysqli_result){

                $fila = mysqli_fetch_assoc($resultado);
                if($fila){
                    $registro = $fila;
                }else{
                    mysqli_free_result($resultado);
                    $this->setResult(null);
                }

            }else{
                $this->setError("Tipo de resultado inválido o vacío.");
            }

        }else{
            $this->setError("Fallo en la conexión a la base de datos.");
        }

        return $registro ;
    }

    /**
     * Devuelve el id de un campo autoincrement utilizado como clave de una tabla.
     * Retorna el id numerico del registro insertado, devuelve null en caso que la ejecucion de la consulta falle.
     *
     * @param string $consulta
     * @return int id de la tupla insertada
    */
    public function devuelveIDInsercion($consulta){
        $id = null;
        $conexion = $this->getConexion();
        
        $this->setQuery($consulta);

        if($conexion){
            $resultado = mysqli_query($conexion, $consulta);

            if($resultado){
                $this->setResult($resultado);
                $id = mysqli_insert_id($conexion);
            }else{
                $this->setError(mysqli_errno($conexion).": ". mysqli_error($conexion));
            }
        }else{
            $this->setError("Fallo en la conexión a la base de datos.");
        }

        return $id;
    }

    /**
     * Finaliza la conexion con el Servidor y la  Base Datos Mysql.
     * 
     * @return void
    */
    public function cerrarConexion() {
        $resultado = $this->getResult();
        $conexion = $this->getConexion();

        if ($resultado instanceof mysqli_result) {
            mysqli_free_result($this->RESULT);
            $this->setResult(null);
        }

        if ($conexion instanceof mysqli) {
            mysqli_close($this->CONEXION);
            $this->setConexion(null);
        }
    }

}
?>