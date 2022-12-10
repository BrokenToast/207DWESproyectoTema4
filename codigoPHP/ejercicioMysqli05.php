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
        <h1>5. Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
        insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * EjercicioPDO 5
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * @since 15/11/2022
                */
                // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
                require_once '../config/confConexion.php';
                require_once '../core/221024ValidacionFormularios.php';
                /**
                * imprimirTabla 
                * Nos permite imprimir una tabla con el contenido de la respuesta de la base de datos.
                * @param  mysqli_result $resultado Resultado de la base de datos.
                * @return void
                */  
                function imprimirTabla(mysqli_result $resultado){
                    $aRespuestaQuery=$resultado->fetch_row();
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
                                $aRespuestaQuery=$aRespuestaQuery=$resultado->fetch_row();
                            } 
                        ?>
                    </table>
                <?php }             
                try {
                    // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                    $odbDepartamentos=new mysqli(HOST,USER,PASSWORD,DATABASE,PORT);
                    // Si se le damos a enviar y descripción no esta vacia muestra los restados de buscar la descripcion en la base de datos.
                    // Y si no se da a enviar y la descripción esta vacias se muestra todo el contenido de la base de datos.
                    $odbDepartamentos->autocommit(false);
                    $odbDepartamentos->query("insert into T02_Departamento values(\"MMM\",\"aaaaaaaa\",".time().",4554.54,null)");
                    $odbDepartamentos->query("insert into T02_Departamento values(\"NNN\",\"bbbbbbbb\",".time().",4534.3,null)");
                    $odbDepartamentos->query("insert into T02_Departamento values(\"OOO\",\"bbbbbbbb\",".time().",3654.3,null)");
                    $odbDepartamentos->commit();
                    ?> <p>"Se a insertado con exito"</p> <?php
                } catch (Exception $th) {
                    print $th->getMessage();
                }finally{
                    //Cerramos la conexion
                    imprimirTabla($odbDepartamentos->query('select * from T02_Departamento'));
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