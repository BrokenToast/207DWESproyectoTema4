<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejercicio03</title>
</head>
<body>
    <header>
        <h1>3. Formulario para añadir un departamento a la tabla Departamento con validación de entrada y control de errores.</h1>
    </header>
    <section>
        <article>
            <?php
                /**
                * EjercicioPDO 3
                * @author: Luis Pérez Astorga
                * @version: 1.1
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
                    $aRespuestaQuery=$resultado->fetchObject();
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
                                $aRespuestaQuery=$aRespuestaQuery=$resultado->fetchObject();
                            } 
                        ?>
                    </table>
                <?php
                }             
                // Variable centinela 
                $entradaOK=false;
                if(isset($_REQUEST['enviar'])){
                    //Si esta el boton enviar se a pulsado
                    //Se valida el abrebiatura con el metodo OkAlfabetico si se produce un error el error se guarda en aErrores
                    $aErrores['abrebiatura']=validacionFormularios::comprobarAlfabetico($_REQUEST['abrebiatura'],3,3,1);
                    try {
                        $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                        $aQuery=$odbDepartamentos->query(sprintf('select T02_CodDepartamento from T02_Departamento where T02_CodDepartamento="%s"',$_REQUEST['abrebiatura']));
                        if($aQuery->fetchObject()){
                            $aErrores['abrebiatura']="EL codigo ".$_REQUEST['abrebiatura']." ya existe";
                        }
                    } catch (PDOException $th) {
                        print $th->getMessage();
                    }finally{
                        unset($odbDepartamentos);
                    }
                    //Se valida el descripcion con el metodo comprobarEntero si se produce un error el error se guarda en aErrores
                    $aErrores['descripcion']=validacionFormularios::comprobarAlfabetico($_REQUEST['descripcion'],maxTamanio:255,obligatorio:1);
                    //Se valida la volumenNegocio con el metodo okFecha si se produce un error el error se guarda en aErrores
                    $aErrores['volumenNegocio']=validacionFormularios::comprobarFloat($_REQUEST['volumenNegocio'],obligatorio:1);
                    //Declaramos el centinea a true
                    $entradaOK=true;
                    foreach($aErrores as $value){
                        if(!empty($value)){
                            //En caso de que en la aErrores haya un campo que no este vacion el ceninela se pone a false y rompe el bucle.
                            $entradaOK=false;
                            break;
                        }
                    }
                }
                if($entradaOK){
                    //Si el centinela es true para a procesar las respues.
                    // Almacena el campo abrebiatura del formulario en $aRespuesta
                    $aRespuesta['abrebiatura']=$_REQUEST['abrebiatura'];
                    // Almacena el campo descripcion del formulario en $aRespuesta
                    $aRespuesta['descripcion']=$_REQUEST['descripcion'];
                    // Almacena el campo volumenNegocio del formulario en $aRespuesta
                    $aRespuesta['volumenNegocio']=$_REQUEST['volumenNegocio'];
                    try {
                        // Instaciamos un objeto de la clase PDO con la configuracion de la conexión(bien)
                        $odbDepartamentos=new PDO(HOSTPDO,USER,PASSWORD);
                        $aQuery=$odbDepartamentos->prepare("INSERT INTO T02_Departamento VALUES(?,?,?,?,null)");
                        $aQuery->execute([$aRespuesta['abrebiatura'],$aRespuesta['descripcion'],time(),$aRespuesta['volumenNegocio']]);
                        imprimirTabla($odbDepartamentos->query('select * from T02_Departamento'));
                        ?> <p>Se a insertado el departamento con  exito</p> <?php
                    }catch (PDOException $th) {
                        print $th->getMessage();
                    }finally{
                        //Cerramos la conexion
                        unset($conexion);
                    }
                }else{
                    ?> 
                    <form action="ejercicioPDO03.php" method="post">
                        <table id="tableForm">
                            <tr>
                                <td><label for="abrebiatura">Introduce la abreviatura</label></td>
                                <td><input type="text" name="abrebiatura" id="abrebiatura" <?php if(isset($_REQUEST['enviar']) && empty($aErrores['abrebiatura'])){ printf('value="%s"',$_REQUEST['abrebiatura']); } ?>></td>
                                <td><p class="error">* <?php if(!empty($aErrores['abrebiatura'])){ ?><span style="color:red;"> <?php print $aErrores['abrebiatura'];?> </span><?php }?></p></td>
                            </tr>
                            <tr>
                                <td><label for="descripcion">Introduce tu descripcion</label></td>
                                <td><input type="text" name="descripcion" id="descripcion" <?php if(isset($_REQUEST['enviar']) && empty($aErrores['descripcion'])){ printf('value="%s"',$_REQUEST['descripcion']); } ?>></td>
                                <td><p class="error">* <?php if(!empty($aErrores['descripcion'])){ ?><span style="color:red;"> <?php print $aErrores['descripcion'];?> </span><?php }?></p></td>
                            </tr>
                            <tr>
                                <td><label for="volumenNegocio">Introduce el volumen del negocio </label></td>
                                <td><input type="text" name="volumenNegocio" id="volumenNegocio" <?php if(isset($_REQUEST['enviar']) && empty($aErrores['volumenNegocio'])){ printf('value="%s"',$_REQUEST['volumenNegocio']);} ?>></td>
                                <td><p class="error">* <?php if(!empty($aErrores['volumenNegocio'])){ ?><span style="color:red;"> <?php print $aErrores['volumenNegocio'];?> </span><?php }?></p></td>
                            </tr>
                            <tr>
                                <!-- Mensajes opcional -->
                            </tr>
                            <tr>
                                <td><input type="submit" name="enviar" value="Enviar"></td>
                            </tr>
                        </table>
                    </form>
                <?php } ?>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../../index.html"><img src="../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../index.php"><img src="../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>