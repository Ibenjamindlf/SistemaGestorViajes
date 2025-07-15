<?php
//------------------------------------------- PASAJERO -----------------------------------------------
// OPCION 3:
// Función que devuelve un array con los pasajeros listados
function verPasajeros(){
    try{
        $pasajeros = Pasajero::listar(); // sin condición -> trae todas las personas de la BD
        $cantPasajeros = count($pasajeros);
        // Si hay pasajeros registrados
        if($cantPasajeros > 0){
            $i = 1;
            echo "Se encontraron $cantPasajeros pasajeros en el sistema.\n";
            foreach ($pasajeros as $unPasajero) {
                echo "-------- PASAJERO " .$i++. " --------\n";
                echo "$unPasajero\n"; // usamos __toString()
            }
        }else{
            echo "No hay pasajeros registrados.\n";
        }
    }catch(Exception $e){
        echo "Error al listar pasajeros: " . $e->getMessage();
    }
}
// OPCION 4:
function buscarPasajero(){
    // Solicito tipo y numDoc de la persona que se desea buscar
    $tipoDocumentoPasajero = readline("Ingresar tipo de documento del pasajero buscado: ");
    $numeroDocumentoPasajero = (int)readline("Ingresar número de documento del pasajero buscado: ");
    try{
        $pasajero = Pasajero::buscar($tipoDocumentoPasajero,$numeroDocumentoPasajero);
        if($pasajero !== null){
            echo "Pasajero encontrado:\n";
            echo "-------- PASAJERO --------\n";
            echo "$pasajero\n"; // usamos __toString()
        }else{
            echo "No se encontró ningun pasajero con ese tipo y número de documento: $tipoDocumentoPasajero $numeroDocumentoPasajero.\n";
        }
    }catch(Exception $e){
        echo "Error al buscar pasajero: " . $e->getMessage();
    }
    return $pasajero;
}
// OPCION 5:
function IngresarPasajero(){
    // Pido datos del pasajero
    $nombre = readline("Ingresar nombre del pasajero: ");
    $apellido = readline("Ingresar apellido del pasajero: ");
    $tipoDoc = readline("Ingresar el tipo de documento del pasajero: ");
    $numeroDoc = (int)readline("Ingresar número de documento: ");
    $telefono = readline("Ingresar telefono del pasajero: ");
    $nacionalidad = readline("Ingresar la nacionalidad del pasajero: ");
    $necesitaAsistencia = readline("Ingresar si el pasajero necesita asistencia (si/no): ");
    if ($necesitaAsistencia = strtolower(trim($necesitaAsistencia)) === "si"){
        $necesitaAsistencia = true;
    } else {
        $necesitaAsistencia = false;
    }
    //$seCreoPersona = ingresarPersona($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono);
    // $existePersonaPasajero =  buscarPersona($tipoDoc,$numeroDoc);
    $existePersonaPasajero = Persona::buscar($tipoDoc,$numeroDoc);
    if ($existePersonaPasajero != null){
        $pasajero = new Pasajero($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono,$nacionalidad,$necesitaAsistencia);
    } else {
        ingresarPersona($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono);
        $pasajero = new Pasajero($nombre,$apellido,$tipoDoc,$numeroDoc,$telefono,$nacionalidad,$necesitaAsistencia);
    }
        try {
        if ($pasajero->insertar()) {
            echo "Pasajero insertado con éxito\n";
        } else {
            echo "No se pudo insertar el pasajero.\n";
        }
    } catch (Exception $e) {
        echo "Error al insertar pasajero: " . $e->getMessage();
    }
}
// OPCION 6:
function modificarPasajero(){
    // Pido ID del Responsable que quiero modificar
    $tipoDocumentoPasajero = (string)readline("Ingresar tipo de documento del pasajero a modificar: ");
    $numeroDocumentoPasajero = (int)readline("Ingresar número de documento del pasajero a modificar: ");
    $pasajero = Pasajero::buscar($tipoDocumentoPasajero,$numeroDocumentoPasajero);
    if($pasajero !== null){
        echo "Pasajero encontrado:\n";
        echo "---------- PASAJERO ----------\n";
        echo "$pasajero\n"; // usamos __toString()
        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea modificar este pasajero? (si/no): "));
        if($confirmar === "si"){
            // Pedimos los nuevos datos del pasajero
            // $numeroDoc = (int)readline("Ingresar número de documento: ");
            $nacionalidad = readline("Ingresar la nueva nacionalidad del pasajero: ");
            $necesitaAsistencia = readline("el pasajero necesita asistencia? (si/no): ");
            if ($necesitaAsistencia === "si"){
                $necesitaAsistencia = true;
            } else {
                $necesitaAsistencia = false;
            }
            if($nacionalidad !== ""){
                $pasajero->setNacionalidad($nacionalidad);
                $pasajero->setNecesitaAsistencia($necesitaAsistencia);
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
        } else echo "Modificacion cancelada.";
    }else{
        echo "No se encontró ningun pasajero con tipo y numero de documento $tipoDocumentoPasajero $numeroDocumentoPasajero.\n";
    } 
}
// OPCION 7:
function eliminarPasajero(){
    // Pido número de empleado del responsable que quiero eliminar
    $tipoDoc = (string)readline("Ingresar tipo de documento del pasajero a eliminar: ");
    $numeroDoc = (int)readline("Ingresar número de documento del pasajero a eliminar: ");

    $pasajero = Pasajero::buscar($tipoDoc,$numeroDoc);
        
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
        echo "No se encontró ningun pasajero con tipo y numero de documento $tipoDoc $numeroDoc.\n";
    }
}
?>