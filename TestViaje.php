<?php
include_once 'BaseDatos.php';
include_once 'Empresa.php';
include_once 'Pasajero.php';
include_once 'Responsable.php';
include_once 'Viaje.php';

function menuInteractivo(){
    /*
        ver -> listar()
        buscar -> buscar()
        ingresar -> insertar()
        modificar -> modificar()
        eliminar -> eliminar()
    */
    $cadena = (
        "\n---------- MENU ----------\n" .
        "1- Ver Empresas\n" .
        "2- Buscar Empresa\n" .
        "3- Ingresar Empresa\n" .
        "4- Modificar Empresa\n" .
        "5- Eliminar Empresa\n" .
        "6- Ver Responsables\n" .
        "7- Buscar Responsable\n" .
        "8- Ingresar Responsable\n" .
        "9- Modificar Responsable\n" .
        "10- Eliminar Responsable\n" .
        "11- Ver Viajes\n" .
        "12- Buscar Viaje\n" .
        "13- Ingresar Viaje\n" .
        "14- Modificar Viaje\n" .
        "15- Eliminar Viaje\n" .
        "16- Ver Pasajeros\n" .
        "17- Buscar Pasajero\n" .
        "18- Ingresar Pasajero\n" .
        "19- Modificar Pasajero\n" .
        "20- Eliminar Pasajero\n" .
        "--------------------------\n"
    );
    return $cadena;
}

// Muestro el menú
echo menuInteractivo();

// Capturo la opción del usuario
$opcion = (int)readline("Ingresar opción deseada: ");

// Ejecuto según opción
switch ($opcion) {
    case 1:
        verEmpresas();
        break;
    case 2:
        buscarEmpresa();
        break;
    case 3:
        ingresarEmpresa();
        break;
    case 4:
        modificarEmpresa();
        break;
    case 5:
        eliminarEmpresa();
        break;
    case 6:
        verResponsables();
        break;
    case 7:
        buscarResponsable();
        break;
    case 8:
        ingresarResponsable();
        break;
    case 9:
        modificarResponsable();
        break;
    case 10:
        eliminarResponsable();
        break;
    case 11:
        verViajes();
        break;
    case 12:
        buscarViaje();
        break;
    case 13:
        ingresarViaje();
        break;
    case 14:
        modificarViaje();
        break;
    case 15:
        eliminarViaje();
        break;
    case 16:
        verPasajeros();
    break;
    case 17:
        buscarPasajero();
        break;
    case 18:
        ingresarPasajero();
        break;
    case 19:
        modificarPasajero();
        break;
    case 20:
        eliminarPasajero();
        break;
    default:
        echo"\nXXXXX Opción invalida XXXXX\n";
    break;
}

//-------------------------------------------- EMPRESA -----------------------------------------------
// OPCION 1:
function verEmpresas(){
    try{
        $empresas = Empresa::listar(); // sin condición -> trae todas las empresas de la BD

        // Si hay empresas registradas
        if(count($empresas) > 0){

            foreach ($empresas as $empresa) {
                echo "---------- EMPRESA ----------\n";
                echo "$empresa\n"; // usamos __toString()
            }

        }else{
            echo "No hay empresas registradas.\n";
        }
    }catch(Exception $e){
        echo "Error al listar empresas: " . $e->getMessage();
    }
}

// OPCION 2:
function buscarEmpresa(){
    // Solicito ID de la empresa que se desea buscar
    $idEmpresa = (int)readline("Ingresar ID de la Empresa buscada: ");

    try{
        $empresa = Empresa::buscar($idEmpresa);
        if($empresa !== null){
            echo "Empresa encontrada:\n";
            echo "---------- EMPRESA ----------\n";
            echo "$empresa\n"; // usamos __toString()
        }else{
            echo "No se encontró ninguna empresa con ID $idEmpresa.\n";
        }
    }catch(Exception $e){
        echo "Error al buscar empresa: " . $e->getMessage();
    }
}

// OPCION 3:
function ingresarEmpresa(){
    // Pido datos de la Empresa
    $nombre = readline("Ingresar nombre de la empresa: ");
    $direccion = readline("Ingresar dirección de la empresa: ");

    // Creo instancia de Empresa con los datos ingresados
    $empresa = new Empresa($nombre, $direccion);

    try {
        if ($empresa->insertar()) {
            echo "Empresa insertada con éxito\n";
        } else {
            echo "No se pudo insertar la empresa.\n";
        }
    } catch (Exception $e) {
        echo "Error al insertar la empresa: " . $e->getMessage();
    }
}

// OPCION 4:
function modificarEmpresa(){
    // Pido ID de la Empresa que quiero modificar
    $idEmpresa = (int)readline("Ingresar ID de la Empresa a modificar: ");

    $empresa = Empresa::buscar($idEmpresa);

    if($empresa !== null){
        // Pedimos los nuevos datos de la empresa
        $nombre = readline("Ingresar el nuevo nombre de la empresa: ");
        $direccion = readline("Ingresar la nueva dirección de la empresa: ");

        if($nombre !== "" && $direccion !== ""){
            $empresa->setNombre($nombre);
            $empresa->setDireccion($direccion);

            // Modificamos en la BD
            try {
                if ($empresa->modificar()) {
                    echo "Empresa modificada con éxito:\n";
                    echo "---------- EMPRESA ----------\n";
                    echo "$empresa\n"; // usamos __toString()
                } else {
                    echo "No se pudo modificar la empresa. Falló en la base de datos.\n";
                }
            } catch (Exception $e) {
                echo "Error al modificar la empresa: " . $e->getMessage() . "\n";
            }
        }else{
            echo "Datos invalidos. Falló la modificación.\n";
        }
    }else{
        echo "No se encontró ninguna empresa con ID $idEmpresa.\n";
    } 
}

// OPCION 5:
function eliminarEmpresa(){
    // Pido ID de la Empresa que quiero eliminar
    $idEmpresa = (int)readline("Ingresar ID de la Empresa a eliminar: ");

    $empresa = Empresa::buscar($idEmpresa);
        
    if($empresa !== null){
        echo "Empresa encontrada:\n";
        echo "---------- EMPRESA ----------\n";
        echo "$empresa\n"; // usamos __toString()

        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea eliminar esta empresa? (si/no): "));

        if($confirmar === "si"){

            try {
                if ($empresa->eliminar()) {
                    echo "Empresa eliminada con éxito.\n";
                } else {
                    echo "No se pudo eliminar la empresa.\n";
                }
            } catch (Exception $e) {
                echo "Error al eliminar la empresa: " . $e->getMessage() . "\n";
            }

        }else{
            echo "Eliminación cancelada.\n";
        }
    }else{
        echo "No se encontró ninguna empresa con ID $idEmpresa.\n";
    }
}

//----------------------------------------------------------------------------------------------------

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

//--------------------------------------------- VIAJE ------------------------------------------------
// OPCION 11:
function verViajes(){
    try{
        $viajes = Viaje::listar(); // sin condición -> trae todas los responsables de la BD

        // Si hay responsables registrados
        if(count($viajes) > 0){

            foreach ($viajes as $viaje) {
                echo "----------- VIAJE -----------\n";
                echo "$viaje\n"; // usamos __toString()
            }

        }else{
            echo "No hay viajes registrados.\n";
        }
    }catch(Exception $e){
        echo "Error al listar viajes: " . $e->getMessage();
    }
}

// OPCION 12:
function buscarViaje(){
    // Solicito ID del viaje que se desea buscar
    $idViaje = (int)readline("Ingresar ID del viaje buscado: ");

    try{
        $viaje = Viaje::buscar($idViaje);
        if($viaje !== null){
            echo "Viaje encontrado:\n";
            echo "----------- VIAJE -----------\n";
            echo "$viaje\n"; // usamos __toString()
        }else{
            echo "No se encontró ningún viaje con ID $idViaje.\n";
        }
    }catch(Exception $e){
        echo "Error al buscar viaje: " . $e->getMessage();
    }
}

// OPCION 13:
function ingresarViaje(){
    // Pido datos del viaje
    $destino = readline("Ingresar destino del viaje: ");
    $cantMaxPasajeros = readline("Ingresar cantidad máxima de pasajeros: ");
    $idEmpresa = readline("Ingresar ID de la empresa: ");
    $idEmpresaEncontrado = Empresa::buscar($idEmpresa);
    $numEmpleado = readline("Ingresar numero de empleado: ");
    $numEmpleadoEncontrado = Responsable::buscar($numEmpleado);
    $importe = readline("Ingresar importe del viaje: ");

    if($idEmpresaEncontrado !== null && $numEmpleadoEncontrado !== null){
        // Creo instancia de Responsable con los datos ingresados
        $viaje = new Viaje($destino, $cantMaxPasajeros, $idEmpresaEncontrado->getIdEmpresa(), $numEmpleadoEncontrado->getNumeroEmpleado(), $importe);

        try {
            if ($viaje->insertar()) {
                echo "Viaje insertado con éxito\n";
            } else {
                echo "No se pudo insertar viaje.\n";
            }
        } catch (Exception $e) {
            echo "Error al insertar viaje: " . $e->getMessage();
        }
    }else{
        echo "ID de la empresa, o numero del empleado, invalidos";
    }
    
}

// OPCION 14:
function modificarViaje(){
    // Pido ID del Viaje que quiero modificar
    $idViaje= (int)readline("Ingresar ID del viaje a modificar: ");

    $viaje = Viaje::buscar($idViaje);

    if($viaje !== null){
        // Pedimos los nuevos datos del viaje
        $destino = readline("Ingresar nuevo destino del viaje: ");
        $cantMaxPasajeros = (int)readline("Ingresar la nueva cantidad máxima de pasajeros: ");
        $importe = readline("Ingresar el nuevo importe: ");

        if($destino !== "" && $cantMaxPasajeros !== "" && $importe !== ""){
            $viaje->setDestino($destino);
            $viaje->setCantMaxPasajeros($cantMaxPasajeros);
            $viaje->setImporte($importe);

            // Modificamos en la BD
            try {
                if ($viaje->modificar()) {
                    echo "Viaje modificado con éxito:\n";
                    echo "----------- VIAJE -----------\n";
                    echo "$viaje\n"; // usamos __toString()
                } else {
                    echo "No se pudo modificar el viaje. Falló en la base de datos.\n";
                }
            } catch (Exception $e) {
                echo "Error al modificar viaje: " . $e->getMessage() . "\n";
            }
        }else{
            echo "Datos invalidos. Falló la modificación.\n";
        }
    }else{
        echo "No se encontró ningun ID viaje  $idViaje.\n";
    } 
}

// OPCION 15:
function eliminarViaje(){
    // Pido ID del viaje que quiero eliminar
    $idViaje = (int)readline("Ingresar ID del viaje a eliminar: ");

    $viaje = Viaje::buscar($idViaje);
        
    if($viaje !== null){
        echo "Viaje encontrado:\n";
        echo "----------- VIAJE -----------\n";
        echo "$viaje\n"; // usamos __toString()

        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea eliminar este viaje? (si/no): "));

        if($confirmar === "si"){

            try {
                if ($viaje->eliminar()) {
                    echo "Viaje eliminado con éxito.\n";
                } else {
                    echo "No se pudo eliminar viaje.\n";
                }
            } catch (Exception $e) {
                echo "Error al eliminar viaje: " . $e->getMessage() . "\n";
            }

        }else{
            echo "Eliminación cancelada.\n";
        }
    }else{
        echo "No se encontró ningun viaje con ID $idViaje.\n";
    }
}

//----------------------------------------------------------------------------------------------------

//------------------------------------------- PASAJERO -----------------------------------------------
// OPCION 16:
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
// OPCION 17:
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
// OPCION 18:
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
// OPCION 19:
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
// OPCION 20:
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