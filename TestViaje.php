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
//------------------------------------------ RESPONSABLE ---------------------------------------------
// OPCION 6:
function verResponsables(){
    try{
        $responsables = Responsable::listar(); // sin condición -> trae todas los responsables de la BD

        // Si hay responsables registrados
        if(count($responsables) > 0){

            foreach ($responsables as $responsable) {
                echo "-------- RESPONSABLE --------\n";
                echo "$responsable\n"; // usamos __toString()
            }

        }else{
            echo "No hay responsables registrados.\n";
        }
    }catch(Exception $e){
        echo "Error al listar responsables: " . $e->getMessage();
    }
}

// OPCION 7:
function buscarResponsable(){
    // Solicito ID del responsable que se desea buscar
    $idResponsable = (int)readline("Ingresar número de empleado del responsable buscado: ");

    try{
        $responsable = Responsable::buscar($idResponsable);
        if($responsable !== null){
            echo "Responsable encontrado:\n";
            echo "-------- RESPONSABLE --------\n";
            echo "$responsable\n"; // usamos __toString()
        }else{
            echo "No se encontró ningun responsable con número de empleado $idResponsable.\n";
        }
    }catch(Exception $e){
        echo "Error al buscar responsable: " . $e->getMessage();
    }
}

// OPCION 8:
function ingresarResponsable(){
    // Pido datos del responsable
    $numeroLicencia = (int)readline("Ingresar número de licencia: ");
    $nombre = readline("Ingresar nombre del responsable: ");
    $apellido = readline("Ingresar apellido del responsable: ");

    // Creo instancia de Responsable con los datos ingresados
    $responsable = new Responsable($numeroLicencia, $nombre, $apellido);

    try {
        if ($responsable->insertar()) {
            echo "Responsable insertado con éxito\n";
        } else {
            echo "No se pudo insertar responsable.\n";
        }
    } catch (Exception $e) {
        echo "Error al insertar responsable: " . $e->getMessage();
    }
}

// OPCION 9:
function modificarResponsable(){
    // Pido ID del Responsable que quiero modificar
    $idResponsable = (int)readline("Ingresar número de empleado del Responsable a modificar: ");

    $responsable = Responsable::buscar($idResponsable);

    if($responsable !== null){
        // Pedimos los nuevos datos del responsable
        $numeroLicencia = (int)readline("Ingresar el nuevo número de licencia: ");
        $nombre = readline("Ingresar nuevo nombre del responsable: ");
        $apellido = readline("Ingresar nuevo apellido del responsable: ");

        if($numeroLicencia !== "" && $nombre !== "" && $apellido !== ""){
            $responsable->setNumeroLicencia($numeroLicencia);
            $responsable->setNombre($nombre);
            $responsable->setApellido($apellido);

            // Modificamos en la BD
            try {
                if ($responsable->modificar()) {
                    echo "Responsable modificado con éxito:\n";
                    echo "-------- RESPONSABLE --------\n";
                    echo "$responsable\n"; // usamos __toString()
                } else {
                    echo "No se pudo modificar responsable. Falló en la base de datos.\n";
                }
            } catch (Exception $e) {
                echo "Error al modificar responsable: " . $e->getMessage() . "\n";
            }
        }else{
            echo "Datos invalidos. Falló la modificación.\n";
        }
    }else{
        echo "No se encontró ningun responsable con numero de empleado $idResponsable.\n";
    } 
}

// OPCION 10:
function eliminarResponsable(){
    // Pido número de empleado del responsable que quiero eliminar
    $idResponsable = (int)readline("Ingresar número de empleado del responsable a eliminar: ");

    $responsable = Responsable::buscar($idResponsable);
        
    if($responsable !== null){
        echo "Responsable encontrado:\n";
        echo "-------- RESPONSABLE --------\n";
        echo "$responsable\n"; // usamos __toString()

        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea eliminar este responsable? (si/no): "));

        if($confirmar === "si"){

            try {
                if ($responsable->eliminar()) {
                    echo "Responsable eliminado con éxito.\n";
                } else {
                    echo "No se pudo eliminar responsable.\n";
                }
            } catch (Exception $e) {
                echo "Error al eliminar responsable: " . $e->getMessage() . "\n";
            }

        }else{
            echo "Eliminación cancelada.\n";
        }
    }else{
        echo "No se encontró ningun responsable con numero de empleado $idResponsable.\n";
    }
}

//----------------------------------------------------------------------------------------------------
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
function verPasajeros(){
    try{
        $pasajeros = Pasajero::listar(); // sin condición -> trae todas las personas de la BD

        // Si hay pasajeros registrados
        if(count($pasajeros) > 0){

            foreach ($pasajeros as $unPasajero) {
                echo "-------- PASAJERO --------\n";
                echo "$unPasajero\n"; // usamos __toString()
            }

        }else{
            echo "No hay pasajeros registrados.\n";
        }
    }catch(Exception $e){
        echo "Error al listar pasajeros: " . $e->getMessage();
    }
}
// OPCION 7:
function buscarPasajero(){
    // Solicito numDoc de la persona que se desea buscar
    $numeroDocumentoPasajero = (int)readline("Ingresar número de documento de la persona buscada: ");

    try{
        $pasajero = Pasajero::buscar($numeroDocumentoPasajero);
        if($pasajero !== null){
            echo "Responsable encontrado:\n";
            echo "-------- RESPONSABLE --------\n";
            echo "$pasajero\n"; // usamos __toString()
        }else{
            echo "No se encontró ninguna persona con ese número de documento $numeroDocumentoPasajero.\n";
        }
    }catch(Exception $e){
        echo "Error al buscar responsable: " . $e->getMessage();
    }
}
// OPCION 8:
function IngresarPasajero(){
    // Pido datos del pasajero
    $numeroDoc = (int)readline("Ingresar número de documento: ");
    $nombre = readline("Ingresar nombre del pasajero: ");
    $apellido = readline("Ingresar apellido del pasajero: ");
    $telefono = readline("Ingresar telefono del pasajero: ");
    $idViaje = readline("Ingresar el idViaje del pasajero: ");

    // Creo instancia de pasajero con los datos ingresados
    $pasajero = new Pasajero($numeroDoc, $nombre, $apellido,$telefono,$idViaje);

    try {
        if ($pasajero->insertar()) {
            echo "Pasajero insertado con éxito\n";
        } else {
            echo "No se pudo insertar el pasajero.\n";
        }
    } catch (Exception $e) {
        echo "Error al insertar el pasajero: " . $e->getMessage();
    }
}
// OPCION 9:
function modificarPasajero(){
    // Pido ID del Responsable que quiero modificar
    $numeroDocumentoPasajero = (int)readline("Ingresar número de documento de la persona a modificar: ");

    $pasajero = Pasajero::buscar($numeroDocumentoPasajero);

    if($pasajero !== null){
        // Pedimos los nuevos datos del pasajero
        // $numeroDoc = (int)readline("Ingresar número de documento: ");
        $nombre = readline("Ingresar nombre del pasajero: ");
        $apellido = readline("Ingresar apellido del pasajero: ");
        $telefono = readline("Ingresar numero de telefono del pasajero: ");
        $idViaje = readline("Ingresar numero de viaje: ");

        if($nombre !== "" && $apellido !== "" && $telefono !== "" && $idViaje !==""){
            // $pasajero->setNumeroDocumento($numeroDoc);
            $pasajero->setNombre($nombre);
            $pasajero->setApellido($apellido);
            $pasajero->setTelefono($telefono);
            $pasajero->setViaje($idViaje);

            // Modificamos en la BD
            try {
                if ($pasajero->modificar()) {
                    echo "Pasajero modificado con éxito:\n";
                    echo "-------- PASAJERO --------\n";
                    echo "$pasajero\n"; // usamos __toString()
                } else {
                    echo "No se pudo modificar pasajero. Falló en la base de datos.\n";
                }
            } catch (Exception $e) {
                echo "Error al modificar pasajero: " . $e->getMessage() . "\n";
            }
        }else{
            echo "Datos invalidos. Falló la modificación.\n";
        }
    }else{
        echo "No se encontró ningun pasajero con numero de empleado $numeroDocumentoPasajero.\n";
    } 
}
// OPCION 10:
function eliminarPasajero(){
    // Pido número de empleado del responsable que quiero eliminar
    $numeroDoc = (int)readline("Ingresar número de documento del pasajero a eliminar: ");

    $pasajero = Pasajero::buscar($numeroDoc);
        
    if($pasajero !== null){
        echo "Pasajero encontrado:\n";
        echo "-------- PASAJERO --------\n";
        echo "$pasajero\n"; // usamos __toString()

        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea eliminar este pasajero? (si/no): "));

        if($confirmar === "si"){

            try {
                if ($pasajero->eliminar()) {
                    echo "Pasajero eliminado con éxito.\n";
                } else {
                    echo "No se pudo eliminar pasajero.\n";
                }
            } catch (Exception $e) {
                echo "Error al eliminar pasajero: " . $e->getMessage() . "\n";
            }

        }else{
            echo "Eliminación cancelada.\n";
        }
    }else{
        echo "No se encontró ningun pasajero con numero de documento $numeroDoc.\n";
    }
}
?>
