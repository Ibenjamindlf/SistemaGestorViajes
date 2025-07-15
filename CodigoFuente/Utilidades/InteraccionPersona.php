<?php
//-------------------------------------------- PERSONA -----------------------------------------------
// OPCION 1: ✅
function verPersonas(){
    try{
        $personas = Persona::listar();
        $cantPersonas = count($personas);
        if ($cantPersonas>0){
            $i = 1;
            echo "Se encontraron $cantPersonas personas en el sistema\n";
            foreach ($personas as $unaPersona){
                echo "-------- PERSONA " .$i++. " --------\n";
                echo "$unaPersona\n";
            }
        }else{
            echo "No hay personas registradas.\n";
        }
    }catch(Exception $e){
        echo "Error al listar personas: " . $e->getMessage();
    }
}
// OPCION 2: ✅
function buscarPersona($tipoDoc,$numDoc){
    // Recibo el tipo y el numero de documento por parametros
    if ($tipoDoc != "" && $numDoc != ""){
        try{
            $persona = Persona::buscar($tipoDoc,$numDoc);
            if ($persona !== null){
                echo "Persona encontrada:\n";
                echo "-------- PERSONA --------\n";
                echo "$persona\n";
            } else {
                echo "No se encontro persona con tipo y numero de documento: $tipoDoc $numDoc en el sistema.\n";
            }
            
        }catch(Exception $e){
        echo "Error al buscar persona: " . $e->getMessage();
        }
    } else {
        echo "Datos invalidos.\n";
    }
    return $persona;
}
// 
function ingresarPersona($nombre,$apellido,$tipoDocumento,$nroDocumento,$telefono){
    // $nombre = readline("Ingresar nombre de la persona: ");
    // $apellido = readline("Ingresar apellido de la persona: ");
    // $tipoDocumento = readline("Ingresar el tipo de documento de la persona: ");
    // $nroDocumento = readline("Ingresar numero de documento de la persona: ");
    // $telefono = readline("Ingresar telefono de la persona: ");
    $persona = new Persona($nombre,$apellido,$tipoDocumento,$nroDocumento,$telefono);
    try{
        if ($persona->insertar()) {
            // echo "Persona creada con éxito\n";
            $seCreoPersona = true;
        } else {
            // echo "No se pudo crear la persona.\n";
            $seCreoPersona = false;
        }
    } catch (Exception $e) {
        echo "Error al crear la persona: " . $e->getMessage();
    }
    return $seCreoPersona;
}
// 
function modificarPersona(){
    $tipoDoc = (string)readline("Ingresar el tipo de documento de la persona que desea modificar: ");
    $numDoc = (string)readline("Ingresar el numero de documento de la persona que desea modificar: ");
    $persona = Persona::buscar($tipoDoc,$numDoc);
    if ($persona !== null){
        echo "Persona encontrado:\n";
        echo "---------- PERSONA ----------\n";
        echo "$persona\n"; // usamos __toString()
        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea modificar esta persona? (si/no): "));
        if($confirmar === "si"){
            $nombre = readline("Ingresar el nuevo nombre de la persona: ");
            $apellido = readline("Ingresar el nuevo apellido de la persona: ");
            $telefono = readline("Ingresar el nuevo telefono de la persona: ");
            if ($nombre !== "" && $apellido !== "" && $telefono !== ""){
                $persona->setNombre($nombre);
                $persona->setApellido($apellido);
                $persona->setTelefono($telefono);
                try{
                    if ($persona->modificar()){
                        echo "Persona modificada con éxito:\n";
                        echo "---------- PERSONA ----------\n";
                        echo "$persona\n"; // usamos __toString()
                    } else {
                        echo "No se pudo modificar la persona. Falló en la base de datos.\n";
                    }
                } catch (Exception $e) {
                    echo "Error al modificar la persona: " . $e->getMessage() . "\n";
                }
            }else{
                echo "Datos invalidos. Falló la modificación.\n";
            }
        }else {
            echo "Modificacion cancelada.\n";
        }
    } else {
        echo "No se encontró ninguna persona con tipo documento $tipoDoc y numero documento $numDoc.\n";
    }
}
// 
function eliminarPersona(){
    $tipoDoc = (string)readline("Ingresar el tipo de documento de la persona que desea eliminar: ");
    $numDoc = (string)readline("Ingresar el numero de documento de la persona que desea eliminar: ");
    $persona = Persona::buscar($tipoDoc,$numDoc);
    if($persona !== null){
        echo "Persona encontrada:\n";
        echo "---------- PERSONA ----------\n";
        echo "$persona\n"; // usamos __toString(
        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea eliminar esta empresa? (si/no): "));
        if ($confirmar === "si"){
            try{
                if($persona->eliminar()){
                    echo "Persona eliminada con exito.\n";
                } else {
                    echo "No se pudo eliminar la persona.\n";
                }
            } catch (Exception $e) {
                echo "Error al eliminar la persona: " . $e->getMessage() . "\n";
            }
        }else{
            echo "Eliminación cancelada.\n";
        }
    }else{
        echo "No se encontró ninguna persona con tipo documento $tipoDoc y numero documento $numDoc.\n";
    }
}
?>