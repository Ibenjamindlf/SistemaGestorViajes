<?php
//--------------------------------------------- VIAJE ------------------------------------------------
// OPCION 18:
function verViajes(){
    try{
        $viajes = Viaje::listar(); // sin condición -> trae todas los responsables de la BD
        $cantViajes = count($viajes);
        // Si hay responsables registrados
        if($cantViajes > 0){
            $i = 1;
            echo "Se encontraron $cantViajes viajes en el sistema.\n";
            foreach ($viajes as $viaje) {
                echo "----------- VIAJE " . $i++ . " -----------\n";
                echo "$viaje\n"; // usamos __toString()
            }

        }else{
            echo "No hay viajes registrados.\n";
        }
    }catch(Exception $e){
        echo "Error al listar viajes: " . $e->getMessage();
    }
}

// OPCION 19:
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

// OPCION 20:
function ingresarViaje(){
    // Pido datos del viaje
    $destino = readline("Ingresar destino del viaje: ");
    $cantMaxPasajeros = readline("Ingresar cantidad máxima de pasajeros: ");
    $idEmpresa = readline("Ingresar ID de la empresa: ");
    $empresaEncontrada = Empresa::buscar($idEmpresa);
    $tipoDocResponsable = readline("Ingresar tipo de documento del responsable: ");
    $numeroDocResponsable = readline("Ingresar numero de documento del responsable: ");
    $responsableEncontrado = Responsable::buscar($tipoDocResponsable,$numeroDocResponsable);
    $importe = readline("Ingresar importe del viaje: ");

    if($empresaEncontrada !== null && $responsableEncontrado !== null){
        // Creo instancia de Responsable con los datos ingresados
        $viaje = new Viaje($destino,$cantMaxPasajeros,$empresaEncontrada,$importe,$responsableEncontrado);
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
        echo "el ID de la empresa y/o el tipo y numero documento del responsbale no se encontraron cargados en el sistema.\n";
    }
    
}
// OPCION 21:
// Ver funcion con la profe por el tema de los return's
function modificarViaje() {
    $idViaje = (int) readline("Ingresar ID del viaje a modificar: ");
    $viaje = Viaje::buscar($idViaje);

    if ($viaje === null) {
        echo "No se encontró ningún viaje con ID $idViaje.\n";
        return;
    } else {
        echo "Viaje encontrado en el sistema:\n";
        echo "----------- VIAJE -----------\n";
        echo $viaje . "\n";
        $confirmacionViaje = strtolower(readline("¿Desea modificar el viaje? (si/no): "));
        if ($confirmacionViaje === "no"){
            return;
        }
    }

    // Pedimos datos básicos
    $destino = readline("Ingresar nuevo destino del viaje: ");
    $cantMaxPasajeros = (int) readline("Ingresar la nueva cantidad máxima de pasajeros: ");
    $importe = readline("Ingresar el nuevo importe: ");

    // Inicializamos con los valores actuales del viaje
    $empresa = $viaje->getEmpresa();
    $responsable = $viaje->getResponsable();

    // Confirmación y carga nueva empresa
    if (strtolower(readline("¿Desea modificar la empresa que realiza el viaje? (si/no): ")) === "si") {
        $idEmpresa = (int) readline("Ingresar el nuevo id de la empresa: ");
        $nuevaEmpresa = Empresa::buscar($idEmpresa);

        if ($nuevaEmpresa !== null) {
            $empresa = $nuevaEmpresa;
        } else {
            echo "❌ El ID de empresa no existe.\n";
            echo "❌ Fallo la modificacion.\n";
            return;
        }
    }

    // Confirmación y carga nuevo responsable
    if (strtolower(readline("¿Desea modificar el responsable a cargo? (si/no): ")) === "si") {
        $tipoDoc = readline("Ingresar el tipo de documento del nuevo responsable: ");
        $nroDoc = readline("Ingresar el número de documento del nuevo responsable: ");
        $nuevoResponsable = Responsable::buscar($tipoDoc, $nroDoc);

        if ($nuevoResponsable !== null) {
            $responsable = $nuevoResponsable;
        } else {
            echo "❌ Responsable no encontrado.\n";
            echo "❌ Fallo la modificacion.\n";
            return;
        }
    }

    // Validamos que los campos obligatorios estén completos
    if ($destino === "" || $cantMaxPasajeros <= 0 || $importe === "") {
        echo "❌ Datos inválidos. Falló la modificación.\n";
        return;
    }

    // Seteamos los datos nuevos
    $viaje->setDestino($destino);
    $viaje->setCantMaxPasajeros($cantMaxPasajeros);
    $viaje->setEmpresa($empresa);
    $viaje->setResponsable($responsable);
    $viaje->setImporte($importe);

    try {
        if ($viaje->modificar()) {
            echo "✅ Viaje modificado con éxito:\n";
            echo "----------- VIAJE -----------\n";
            echo $viaje . "\n";
        } else {
            echo "❌ No se pudo modificar el viaje en la base de datos.\n";
        }
    } catch (Exception $e) {
        echo "❌ Error al modificar el viaje: " . $e->getMessage() . "\n";
    }
}


// OPCION 22:
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
?>