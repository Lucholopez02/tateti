<?php

$auxPorcentaje = 0;

$gradosAtualesConvertidos = -1;

if($gradosAtualesConvertidos >= -6 && $gradosAtualesConvertidos < 0){
$auxPorcentaje = $auxPorcentaje + 1;
}




$porcentajeMenor0 = ($auxPorcentaje * 100) / $i;



echo "el porcentaje es ".$porcentajeMenor0."%";