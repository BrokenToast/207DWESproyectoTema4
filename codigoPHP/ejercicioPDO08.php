<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio08</title>
</head>
<body>
    <header>
        <h1>Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un
        fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se
        encuentra en el directorio .../tmp/ del servidor.</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * EjercicioPDO 8
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * @since 3/1/2023
                */
                require_once '../config/confConexion.php';
                require_once '../core/221024ValidacionFormularios.php';
                require_once '../core/DB/processDB.php';
                require_once '../core/IO/ioxml.php';

                $odbDepartamentos;

                $respuesta;

                $queryAll=<<<SQL
                    select * from T02_Departamento;
                SQL;
                $oconectorSQL = new processDB(new PDO(HOSTPDO,USER,PASSWORD));
                $aRespuesta=$oconectorSQL->executeQuery($queryAll);
                $aXMLDocument = [
                    "Departamentos",
                    []
                ];
                foreach($aRespuesta as $aTupla){
                    $aKeys=array_keys($aTupla);
                    $aDepartamento=[
                        "Departamento",
                        [
                            ["T02_DescDepartamento",$aTupla[1]],
                            ["T02_FechaDeCreacionDepartamento",$aTupla[2]],
                            ["T02_VolumenDeNegocio",$aTupla[3]],
                            ["T02_FechaBajaDepartamento",$aTupla[4]]
                        ],
                        ["T02_CodDepartamento"=>$aTupla[0]]
                    ];
                    array_push($aXMLDocument[1],$aDepartamento);

                }
                IOXML::writeDocument("/tmp/departamentos.xml",$aXMLDocument); 
                ?>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../../index.html"><img src="../../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../../index.php"><img src="../../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>