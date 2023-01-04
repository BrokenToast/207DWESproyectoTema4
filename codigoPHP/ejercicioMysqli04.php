<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio04</title>
</head>
<body>
    <header>
        <h1>4. Formulario de búsqueda de departamentos por descripción (por una parte del campo DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).</h1>
    </header>
    <section>
        <?php
        /**
        * EjercicioPDO 4
        * @author: Luis Pérez Astorga
        * @version: 1.0
        * @since 8/11/2022
        */
        // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
        require_once '../config/confConexion.php';
        /**
        * imprimirTabla 
        * Nos permite imprimir una tabla con el contenido de la respuesta de la base de datos.
        * @param  mysqli_result $resultado Resultado de la base de datos.
        * @return void
        */  
        function imprimirTabla(mysqli_result $resultado){
            $aRespuestaQuery=$resultado->fetch_object();
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
                        $aRespuestaQuery=$aRespuestaQuery=$resultado->fetch_object();
                    } 
                ?>
            </table>
        <?php
        }
        ?>
        <article>
            <?php
                require_once '../core/221024ValidacionFormularios.php';                
                // Variable centinela 
                ?> 
                    <form action="ejercicioMysqli04.php" method="post">
                    <!--Si hay un error en aErrores del campo pes se muestra un error en pantalla y si esta mal el alguno de los compos
                    menos esta mal, guarda el dato introducido-->
                    <label for="descripcion">Introduce tu descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" value="<?php (isset($_REQUEST['enviar']))?print $_REQUEST['descripcion']:'';?>">
                    <br><br>
                    <input type="submit" name="enviar" value="Buscar">
                    <?php
                        try {
                            // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                            $odbDepartamentos=new mysqli(HOST,USER,PASSWORD,DATABASE,PORT);
                            $ok=false;
                            if(isset($_REQUEST['enviar']) && empty(validacionFormularios::comprobarAlfabetico($_REQUEST['descripcion']))){
                                $ok=true;
                            }
                            // Si se le damos a enviar y descripción no esta vacia muestra los restados de buscar la descripcion en la base de datos.
                            // Y si no se da a enviar y la descripción esta vacias se muestra todo el contenido de la base de datos.
                            if($ok && !empty($_REQUEST['descripcion'])){
                                $descriocionSinPeligro="%".preg_replace("/[-'\s\"]+/s","",$_REQUEST['descripcion'])."%";

                                $oQuertPreparado=$odbDepartamentos->prepare("select * from T02_Departamento where T02_DescDepartamento like ?");
                                $oQuertPreparado->bind_param("s",$descriocionSinPeligro);
                                $oQuertPreparado->execute();

                                $oResultadoQuery=$oQuertPreparado->get_result();
                                // Si la respuesta tine mas de 1 una tupla, se muestra y si no muestra un mensaje.
                                if($oResultadoQuery->num_rows>0){
                                    imprimirTabla($oResultadoQuery);
                                }else{
                                    print "No se han econtrado resultados";
                                }
                            }else{
                                imprimirTabla($odbDepartamentos->query('select * from T02_Departamento'));
                            }
                        } catch (PDOException $errorPDO) {
                            //En caso de que falle nos muestra el Error
                            print($errorPDO->getMessage());
                        }finally{
                            unset($odbDepartamentos);
                        }
                    ?>
            </form>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../../index.html"><img src="../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../index.php"><img src="../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>