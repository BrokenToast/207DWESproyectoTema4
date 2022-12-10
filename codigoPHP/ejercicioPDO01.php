<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio01</title>
</head>
<body>
    <header>
        <h1>1.Conexión a la base de datos con la cuenta usuario y tratamiento de errores.</h1>
    </header>
    <section>
        <article>
        <?php
            /**
            * EjercicioPDO 1
            * @author: Luis Pérez Astorga
            * @version: 1.9
            * @since 8/11/2022
            */
            // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
            require_once '../config/confConexion.php';
            $aAtributo=[
                "PDO::ATTR_AUTOCOMMIT"=>PDO::ATTR_AUTOCOMMIT,
                "PDO::ATTR_CASE"=>PDO::ATTR_CASE,
                "PDO::ATTR_CLIENT_VERSION"=>PDO::ATTR_CLIENT_VERSION,
                "PDO::ATTR_CONNECTION_STATUS"=>PDO::ATTR_CONNECTION_STATUS,
                "PDO::ATTR_DRIVER_NAME"=>PDO::ATTR_DRIVER_NAME,
                "PDO::ATTR_ERRMODE"=>PDO::ATTR_ERRMODE,
                "PDO::ATTR_ORACLE_NULLS"=>PDO::ATTR_ORACLE_NULLS,
                //PDO::ATTR_PERSISTENT,
                //PDO::ATTR_PREFETCH,
                "PDO::ATTR_SERVER_INFO"=>PDO::ATTR_SERVER_INFO,
                "PDO::ATTR_SERVER_VERSION"=>PDO::ATTR_SERVER_VERSION,
                //PDO::ATTR_TIMEOUT
            ];
            try {
                ?> <h1>Conexion 1</h1> <?php
                // Conexion correcta
                // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                $oconexion1=new PDO(HOSTPDO,USER,PASSWORD);
                //Establecemos los atributos para configurar los errores de PDO
                $oconexion1->setAttribute(PDO::ERRMODE_WARNING,PDO::ERRMODE_EXCEPTION);
                //En caso de que conexion se establezca muesta el mensaje
                print("La conexion esta establecida");
                ?><div> 
                <table>
                    <tr>
                        <th>Atributo</th>
                        <th>Valor</th>
                    </tr> <?php
                foreach($aAtributo as $nombreAtributo=>$valorAtributo){
                    ?> 
                    <tr>
                        <td><?php print($nombreAtributo); ?></td>
                        <td><?php print($oconexion1->getAttribute($valorAtributo)); ?></td>
                    </tr>
                    <?php
                }
                ?> </table></div> <br><?php
                unset($oconexion1);
                ?> <h1>Conexion 2</h1> <?php
                // Conexion que falla
                // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(Mal)
                $oconexion2=new PDO(HOSTPDO,USER,'paso1');
                //Establecemos los atributos para configurar los errores de PDO
                $oconexion2->setAttribute(PDO::ERRMODE_WARNING,PDO::ERRMODE_EXCEPTION);
                //En caso de que conexion se establezca muesta el mensaje
                print("La conexion esta establecida");
            } catch (PDOException $errorPDO) {
                //En caso de que falle nos muestra el Error
                print($errorPDO->getMessage());
            }finally{
                //Cerramos la conexion
                unset($oconexion2);
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