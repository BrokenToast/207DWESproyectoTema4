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
        utilizando una consulta preparada. (Después de programar y entender este ejercicio, modificar los
        ejercicios anteriores para que utilicen consultas preparadas). Probar consultas preparadas sin bind,
        pasando los parámetros en un array a execute.</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * EjercicioPDO 6
                * @author: Luis Pérez Astorga
                * @version: 1.0
                * Fecha Modification: 15/11/2022
                */
                // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
                require_once '../config/confConexion.php';
                require_once '../core/221024ValidacionFormularios.php';
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
                $aDatosConsulta=[
                    ["XXX","dddddddd",4534.44],
                    ["YYY","eeeeeeee",4534.44],
                    ["QQQ","ffffffff",4534.44]
                ];               
                try {
                    // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                    $odbDepartamentos=new mysqli(HOST,USER,PASSWORD,DATABASE,PORT);
                    //Establecemos los atributos para configurar los errores de PDO
                    foreach( $aDatosConsulta as $fila){
                        $oQuery=$odbDepartamentos->prepare("insert into T02_Departamento values(?,?,".time().",?,null)");
                        $oQuery->bind_param("ssd",$fila[0],$fila[1],$fila[2]);
                        $oQuery->execute();
                    }
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