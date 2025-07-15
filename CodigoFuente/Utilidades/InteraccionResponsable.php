<?php
//------------------------------------------ RESPONSABLE ---------------------------------------------
// OPCION 8:
function verResponsables(){
    try{
        $responsables = Responsable::listar(); // sin condición -> trae todas los responsables de la BD
        $cantResponsables = count($responsables);
        // Si hay responsables registrados
        if($cantResponsables > 0){
            $i = 1;
            echo "Se encontraron $cantResponsables responsables en el sistema.\n";
            foreach ($responsables as $responsable) {
                echo "-------- RESPONSABLE " . $i++ . " --------\n";
                echo "$responsable\n"; // usamos __toString()
            }

        }else{
            echo "No hay responsables registrados.\n";
        }
    }catch(Exception $e){
        echo "Error al listar responsables: " . $e->getMessage();
    }
}

// OPCION 9:
function buscarResponsable(){
    // Solicito ID del responsable que se desea buscar
    $tipoDocumentoResponsable = readline("Ingresar tipo de documento del responsable buscado: ");
    $numeroDocumentoResponsable = (int)readline("Ingresar número de documento del responsable buscado: ");
    try{
        $responsable = Responsable::buscar($tipoDocumentoResponsable,$numeroDocumentoResponsable);
        if($responsable !== null){
            echo "Responsable encontrado:\n";
            echo "-------- RESPONSABLE --------\n";
            echo "$responsable\n"; // usamos __toString()
        }else{
            echo "No se encontró ningun responsable con tipo y número de documento $tipoDocumentoResponsable $numeroDocumentoResponsable.\n";
        }
    }catch(Exception $e){
        echo "Error al buscar responsable: " . $e->getMessage();
    }
    return $responsable;
}

// OPCION 10:
function ingresarResponsable(){
    // Pido datos del responsable
    $nombre = readline("Ingresar nombre del responsable: ");
    $apellido = readline("Ingresar apellido del responsable: ");
    $tipoDoc = readline("Ingresar el tipo de documento del responsable: ");
    $numeroDoc = (int)readline("Ingresar número de documento del responsable: ");
    $telefono = readline("Ingresar telefono del responsable: ");
    $numeroEmpleado = readline("Ingresar el numero de empleado del responsable: ");
    $legajo = readline("Ingresar el legajo del responsable: ");

    // $existePersonaResponsable = buscarPersona($tipoDoc,$numeroDoc);
    $existePersonaResponsable = Persona::buscar($tipoDoc,$numeroDoc);
    if ($existePersonaResponsable != null){
        $responsable = new Responsable($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono,$numeroEmpleado,$legajo);
    } else {
        ingresarPersona($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono);
        $responsable = new Responsable($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono,$numeroEmpleado,$legajo);
    }
    // Creo instancia de Responsable con los datos ingresados
    // $responsable = new Responsable($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono,$numeroEmpleado,$legajo);
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

// OPCION 11:
function modificarResponsable(){
    // Pido ID del Responsable que quiero modificar
    $tipoDocumentoResponsable = (string)readline("Ingresar tipo de documento del responsable a modificar: ");
    $numeroDocumentoResponsable = (int)readline("Ingresar número de documento del responsable a modificar: ");

    $responsable = Responsable::buscar($tipoDocumentoResponsable,$numeroDocumentoResponsable);
    if($responsable !== null){
            echo "Responsable encontrado:\n";
            echo "---------- RESPONSABLE ----------\n";
            echo "$responsable\n"; // usamos __toString()
            // Confirmación del usuario
            $confirmar = strtolower(readline("¿Desea modificar este responsable? (si/no): "));
            if($confirmar === "si"){
                // Pedimos los nuevos datos del pasajero
                // $numeroDoc = (int)readline("Ingresar número de documento: ");
                $numeroEmpleado = readline("Ingresar el nuevo numero de empleado: ");
                $legajo = readline("Ingrese el nuevo legajo del responsable: ");
                if($numeroEmpleado !== "" && $legajo !== ""){
                    $responsable->setNumeroEmpleado($numeroEmpleado);
                    $responsable->setLegajo($legajo);
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
            } else echo "Modificacion cancelada.";
    } else {
            echo "No se encontró ningun responsable con tipo y numero de documento $tipoDocumentoResponsable $numeroDocumentoResponsable.\n";
    } 
}

// OPCION 12:
function eliminarResponsable(){
    // Pido número de empleado del responsable que quiero eliminar
    $tipoDoc = (string)readline("Ingresar tipo de documento del responsable a eliminar: ");
    $numeroDoc = (int)readline("Ingresar número de documento del responsable a eliminar: ");
    
    $responsable = Responsable::buscar($tipoDoc,$numeroDoc);
        
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
        echo "No se encontró ningun responsable con tipo y numero de empleado $tipoDoc $numeroDoc.\n";
    }
}
?>