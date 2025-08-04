<?php
include_once 'CodigoFuente/BaseDeDatos/BaseDatos.php';
include_once 'CodigoFuente/Entidades/Persona.php';
include_once 'CodigoFuente/Entidades/Empresa.php';
include_once 'CodigoFuente/Entidades/Pasajero.php';
include_once 'CodigoFuente/Entidades/Responsable.php';
include_once 'CodigoFuente/Entidades/Viaje.php';
include_once 'CodigoFuente/Entidades/ViajePasajero.php';
include_once 'CodigoFuente/Utilidades/funcionMenu.php';
include_once 'CodigoFuente/Utilidades/InteraccionPersona.php';
include_once 'CodigoFuente/Utilidades/InteraccionPasajero.php';
include_once 'CodigoFuente/Utilidades/InteraccionResponsable.php';
include_once 'CodigoFuente/Utilidades/InteraccionEmpresa.php';
include_once 'CodigoFuente/Utilidades/InteraccionViaje.php';
include_once 'CodigoFuente/Utilidades/InteraccionViajePasajero.php';


$salir = false;
while (!$salir){
$mostrarMenu = strtolower(trim(readline("Desea Mostrar el menu? (si/no): ")));
    if ($mostrarMenu === "si"){
        echo menuInteractivo();
        $opcion = (int)readline("Ingresar opción deseada: ");
        switch ($opcion) {
    // -------------------- OPERACIONES PERSONA --------------------
        // 1. ---- Ver Persona ----
            case 1:
                verPersonas();
            break;
        // 2. ---- Buscar Persona ----
            case 2:
                $tipoDoc = readline("Ingresar tipo de documento de la persona buscada: ");
                $numDoc = (int)readline("Ingresar número de documento de la persona buscada: ");
                buscarPersona($tipoDoc,$numDoc);
            break;
    // -------------------- OPERACIONES PASAJERO --------------------
        // 3. ---- Ver Pasajero ----
            case 3:
                verPasajeros();
            break;
        // 4. ---- Buscar Pasajero ---- 
            case 4:
                buscarPasajero();
            break;
        // 5. ---- Ingresar Pasajero ----
            case 5:
                ingresarPasajero();
            break;
        // 6. ---- Modificar Pasajero ----
            case 6:
                echo "¿Qué desea modificar?\n";
                echo "1. Solo los datos de la persona (nombre, apellido, teléfono)\n";
                echo "2. Solo los datos del pasajero (nacionalidad, necesidad de asistencia)\n";
                echo "3. Ambos\n";
                $opcion = readline("Ingrese una opción (1/2/3): ");
                switch ($opcion) {
                    case "1":
                        modificarPersona();
                        break;
                    case "2":
                        modificarPasajero();
                        break;
                    case "3":
                        modificarPersona();
                        modificarPasajero();
                        break;
                    default:
                        echo "Opción inválida.\n";
                }
            break;
        // 7. ---- Eliminar Pasajero ----
            case 7:
                echo "¿Qué desea eliminar?\n";
                echo "1. Eliminar datos personales? (nombre, apellido, teléfono)\n";
                echo "   ❗ Al eliminar registros personales tambien se borrara su registro como pasajero en el sistema.\n";
                echo "2. Eliminar registro como pasajero? (nacionalidad, necesidad de asistencia)\n";
                echo "   ❗ Al eliminar registros de pasajero su registro como persona seguira existiendo en el sistema.\n";
                $opcion = readline("Ingrese una opción (1/2): ");
                switch ($opcion) {
                    case "1":
                        eliminarPersona();
                    break;
                    case "2":
                        eliminarPasajero();
                    break;
                    default:
                        echo "Opción inválida.\n";
                }
            break;
    // -------------------- OPERACIONES RESPONSABLE --------------------
        // 8. ---- Ver Responsable ----
            case 8:
                verResponsables();
            break;
        // 9. ---- Buscar Responsable ----
            case 9:
                buscarResponsable(); // Chequear
            break;
        // 10. ---- Ingresar Responsable ----
            case 10:
                ingresarResponsable();
            break;
        // 11. ---- Modificar Responsable ----
            case 11:
                echo "¿Qué desea modificar?\n";
                echo "1. Solo los datos de la persona (nombre, apellido, teléfono)\n";
                echo "2. Solo los datos del responsable (numero de empleado, legajo)\n";
                echo "3. Ambos\n";
                $opcion = readline("Ingrese una opción (1/2/3): ");
                switch ($opcion) {
                    case "1":
                        modificarPersona();
                        break;
                    case "2":
                        modificarResponsable();
                        break;
                    case "3":
                        modificarPersona();
                        modificarResponsable();
                        break;
                    default:
                        echo "Opción inválida.\n";
                }
            break;
        // 12. ---- Eliminar Responsable ----
            case 12:
                echo "¿Qué desea eliminar?\n";
                echo "1. Eliminar datos personales? (nombre, apellido, teléfono)\n";
                echo "   ❗ Al eliminar registros personales tambien se borrara su registro como responsable en el sistema.\n";
                echo "2. Eliminar registro como responsable? (numero de empleado, legajo)\n";
                echo "   ❗ Al eliminar registros de responsable su registro como persona seguira existiendo en el sistema.\n";
                $opcion = readline("Ingrese una opción (1/2): ");
                switch ($opcion) {
                    case "1":
                        eliminarPersona();
                    break;
                    case "2":
                        eliminarResponsable();
                    break;
                    default:
                        echo "Opción inválida.\n";
                }
            break;
    // -------------------- OPERACIONES EMRESA --------------------
        // 13. ---- Ver Empresas ----
            case 13:
                verEmpresas();
            break;
        // 14. ---- Buscar Empresas ----
            case 14:
                buscarEmpresa();
            break;
        // 15. ---- Ingresar Empresas ----
            case 15:
                ingresarEmpresa();
            break;
        // 16. ---- Modificar Empresas ----
            case 16:
                modificarEmpresa();
            break;
        // 17. ---- Eliminar Empresas ----
            case 17:
                eliminarEmpresa();
            break;
    // -------------------- OPERACIONES VIAJES --------------------
        // 18. ---- Ver Viajes ----
            case 18:
                verViajes();
            break;
        // 19. ---- Buscar Viajes ----
            case 19:
                buscarViaje();
            break;
        // 20. ---- Ingresar Viajes ----
            case 20:
                ingresarViaje();
            break;
        // 21. ---- Modificar Viajes ----
            case 21:
                modificarViaje();
            break;
        // 22. ---- Eliminar Viajes ----
            case 22:
                eliminarViaje();
            break;
    // -------------------- OPERACIONES VIAJE_PASAJERO --------------------
        // 23. ---- Ver Viajes Pasajeros ----
            case 23:
                verViajesPasajeros();
            break;
        // 24. ---- Buscar Viajes Pasajeros ----
            case 24:
                buscarViajesPasajeros();
            break;
        // 25. ---- Ingresar Viajes Pasajeros ----
            case 25:
                ingresarViajePasajeros();
            break;
        // 26. ---- Modificar Viajes Pasajeros ----
            case 26:
                modificarViajePasajero();
            break;
        // 27. ---- Eliminar Viajes Pasajeros ----
            case 27:
                eliminarViajePasajero();
            break;
    // -------------------- SALIR --------------------
        // 28. ---- Salir ----
            case 28:
                echo "Saliendo...\n";
                $salir = true;
            break;
            default:
                echo"\n-------------- Opción invalida --------------\n";
            break;
        }
    } else {
        echo "Saliendo...\n";
        $salir = true;
    }
}
?>