<?php
include("tateti.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */





/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * 1
 * ejemplos de juego
 * @return array $coleccionjuegos
 */

function cargarJuegos (){
    $coleccionJuegos[0] = ["jugadorCruz" => "juan", "jugadorCirculo" => "pepe", "puntosCruz" => 5, "puntosCirculo" => 0];
    $coleccionJuegos[1] = ["jugadorCruz"=> "juan" , "jugadorCirculo" => "lucho", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[2] = ["jugadorCruz"=> "lucho" , "jugadorCirculo" => "bruno", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[3] = ["jugadorCruz"=> "lucho" , "jugadorCirculo" => "juan", "puntosCruz"=> 5, "puntosCirculo" => 0];
    $coleccionJuegos[4] = ["jugadorCruz"=> "bruno" , "jugadorCirculo" => "bruno", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[5] = ["jugadorCruz"=> "juan" , "jugadorCirculo" => "pedro", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[6] = ["jugadorCruz"=> "pedro" , "jugadorCirculo" => "juan", "puntosCruz"=> 5, "puntosCirculo" => 0];
    $coleccionJuegos[7] = ["jugadorCruz"=> "lucho" , "jugadorCirculo" => "juan", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[8] = ["jugadorCruz"=> "lucho" , "jugadorCirculo" => "juan", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[9] = ["jugadorCruz"=> "pedro" , "jugadorCirculo" => "bruno", "puntosCruz"=> 5, "puntosCirculo" => 0];
    $coleccionJuegos[10] = ["jugadorCruz"=> "miguel" , "jugadorCirculo" => "lucho", "puntosCruz"=> 1, "puntosCirculo" => 1];
    $coleccionJuegos[11] = ["jugadorCruz"=> "juan" , "jugadorCirculo" => "miguel", "puntosCruz"=> 1, "puntosCirculo" => 1];
        return ($coleccionJuegos);
}

/**
 * 2
 * Metodo que intenta resolver el punto 2 EXPLICACION 3
 * visualiza el menu de opciones y retona una opcion valida
 * @return int
 */
 
function selectionarOpcion(){
    do {
        echo "INGRESE UNA OPCION" . "\n";
        echo "1) Jugar al tateti" . "\n";
        echo "2) Mostrar un juego" . "\n";
        echo "3) Mostrar el primer juego ganador" . "\n";
        echo "4) Mostrar porcentaje de Juegos ganados" . "\n";
        echo "5) Mostrar resumen de Jugador" . "\n";
        echo "6) Mostrar listado de juegos Ordenado por jugador O" . "\n";
        echo "7) Salir" . "\n";
        $opcion = trim(fgets(STDIN));
        if (!(is_int($opcion)) && !($opcion >= 1 && $opcion <= 7)) {
            echo "Opcion NO Valida." . "\n";
        }
    } while (!(is_int($opcion)) && !($opcion >= 1 && $opcion <= 7));
    return $opcion;
}



 
/**
 * 3
 * Solicita al usuario un número en el rango [$min,$max]
 * @param int $min
 * @param int $max
 * @return int 
 */

function solicitarNumeroEntre($min, $max){
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/**
 * 4
 * muestra en pantalla los datos del juego
 * @param int $numJuego
 * @return array
 */
function datosDelJuego($numJuego){
    //$imprimir 
    $imprimir=imprimirResultado($numJuego);
    return $imprimir;
}

/**
 * 5
 * retorna la coleccion modificada de juegos
 * @param array $coleccionJuejos
 * @param array $juego
 * @return array
 */
function agregarJuego ($coleccionJuegos,$juego){
    //int $contador
    $contador=count($coleccionJuegos);
    $coleccionJuegos[$contador]=$juego;
    return $coleccionJuegos;
}

/**
 * 6
 * retorna el primer juego ganado 
 * @param array $juegoGanado
 * @param string $clavejugador
 * @return int
 */
function primerJuegoGanado ($juegoGanado,$claveJugador){
    $recorridoParcial=count($juegoGanado);
    $i=0;
    $ganador=false;
    $indice=-1;
    while ($i < $recorridoParcial && !$ganador) {
       if ($juegoGanado[$i]["jugadorCruz"]==$claveJugador) {
           if ($juegoGanado[$i]["jugadorCruz"]>$juegoGanado[$i]["jugadorCirculo"]) {
               $ganador=true;
               $indice=$i;
           }
       }elseif ($juegoGanado[$i]["jugadorCirculo"]==$claveJugador) {
           if ($juegoGanado[$i]["jugadorCruz"]<$juegoGanado[$i]["jugadorCirculo"]) {
               $ganador=true; 
               $indice=$i;
           }
       }
    $i++;   
    }
    return $indice;
}

/**
 * 7
 * retorna el resumen del jugador
 * @param array $juegosJugados
 * @param string $claveNombre
 * @return array
 */
function resumenJugador ($juegosJugados,$claveNombre){
    $nombre="";
    $juegoGanado=0;
    $juegoPerdidos=0;
    $juegosEmpatados=0;
    $puntosAcumulados=0;

    $juegosJugados=["nombre"=>" ", "juegosGanados"=>0 , "juegosPerdidos"=> 0, "juegosEmpatados"=>0 , "puntosAcumulados"=>0];


    $exaustivo=count($juegosJugados);

    for ($i=0; $i <$exaustivo ; $i++) { 
        $jugadorCruz = $juegosJugados[$i]["jugadorCruz"];
        $jugadorCirculo = $juegosJugados[$i]["jugadorCirculo"];
        $puntosCruz = $juegosJugados[$i]["puntosCruz"];
        $puntosCirculo = $juegosJugados[$i]["puntosCirculo"];

        if ($juegosJugados[$i]["jugadorCruz"] == $claveNombre) {
           $nombre=$claveNombre;
           if ($juegosJugados[$i]["puntosCruz"] > $juegosJugados[$i]["puntosCirculo"]) {
               $juegoGanado=$juegoGanado+1;
               $puntosAcumulados=$puntosAcumulados+$puntosCruz;
           }
           if ($juegosJugados[$i]["puntosCruz"] < $juegosJugados[$i]["puntosCirculo"]) {
               $juegoPerdidos=$juegoPerdidos+1; 
           }
           if ($juegosJugados[$i]["puntosCruz"] == $juegosJugados[$i]["puntosCirculo"]){
                $juegosEmpatados=$juegosEmpatados+1;
                $puntosAcumulados=$puntosAcumulados+$puntosCruz;
           }


        }
    }
}



//hecho por German
/**
 * 8
 * retorna el nombre del jugador ganador o empate.
 * @param array $arreglo
 * @return string $arreglo["jugadorCirculo"]
 */
function retornarNombreGanador($arreglo)
{
    if($arreglo["puntosCruz"]>$arreglo["puntosCirculo"])
    {
        return $arreglo["jugadorCruz"];
    }
    elseif($arreglo["puntosCruz"]==$arreglo["puntosCirculo"])
        {
            return "Empate!";
        }    
    else
    {
    return $arreglo["jugadorCirculo"];
    }
}

/**
 * lista a las partidas ordenadas por el jugador O
 * ***SWITCH*****
 */
function MostrarOrdenadoPorJugadorO(){
$juegos=cargarJuegos();
uasort($juegos,'cmp');

foreach($juegos as $pos=>$juego)
{   
    echo "Juego #". sprintf("% -2d",$pos+1). " Jugador Circulo: ".sprintf("%-10s", $juego["jugadorCirculo"])." Jugador Cruz: ".sprintf("%-10s",$juego["jugadorCruz"])." Ganador: ".retornarNombreGanador($juego) .  "\n";
}
}
/*
 * funcion interna para comparacion de elementos del array.
 */
function cmp($a, $b) {
    return strcmp($a["jugadorCirculo"], $b["jugadorCirculo"]);
}






















/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

//$juego = jugar();
//print_r($juego);
//imprimirResultado($juego);



/*
do {
    $opcion = ...;
    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1
            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2
            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3
            break;
        
            //...
    }
} while ($opcion != X);
*/





