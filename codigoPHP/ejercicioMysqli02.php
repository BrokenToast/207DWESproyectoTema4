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
        * EjercicioMysqli 2
        * @author: Luis Pérez Astorga
        * @version: 1.1
        * Fecha Modification: 15/11/2022
        */
        // Llamamos a un archivo externo donde se alamcena la configuracionde la conexion
        require_once '../config/confConexion.php';
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
                        $aRespuestaQuery=$aRespuestaQuery=$resultado->fetch_row();
                    } 
                ?>
            </table>
        <?php }
        try {
            ?> <h1>Conexion 1</h1> <?php
            // Conexion correcta
            // Instaciamos un objeto de la clase mysqli con la configuracion de la conexión(bien)
            $odbDepartamentos=new mysqli(HOST,USER,PASSWORD,DATABASE,PORT);
            //Almacenamos el resultado del query(mysqli_result)
            $oResultadoDB=$odbDepartamentos->query("SELECT * FROM T02_Departamento");
            //Comvertimos la $oResultadoDB en una array
            imprimirTabla($oResultadoDB);
            ?> 
                <!-- Mostramos el numero de tuplas. -->
                <p>Hay <?php print $oResultadoDB->num_rows;?> tuplas</p>
        <?php
        } catch (Exception $th) {
            //En caso de que falle nos muestra el Error
            print $th->getMessage();
        }finally{
            //Cerramos la conexion
            $odbDepartamentos;
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