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
                * Fecha Modification: 15/11/2022
                */
                // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
                require_once '../config/confConexion.php';
                require_once '../core/221024ValidacionFormularios.php';  
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
                    // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                    $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                    //Establecemos los atributos para configurar los errores de PDO
                    $odbDepartamentos->beginTransaction();
                    $odbDepartamentos->exec("insert into T02_Departamento values(\"AAA\",\"aaaaaaaa\",".time().",4554.54,null)");
                    $odbDepartamentos->exec("insert into T02_Departamento values(\"BBB\",\"bbbbbbbb\",".time().",4534.3,null)");
                    $odbDepartamentos->exec("insert into T02_Departamento values(\"CCC\",\"bbbbbbbb\",".time().",3654.3,null)");
                    $odbDepartamentos->commit();
                    ?> <p>"Se a insertado con exito"</p> <?php
                } catch (PDOException $th) {
                    print $th->getMessage();
                }finally{
                    //Cerramos la conexion
                    imprimirTabla($odbDepartamentos->query(sprintf('select * from T02_Departamento')));
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