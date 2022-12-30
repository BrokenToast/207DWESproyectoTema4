<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio05</title>
</head>
<body>
    <header>
        <h1>3. Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * EjercicioPDO 7
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * @since 8/11/2022
                */
                // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
                require_once '../config/confConexion.php';
                require_once '../core/221024ValidacionFormularios.php';

                $odbDepartamentos;

                $respuesta;

                $queryAll=<<<SQL
                    select * from T02_Departamento;
                SQL;
                try{
                    $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                    $respuesta=$odbDepartamentos->query($queryAll);
                    $oTbDepartamentos = $respuesta->fetchObject();
                }catch(PDOException $bug){
                    print $bug->getMessage();
                }
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