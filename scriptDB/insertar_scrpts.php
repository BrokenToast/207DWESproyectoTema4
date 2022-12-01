<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../webroot/style/reset.css">
    <link rel="stylesheet" href="../webroot/style/style.css">
    <link rel="stylesheet" href="../webroot/style/codigo.css">
    <title>Ejecutar Script</title>
</head>
<body>
    <header>
        <h1>Ejecutar Script</h1>
    </header>
    <section>
        <article>
        <?php
        require_once '../config/confConexion.php';
        if(isset($_REQUEST['ejecutar'])){
            // Cambiar estos parametros
            exec($_REQUEST['gdb']." -h ".HOST." -u admindb --password=".PASSWORD. "<" .$_REQUEST['script'],$respuesta);
            foreach($respuesta as $valor){
                print $valor;
            }
        }
        ?> 
        <form id="tableForm" action="insertar_scrpts.php" method="post">
            <table >
                <tr>
                    <td colspan="2"><h3>Ejecución de un script</h3></td>
                </tr>
                <tr>
                    <td><p>Gestor de bases de datos:</p></td>
                    <td>
                        <select name="gdb">
                            <option value="mariadb">Mariadb</option>
                            <option value="mysql">Mysql</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><p>Scripts:</p></td>
                    <td>
                        <select name="script">
                            <option value="./BorraDAW202DBDepartamentos.sql">BorraDAW202DBDepartamentos</option>
                            <option value="./CargaInicialDAW202DBDepartamentos.sql">CargaInicialDAW202DBDepartamentos</option>
                            <option value="./CreaDAW202DBDepartamentos.sql">CreaDAW202DBDepartamentos</option>

                            <option value="./BorraDAW202DBDepartamentosExplotacion.sql">BorraDAW202DBDepartamentosExplotacion</option>
                            <option value="./CargaInicialDAW202DBDepartamentosExplotacion.sql">CargaInicialDAW202DBDepartamentosExplotacion</option>
                            <option value="./CreaDAW202DBDepartamentosExplotacion.sql">CreaDAW202DBDepartamentosExplotacion</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><p></p></td>
                </tr>
                <tr>
                    <td colspan="2" id="botones">
                        <button name="ejecutar" type="submit" value="ejecutar">Ejecutar</button>
                    </td>

                </tr>
            </table>
        </form> 
    <?php
    ?>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../index.html"><img src="../../../doc/logo_Casa.png" alt="Pagina creador"></a>
            <a href="../index.php"><img src="../../../doc/atras.svg" alt="Atras"/></a>
    </footer>
</body>
</html>




