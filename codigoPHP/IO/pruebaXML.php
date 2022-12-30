<?php
require_once('ioxml.php');

$nivel1 = ["nombre","luis",["edad"=>"20"]];
$nivel2 = ["persona",
    [
        ["nombre","pepe"],
        ["apellidos","aaa bbb"]
    ],
    ["dni"=>"12345678Z"]
];
$nivel3 = ["persona",
    [
        ["nombre","pepe"],
        ["apellidos","aaa bbb"],
        ["coche",
            [
                ["marca","renault"],
                ["modelo","kadjack"],
                ["matricula","45345gfd"]
            ]
        ]
    ],
    ["dni"=>"12345678Z"]
];
$error1 = ["persona",
    [
        ["nombre","pepe"],
        ["apellidos","aaa bbb"],
        ["coche",
            [
                ["marca","renault"],
                ["modelo","kadjack"],
                ["matricula","45345gfd"]
            ]
        ]
    ],
    "hola"
];
IOXML::writeDocument("./hola.xml",$nivel3);
