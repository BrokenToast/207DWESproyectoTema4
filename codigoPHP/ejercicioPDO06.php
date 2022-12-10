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
                require_once '../core/221024ValidacionFormularios.php';
                /**
                * imprimirTabla 
                * Nos permite imprimir una tabla con el contenido de la respuesta de la base de datos.
                * @param  PDOStatement $resultado Resultado de la base de datos.
                * @return void
                */ 
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
                // Declaración de una array con el contenido los datos que se van a añadir en la tabla.
                $aDatosConsulta=[
                    ["DDD","dddddddd",4534.44],
                    ["EEE","eeeeeeee",4534.44],
                    ["FFF","ffffffff",4534.44]
                ];               
                try {
                    // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                    $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                    // Recorremos la Array aDatosInsercion y los insetamos en la tabla. 
                    foreach( $aDatosConsulta as $fila){
                        $oQuery=$odbDepartamentos->prepare("insert into T02_Departamento values(?,?,".time().",?,null)");
                        $oQuery->bindValue(1,$fila[0]);
                        $oQuery->bindValue(2,$fila[1]);
                        $oQuery->bindValue(3,$fila[2]);
                        $oQuery->execute();
                    }
                    ?> <p>"Se a insertado con exito"</p> <?php
                } catch (Exception $th) {
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