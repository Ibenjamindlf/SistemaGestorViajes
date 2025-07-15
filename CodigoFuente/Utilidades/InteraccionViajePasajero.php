<?php
// OPCION 24:
function buscarViajesPasajeros(){
    echo "Desea buscar por:\n";
    echo "1. ID de viaje\n";
    echo "2. Documento de pasajero\n";
    $opcion = (int)readline("Opcion(1/2):");
    switch ($opcion) {
        case 1:
            $idViaje = (int)readline("Ingresar id del viaje a buscar: ");
            $idViajeExistente = Viaje::buscar($idViaje);
            if ($idViajeExistente === null){
                echo "El viaje con ID $idViaje no existe en el sistema.\n";
            } else {
                $colViajes = ViajePasajero::buscarPorViaje($idViaje);
                try{
                    if ($colViajes != []){
                        $i=1;
                        $cantViajes = count($colViajes);
                        echo "Se encontraron $cantViajes vinculaciones al viaje con id $idViaje en el sistema.\n";
                        foreach ($colViajes as $unViaje){
                            echo "------- VIAJE CON VINCULACION  " . $i++ . " -------\n";
                            echo $unViaje;
                            echo "\n";
                        }
                    } else {
                        echo "El viaje con ID $idViaje no tiene pasajeros vinculados actualmente.\n";
                    }
                } catch (Exception $e){
                    echo "Error al listar la vinculacion: " . $e->getMessage();
                }
            }
        break;
        case 2:
            $tipoDocPasajero = readline("Ingresar el tipo de documento del pasajero a buscar: ");
            $numDocPasajero = (int)readline("Ingresar el numero de documento del pasajero a buscar: ");
            $pasajeroExistente = Pasajero::buscar($tipoDocPasajero,$numDocPasajero);
            if ($pasajeroExistente === null){
                echo "El pasajero con tipo y numero documento: $tipoDocPasajero $numDocPasajero no existe en el sistema.\n";
            } else {
                $colViajes = ViajePasajero::buscarPorPasajero($tipoDocPasajero,$numDocPasajero);
                try{
                    if ($colViajes != []){
                        $i=1;
                        $cantViajes = count($colViajes);
                        echo "Se encontraron $cantViajes vinculaciones al pasajero con tipo y numero documento $tipoDocPasajero $numDocPasajero en el sistema.\n";
                        foreach ($colViajes as $unViaje){
                            echo "------- VIAJE CON VINCULACION  " . $i++ . " -------\n";
                            echo $unViaje;
                            echo "\n";
                        }
                    } else {
                        echo "El pasajero con tipo y numero documento: $tipoDocPasajero $numDocPasajero no tiene pasajeros vinculados actualmente.\n";
                    }
                } catch (Exception $e){
                    echo "Error al listar la vinculacion: " . $e->getMessage();
                }
            }
        break;
        default:
            echo ("Opcion invalida.\n");
        break;
    }
    
}
// OPCION 25:
function ingresarViajePasajeros(){
    $tipoDocPasajero = readline("Ingresar el tipo de documento del pasajero: ");
    $numDocPasajero = (int)readline("Ingresar el numero de documento del pasajero: ");
    $idViaje = (int)readline("Ingresar el id del viaje: ");
    $viaje = Viaje::buscar($idViaje);
    $pasajero = Pasajero::buscar($tipoDocPasajero,$numDocPasajero);
    $viajePasajero = new ViajePasajero($viaje,$pasajero);
    try {
        if ($viajePasajero->insertar()){
            echo "Vinculacion viaje pasajero creada con exito.\n";
        } else {
            echo "No se pudo generar la vinculacion.\n";
        }
    } catch (Exception $e) {
        echo "Error al realizar la vinculacion: " . $e->getMessage();
    }
}
// OPCION 23
function verViajesPasajeros(){
    try {
        $viajesPasajeros = ViajePasajero::listar();
        $cantViajesPasajeros = count($viajesPasajeros);
        if($cantViajesPasajeros>0){
            $i = 1;
            echo "Se encontraron $cantViajesPasajeros vinculaciones viaje pasajero en el sistema.\n";
            foreach ($viajesPasajeros as $unViajePasajero) {
                echo "---------- VINCULACION VIAJE PASAJERO " . $i++ . " ----------\n";
                echo "$unViajePasajero\n";
            }
        } else {
            echo "No hay empresas registradas.\n";
        }
    } catch (Exception $e) {
        echo "Error al listar empresas: " . $e->getMessage();
    }
} 

// OPCION 26
function modificarViajePasajero(){
    echo "Para modificar una vinculacion entre un pasajero y un viaje, primero se debe eliminar la vinculacion y luego crear una nueva.\n";
    $confirmacion = strtolower(readline("¿Quiere continuar? (si/no) "));
    if ($confirmacion === "si"){
        eliminarViajePasajero();
        echo "--- INGRESAR LA NUEVA VINCULACION ---\n";
        ingresarViajePasajeros();
    } else {
        echo "Modificacion cancelada";
    }
}

function eliminarViajePasajero(){
    $tipoDocPasajero = readline("Ingresar el tipo de documento del pasajero a eliminar: ");
    $numDocPasajero = (int)readline("Ingresar el numero de documento del pasajero a eliminar: ");
    $idViaje = (int)readline("Ingresar ID del viaje a eliminar: ");
    $vinculacion = ViajePasajero::buscar($tipoDocPasajero,$numDocPasajero,$idViaje);
    if ($vinculacion !== null && count($vinculacion)>0){
        foreach ($vinculacion as $unaVinculacion) {
                echo "Vinculacion viaje pasajero encontrada: \n";
                echo "---------- VINCULACION VIAJE PASAJERO ----------\n";
                echo "$unaVinculacion\n";
            }
        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea eliminar esta vinculacion? (si/no): "));
        if ($confirmar === "si"){
            try {
                if ($unaVinculacion->eliminar()){
                    echo "Vinculacion eliminada con exito.\n";
                } else {
                    echo "No se pudo eliminar la vinculacion.\n";
                }
            } catch (Exception $e) {
                echo "Error al eliminar la vinculacion: " . $e->getMessage() . "\n";
            }
        } else {
            echo "Eliminacion cancelada.\n";
        }
    } else {
        echo "No se encontro ninguna vinculacion con los siguientes datos:\n";
        echo "tipo y numero documento pasajero: $tipoDocPasajero $numDocPasajero\n";
        echo "id viaje: $idViaje\n";
    }
}
?>