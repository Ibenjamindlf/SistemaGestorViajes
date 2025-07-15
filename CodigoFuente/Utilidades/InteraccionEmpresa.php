<?php
// OPCION 13:
function verEmpresas(){
    try{
        $empresas = Empresa::listar(); // sin condición -> trae todas las empresas de la BD
        $cantEmpresas = count($empresas);
        // Si hay empresas registradas
        if($cantEmpresas > 0){
            $i = 1;
            echo "Se encontraron $cantEmpresas empresas en el sistema.\n";
            foreach ($empresas as $empresa) {
                echo "---------- EMPRESA " . $i++ . " ----------\n";
                echo "$empresa\n"; // usamos __toString()
            }

        }else{
            echo "No hay empresas registradas.\n";
        }
    }catch(Exception $e){
        echo "Error al listar empresas: " . $e->getMessage();
    }
}

// OPCION 14:
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

// OPCION 15:
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

// OPCION 16:
function modificarEmpresa(){
    // Pido ID de la Empresa que quiero modificar
    $idEmpresa = (int)readline("Ingresar ID de la Empresa a modificar: ");

    $empresa = Empresa::buscar($idEmpresa);

    if($empresa !== null){
        echo "Empresa encontrada:\n";
        echo "---------- EMPRESA ----------\n";
        echo "$empresa\n"; // usamos __toString()
        // Confirmación del usuario
        $confirmar = strtolower(readline("¿Desea modificar esta empresa? (si/no): "));
        if($confirmar === "si"){
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
                    echo "Error al modificar Empresa: " . $e->getMessage() . "\n";
                }
            }else{
                echo "Datos invalidos. Falló la modificación.\n";
            }
        } else {echo "Modificacion cancelada.";}
    } else{
        echo "No se encontró ninguna empresa con idEmpresa: $idEmpresa.\n";
    } 
}

// OPCION 17:
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
?>