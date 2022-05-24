<?php

//Busca
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);


//filtro de status
$filtroStatus = filter_input(INPUT_GET, 'status', FILTER_SANITIZE_STRING);
$filtroStatus = in_array($filtroStatus,[]) ? $filtroStatus :  null;

$condições = [
    strlen($busca) ? 'nome LIKE "%'.str_replace('', '%', $busca).'%" ' : null,
    strlen($filtroStatus) ? 'categoria = "'.$filtroStatus.'"' : null
];

$condições = array_filter($condições);