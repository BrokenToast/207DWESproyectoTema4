<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio06</title>
</head>
<body>
    <header>
        <h1>6. Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos
            utilizando una consulta preparada.</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * EjercicioPDO 6
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * @since 15/11/2022
                */
                // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
                require_once '../config/confConexion.php';
                require_once '../core/IO/ioxml.php';
                require_once '../core/DB/processDB.php';
                $oconectorSQL = new processDB(new PDO(HOSTPDO,USER,PASSWORD));
                $aDocumentXML=IOXML::readDocument("../doc/importar.xml");
                foreach($aDocumentXML[1] as $departamento){
                    $codDepartamento=$departamento[2]['T02_CodDepartamento'];
                    $descDepartamento=$departamento[1][0][1];
                    $fechaCreacion=(int)$departamento[1][1][1];
                    $volumenNegocio=(float)$departamento[1][2][1];
                $oconectorSQL->executeIUD("INSERT into T02_Departamento values('$codDepartamento','$descDepartamento',$fechaCreacion,$volumenNegocio,null)");
                }
                
                ?>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../../index.html"><img src="../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../index.php"><img src="../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>