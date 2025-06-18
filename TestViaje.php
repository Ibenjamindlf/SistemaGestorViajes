<?php
// TestViaje.php en desarrollo
include_once 'BaseDatos.php';
include_once 'Empresa.php';
include_once 'Pasajero.php';
include_once 'Responsable.php';
include_once 'Viaje.php';
include_once 'TestViaje.php';

function menuInteractivo(){
    $cadena = (
        "\nMENU\n" .
        "1- Ver Empresas\n" .
        "2- Ingresar Empresa\n" .
        "3- Modificar Empresa\n" .
        "4- Eliminar Empresa\n" .
        "5- Ver Responsables\n" .
        "6- Ingresar Responsable\n" .
        "7- Modificar Responsable\n" .
        "8- Eliminar Responsable\n" .
        "9- Ver Viajes\n" .
        "10- Ingresar Viaje\n" .
        "11- Modificar Viaje\n" .
        "12- Eliminar Viaje\n" .
        "13- Ver Pasajeros\n" .
        "14- Ingresar Pasajero\n" .
        "15- Modificar Pasajero\n" .
        "16- Eliminar Pasajero\n" .
        "Opción: "
    );
    return $cadena;
}

// Muestro el menú
echo menuInteractivo();

// Capturo la opción del usuario
$opcion = trim(fgets(STDIN));

// // Prueba
// echo "Elegiste la opción: $opcion\n";
switch ($opcion) {
    case 1:
        # code...
        break;
    case 2:
        # code...
        break;
    case 3:
        # code...
        break;
    case 4:
        # code...
        break;
// Ver Responsable 5
// Case en revisión ❔
    case 5:
        $colResponsables = mostrarResponsables();
        if (count($colResponsables) > 0) {
            foreach ($colResponsables as $unResponsable) {
                echo $unResponsable;
            }
        } else {
            echo "No se encontraron responsables.\n";
        }
    break;
// Ingresar Responsables 6
// Case en revisión ❔
    case 6: 
        echo "Ingrese el nomre del responsable: \n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido: \n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el numero de su licencia: \n";
        $numLicencia = trim(fgets(STDIN));
        $variable = ingresarResponsable($numLicencia,$nombre,$apellido);
        if ($variable) {
            echo ("Se ingreso el responsable con los siguientes datos: $nombre, $apellido, $numLicencia");
        } else {
            echo $variable;
        }
    break;
// Modificar Responsables 7
// Case en revisión ❔
    case 7: 
        echo "Ingrese el numero de empleado del responsable que desea modificar: \n";
        $numEmpleado = trim(fgets(STDIN));
        echo "Esta seguro de modificar el responsable con numero de empleado: $numEmpleado ? si/no";
        $respuesta = trim(fgets(STDIN));
        if (strtolower($respuesta) == "si") {
            echo "Ingrese el nuevo nombre: \n";
            $nuevoNombre = trim(fgets(STDIN));
            echo "Ingrese el nuevo apellido: \n";
            $nuevoApellido = trim(fgets(STDIN));
            echo "Ingrese el nuevo numero de licencia";
            $nuevoNumLicencia = trim(fgets(STDIN));
            $seModifico = modificarResponsable($numEmpleado, $nuevoNumLicencia, $nuevoNombre, $nuevoApellido);
            if ($seModifico) {
                echo "El responsable se modifico correctamente.";
            } else {
                echo ("No se encontro ningun responsable con numero de empleado: $numEmpleado");
            }
        }
    break;
// Eliminar Responsables 8
// Case en revisión ❔
    case 8:
        echo "Ingrese el numero de empleado del responsable que desea eliminar: \n";
        $numEmpleado = trim(fgets(STDIN));
        $seElimino = eliminarResponsable($numEmpleado);
        if ($seElimino) {
            echo "El responsable se elimino con exito.";
        } else {
            echo ("El responsable con numero de empleado: $numEmpleado no se encontro");
        }
    break;
// Ver Viajes 9
// Case en revisión ❔
    case 9:
        $colViajes = mostrarViajes ();
        if (count ($colViajes) > 0) {
            foreach ($colViajes as $unViaje){
                echo $unViaje;
            }
        } else {
            echo "No se encontraron pasajeros.\n";
        }
    break;
// Ingresar Viajes 10
// Case en revisión ❔
    case 10:
        echo "Ingrese el destino del viaje: \n";
        $destino = trim (fgets (STDIN));
        echo "Ingrese la cantidad máxima de pasajeros para el viaje: \n";
        $cantMaxPasajeros = trim (fgets (STDIN));
        echo "Ingrese el importe del viaje: \n";
        $importe = trim (fgets (STDIN));
        echo "Ingrese el ID de la empresa: \n";
        $idEmpresa = trim (fgets (STDIN));
        echo "Ingrese el número de empleado: \n";
        $numeroEmpleado = trim (fgets (STDIN));
        $resultado = ingresarViaje ($destino, $cantMaxPasajeros, $idEmpresa, $numeroEmpleado, $importe);
        if ($resultado){
            echo ("Se ingreso el viaje con los siguientes datos $destino, $cantMaxPasajeros, $importe a la empresa con el ID: $idEmpresa y a cargo del empleado con el número $numeroEmpleado");
        } else {
            echo ("No se encontró ningun viaje con dicho ID.");
        }
        echo $salida;
    break;
// Nodificar Viajes 11
// Case en revisión ❔
    case 11:
        echo "Ingrese el ID del viaje que quiere modificar: \n";
        $idViaje = trim (fgets (STDIN));
        echo "Esta seguro de modificar el viaje con ID: $numDoc ? si/no";
        $rta = trim (fgets (STDIN));
        if (strtolower ($rta) == "si") {
            echo "Ingrese el nuevo destino: \n";
            $nuevoDestino = trim (fgets (STDIN));
            echo "Ingrese la nueva cantidad máxima de pasajeros: \n";
            $nuevaCantMaxPasajeros = trim (fgets (STDIN));
            echo "Ingrese el ID de la empresa: \n";
            $nuevoIdEmpresa = trim (fgets (STDIN));
            echo "Ingrese el nuevo núemro de empleado: \n";
            $nuevoNumEmpleado = trim (fgets (STDIN));
            echo "Ingrese el nuevo importe del viaje: \n";
            $nuevoImporte = trim (fgets (STDIN));
            $seModifico = modificarViaje ($idViaje, $destino, $cantMaxPasajeros, $idEmpresa, $numeroEmpleado, $importe);
            if ($seModifico){
                echo ("El viaje se modifico correctamente.");
            } else {
                echo ("No se encontro ningun viaje con ID: $idViaje .");
            }
        }
    break;
// Eliminar Viajes 12
// Case en revisión ❔
    case 12:
        echo "Ingrese el ID del viaje que desea eliminar: \n";
        $idViaje = trim (fgets (STDIN));
        $seElimino = eliminarViaje ($idViaje);
        if ($seElimino){
            echo ("El viaje se elimino con exito");
        } else {
            echo ("El viaje con ID: $idViaje no se encontró");
        }
    break;
// Ver Pasajeros 13
    case 13:
        $colPasajeros = mostrarPasajeros();
        if (count($colPasajeros) > 0) {
            foreach ($colPasajeros as $unPasajero){
                echo $unPasajero;
            }
        } else {
            echo "No se encontraron pasajeros.\n";
        }
    break;
// Ingresar Pasajeros 14
    case 14:
        echo "Ingrese el nombre del pasajero: \n";
        $nombre=trim(fgets(STDIN));
        echo "Ingrese el apellido: \n";
        $apellido=trim(fgets(STDIN));
        echo "Ingrese el numero de documento: \n";
        $numDocumento=trim(fgets(STDIN));
        echo "Ingrese el numero de telefono: \n";
        $telefono=trim(fgets(STDIN));
        echo "Ingrese el ID del viaje: \n";
        $idViaje=trim(fgets(STDIN));
        $salida = ingresarPasajero($numDocumento,$nombre,$apellido,$telefono,$idViaje);
        if ($salida){
            echo ("Se ingreso el pasajero con los siguientes datos $numDocumento,$nombre,$apellido,$telefono al viaje con ID: $idViaje");
        } else {
            echo ("No se encontró ningun viaje con dicho ID.");
        }
        echo $salida;
    break;
// Modificar Pasajeros 15
    case 15:
        echo "Ingrese el numero de documento del pasajero que desea modificar: \n";
        $numDoc=trim(fgets(STDIN));
        echo "Esta seguro de modificar el pasajero con numero de documento: $numDoc ? si/no";
        $rta=trim(fgets(STDIN));
        if (strtolower($rta) == "si"){
            echo "Ingrese el nuevo nombre: \n";
            $nuevoNombre=trim(fgets(STDIN));
            echo "Ingrese el nuevo apellido: \n";
            $nuevoApellido=trim(fgets(STDIN));
            echo "Ingrese el nuevo telefono: \n";
            $nuevoTelefono=trim(fgets(STDIN));
            echo "Ingrese el ID del nuevo viaje: \n";
            $nuevoIdViaje=trim(fgets(STDIN));
            $seModifico = modificarPasajero($numDoc,$nuevoNombre,$nuevoApellido,$nuevoTelefono,$nuevoIdViaje);
            if ($seModifico){
                echo ("El pasajero se modifico correctamente.");
            } else {
                echo ("No se encontro ningun pasajero con numero de documento: $numDoc .");
            }
        }
    break;
// Eliminar Pasajeros 16
    case 16:
        echo "Ingrese el numero de documento del pasajero que desea eliminar: \n";
        $numDoc=trim(fgets(STDIN));
        $seElimino = eliminarPasajero($numDoc);
        if($seElimino){
            echo ("El pasajero se elimino con exito");
        } else {
            echo ("El pasajero con numero de documento: $numDoc no se encontro");
        }
    break;
// Si no ingresa un valor que este en los case's retorna: 
    default:
        echo"\nLa opcion ingresada es invalida.\n";
    break;
}

// // Codigo para iniciar y cerrar la database 👇🏻
// $bd = new DataBase();

// if ($bd->iniciar()) {
//     echo "✅ Conexión exitosa a la base de datos.\n";
//     // Cerramos conexión
//     $bd->cerrarConexion();
//     echo "🔒 Conexión cerrada correctamente.";
// } else {
//     echo "❌ Error al conectar a la base de datos: " . $bd->getError();
// }

//-----------------------------------------Responsable 👇🏻---------------------------------------------
// Funcion en revisión ❔
// Funcion que devuelve un array con los responsables listados
function mostrarResponsables() {
    $colResponsables = [];
    try {
        $responsables = Responsable::listar();
        foreach ($responsables as $responsable) {
            $colResponsables[] = $responsable;
        }
    } catch (Exception $e) {
        echo "Error al obtener los responsables: " . $e->getMessage() . "\n";
    }
    return $colResponsables;
}
// Funcion en revisión ❔
// Funcion para ingresar un responsable
// Return string
function ingresarResponsable($numLicencia,$nombre,$apellido) {
    $responsableNuevo = new Responsable($numLicencia,$nombre,$apellido);
    $responsableNuevo->insertar();
}
// Funcion en revisión ❔
// Funcion para encontrar un responsable
// Return object
function encontrarResponsable($numEmpleado) {
    // Creo un responsable referencia
    $responsable = new Responsable("","","");
    // Veo si el responsable existe
    if (!$responsable->buscar($numEmpleado)){
        $retorno = (null);
    } else {
        // Almaceno sus datos en la referencia vacia
        $retorno = $responsable;
    }
    return $retorno;
}
// Funcion en revisión ❔
// Funcion para modificar un responsable
// Return bool
function modificarResponsable($numEmpleado, $numLicencia, $nombre, $apellido) {
    $responsable = encontrarResponsable($numEmpleado);
    if ($responsable!=null) {
        $responsable->setNumeroLicencia($numLicencia);
        $responsable->setNombre($nombre);
        $responsable->setApellido($apellido);
        $seModifico = $responsable->modificar();
    } else {
        $seModifico = false;
    }
    return $seModifico;
}
// Funcion en revisión ❔
// Funcion para eliminar un responsable
// Return bool
function eliminarResponsable($numEmpleado) {
    $responsable = encontrarResponsable($numEmpleado);
    if ($responsable!=null) {
        $seElimino = $responsable->eliminar();
    } else {
        $seElimino = false;
    }
    return $seElimino;
}
//-----------------------------------------Viaje 👇🏻---------------------------------------------
/**
 * Funcion en revisión ❔
 * Retorna una colección con los viajes listados
 * @return array
 */
function mostrarViajes () {
    $colViajes = [];
    try {
        $viajes = Viaje :: listar ();
        foreach ($viajes as $viaje) {
            $colViajes [] = $viaje;
        }
    } catch (Exception $e) {
        echo "Error al obtener los pasajeros: " . $e -> getMessage () . "\n";
    }
    return $colViajes;
}

/**
 * Funcion en revisión ❔
 * Permite ingresar un nuevo Viaje
 * @param String $destino
 * @param int $cantMaxPasajeros
 * @param int $idEmpresa
 * @param int $numeroEmpleado
 * @param int $importe
 * @return boolean
 */
function ingresarViaje ($destino, $cantMaxPasajeros, $idEmpresa, $numeroEmpleado, $importe) {
    $empresa = new Empresa ("", "");
    $responsable = new Responsable ("", "", "");
    if ((!$empresa -> buscar ($idEmpresa)) && !($responsable -> buscar ($numeroEmpleado))) {
        $datosValidos = false;
    }
    else {
        $viajeNuevo = new Viaje ($destino, $cantMaxPasajeros, $idEmpresa, $numeroEmpleado, $importe);
        $viajeNuevo -> insertar ();
        $datosValidos = true;
    }
    return $datosValidos;
}

/**
 * Funcion en revisión ❔
 * Permite encontrar un viaje
 * @param int $idViaje
 * @return Pasajero
 */
function encontrarViaje ($idViaje){
    // Creo un viaje referencia
    $viaje = new Viaje ("","","","","");
    // Veo si el viaje existe
    if (!$viaje -> buscar ($idViaje)) {
        $retorno = null;
    } else {
        // Almaceno sus datos en la referencia vacia
        $retorno = $pasajero;
    }
    return $retorno;
}

/**
 * Funcion en revisión ❔
 * Permite modificar un pasajero
 * @param String $destino
 * @param int $cantMaxPasajeros
 * @param int $idEmpresa
 * @param int $numeroEmpleado
 * @param int $importe
 * @return boolean
 */
function modificarViaje ($idViaje, $destino, $cantMaxPasajeros, $idEmpresa, $numeroEmpleado, $importe){
    $viaje = encontrarViaje ($idViaje);
    if ($viaje != null){
        $viaje -> setDestino ($destino);
        $viaje -> setCantMaxPasajeros ($cantMaxPasajeros);
        $viaje -> setEmpresa ($idEmpresa);
        $viaje -> setResponsable ($numeroEmpleado);
        $seModifico = $viaje -> modificar ();
    } else {
        $seModifico = false;
    }
    return $seModifico;
}

/**
 * Funcion en revisión ❔
 * Permite eliminar un pasajero
 * @param int $idViaje
 * @return boolean
 */
function eliminarViaje ($idViaje){
    $viaje = encontrarViaje ($idViaje);
    if ($viaje != null){
        $seElimino = $viaje -> eliminar ();
    } else {
        $seElimino = false;
    }
    return $seElimino;
}
//-----------------------------------------Pasajero 👇🏻---------------------------------------------
// Función que devuelve un array con los pasajeros listados
function mostrarPasajeros() {
    $colPasajeros = [];
    try {
        $pasajeros = Pasajero::listar();
        foreach ($pasajeros as $pasajero) {
            $colPasajeros[] = $pasajero;
        }
    } catch (Exception $e) {
        echo "Error al obtener los pasajeros: " . $e->getMessage() . "\n";
    }
    return $colPasajeros;
}
// Funcion para ingresar un pasajero
// Return string
function ingresarPasajero($numDocumento,$nombre,$apellido,$telefono,$idViaje){
    // Modificar viaje para borrar errores de tipeos
    $viaje = new Viaje("","","","","");
    if (!$viaje->buscar($idViaje)){
        $viajeValido = false;
    } else {
        $pasajeroNuevo = new Pasajero($numDocumento,$nombre,$apellido,$telefono,$idViaje);
        $pasajeroNuevo->insertar();
        $viajeValido = true;
    }
    return $viajeValido;
}
// Funcion para econtrar un pasajero
// Return object
function encontrarPasajero($numDocumento){
    // Creo un pasajero referencia
    $pasajero = new Pasajero("","","","","");
    // Veo si el pasajero existe
    if (!$pasajero->buscar($numDocumento)){
        $retorno = (null);
    } else {
        // Almaceno sus datos en la referencia vacia
        $retorno = $pasajero;
    }
    return $retorno;
}
// Funcion para modificar un pasajero
// Return bool
function modificarPasajero($numDoc,$nombre,$apellido,$telefono,$idViaje){
    $pasajero = encontrarPasajero($numDoc);
    if ($pasajero!=null){
        $pasajero->setNombre($nombre);
        $pasajero->setApellido($apellido);
        $pasajero->setTelefono($telefono);
        $pasajero->setViaje($idViaje);
        $seModifico = $pasajero->modificar();
    } else {
        $seModifico = false;
    }
    return $seModifico;
}
// Funcion para eliminar un pasajero
// Return bool
function eliminarPasajero($numDoc){
    $pasajero = encontrarPasajero($numDoc);
    if ($pasajero!=null){
        $seElimino = $pasajero->eliminar();
    } else {
        $seElimino = false;
    }
    return $seElimino;
}
?>
