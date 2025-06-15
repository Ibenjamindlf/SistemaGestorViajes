<?php
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
        # code...
        break;
    // Ingresar Pasajeros 14
    case 14:
        # code...
        break;
    // Modificar Pasajeros 15
    case 15:
        # code...
        break;
    // Eliminar Pasajeros 16
    case 16:
        # code...
        break;
    // Si no ingresa un valor que este en los case's retorna: 
    default:
            echo"\nLa opcion ingresada es invalida.\n";
    break;
}




// $bd = new BaseDatos();

// if ($bd->iniciar()) {
//     echo "✅ Conexión exitosa a la base de datos.\n";
//     // Cerramos conexión
//     $bd->cerrarConexion();
//     echo "🔒 Conexión cerrada correctamente.";
// } else {
//     echo "❌ Error al conectar a la base de datos: " . $bd->getError();
// }

function mostrarPasajeros(){
    
}

?>
