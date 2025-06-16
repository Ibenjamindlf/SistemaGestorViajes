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
    case 5:
        # code...
        break;
    case 6:
        # code...
        break;
    case 7:
        # code...
        break;
    case 8:
        # code...
        break;
    case 9:
        # code...
        break;
    case 10:
        # code...
        break;
    case 11:
        # code...
        break;
    case 12:
        # code...
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
