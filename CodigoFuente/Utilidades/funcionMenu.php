<?php
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
        "1- Ver Personas\n" .
        "2- Buscar Persona\n" .
        "\n" . // Separador para claridad
        "3- Ver Pasajeros\n" .
        "4- Buscar Pasajero\n" .
        "5- Ingresar Pasajero\n" .
        "6- Modificar Pasajero\n" .
        "7- Eliminar Pasajero\n" .
        "\n" . // Separador para claridad
        "8- Ver Responsables\n" .
        "9- Buscar Responsable\n" .
        "10- Ingresar Responsable\n" .
        "11- Modificar Responsable\n" .
        "12- Eliminar Responsable\n" .
        "\n" . // Separador para claridad
        "13- Ver Empresas\n" .
        "14- Buscar Empresa\n" .
        "15- Ingresar Empresa\n" .
        "16- Modificar Empresa\n" .
        "17- Eliminar Empresa\n" .
        "\n" . // Separador para claridad
        "18- Ver Viajes\n" .
        "19- Buscar Viaje\n" .
        "20- Ingresar Viaje\n" .
        "21- Modificar Viaje\n" .
        "22- Eliminar Viaje\n" .
        "\n" . // Separador para claridad
        "23- Ver Viajes de Pasajeros (Vinculaciones)\n" .
        "24- Buscar Viaje de Pasajero (Vinculación específica)\n" .
        "25- Ingresar Vinculación Viaje-Pasajero\n" .
        "26- Modificar Vinculación Viaje-Pasajero\n" .
        "27- Eliminar Vinculación Viaje-Pasajero\n" .
        "\n" . // Separador para claridad
        "28- Salir\n" .
        "--------------------------\n"
    );
    return $cadena;
}
?>