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
        * EjercicioMysqli 1
        * @author: Luis Pérez Astorga
        * @version: 1.0
        * @since 8/11/2022
        */
        // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
        require_once '../config/confConexion.php';
        try {
            ?> <h1>Conexion 1</h1> <?php
            // Conexion correcta
            // Instaciamos un objeto de la clase mysqli con la configuracion de la conexión(bien)
            $oconexion1=new mysqli(HOST,USER,PASSWORD,DATABASE,PORT);
            ?> <table> <?php
                foreach($oconexion1->get_connection_stats() as $nombreCampo=>$valorCampo){
                    ?> 
                    <tr>
                        <th><?php print $nombreCampo;?></th>
                        <td><?php print $valorCampo;?></td>
                    </tr>
                    <?php
                }
            ?> </table> <?php
            ?> 
                <p>Conexion establecida</p>
                <h1>Conexion 2</h1> 
            <?php
            // Conexion que falla
            // Instaciamos un objeto de la clase mysqli con la configuracion de la conexión(Mal)
            $oconexion2=new mysqli(HOST,USER,"Paso2",DATABASE,PORT);
            ?> <p>Conexion establecida</p> <?php
        } catch (Exception $th) {
            //En caso de que falle nos muestra el Error
            print $th->getMessage();
        }finally{
            //Cerramos la conexion
            $oconexion1->close();
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