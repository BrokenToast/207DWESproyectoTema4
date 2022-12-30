<?php
require_once('iojson.php');
$nivel3 = [
    "persona" => [
        "nombre" => "pepe",
        "apellidos" => "aaa bbb",
        "coche" => [
            "marca" => "renault",
            "modelo" => "kadjack",
            "matricula" => "45345gfd"
        ]
    ]
];
IOJSON::readDocument("./hola.txt");