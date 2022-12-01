<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio02</title>
</head>
<body>
    <header>
        <h1>2. Mostrar el contenido de la tabla Departamento y el número de registros.</h1>
    </header>
    <section>
        <article>
        <?php
            /**
            * EjercicioPDO 2
            * @author: Luis Pérez Astorga
            * @version: 1.1
            * Fecha Modification: 15/11/2022
            */
            // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
            require_once '../config/confConexion.php';
            function imprimirTabla(PDOStatement $resultado){
                $aRespuestaQuery=$resultado->fetch(PDO::FETCH_ASSOC);
                ?> 
                <table>
                    <?php
                        ?> <tr> <?php
                            foreach($aRespuestaQuery as $nombreCampo=>$valor){
                                ?> <th> <?php print $nombreCampo; ?></th> <?php
                            }
                        ?> </tr> <?php
                        while($aRespuestaQuery!=null){
                            ?> <tr> <?php
                            foreach($aRespuestaQuery as $valorColumna){
                                ?> <td> <?php print $valorColumna; ?></td> <?php
                            }
                            ?> </tr> <?php
                            $aRespuestaQuery=$aRespuestaQuery=$resultado->fetch(PDO::FETCH_ASSOC);
                        } 
                    ?>
                </table>
            <?php }
            try {
                ?> <h1>Conexion 1</h1> <?php
                // Conexion correcta
                // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                //Establecemos los atributos para configurar los errores de PDO
                $odbDepartamentos->setAttribute(PDO::ERRMODE_WARNING,PDO::ERRMODE_EXCEPTION);
                //Almacenamos el resultado del query(PDOStatement)
                $oResultadoDB=$odbDepartamentos->query("SELECT * FROM T02_Departamento");
                imprimirTabla($oResultadoDB);
                ?> 
                    <!-- Mostramos el numero de tuplas. -->
                    <p>Hay <?php print $oResultadoDB->rowCount();?> registros</p>
                <?php
            } catch (PDOException $errorPDO) {
                //En caso de que falle nos muestra el Error
                print($errorPDO->getMessage());
            }finally{
                //Cerramos la conexion
                unset($conexion);
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