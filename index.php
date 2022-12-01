<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../webroot/style/reset.css">
    <link rel="stylesheet" href="./webroot/style/style.css">
    <link rel="stylesheet" href="./webroot/style/webInicial.css">
    <title>Tema 4</title>
</head>
<body>
    <header>
        <h1>TEMA 4: TÉCNICAS DE ACCESO A DATOS EN PHP</h1>
    </header>
    <section>
        <article>
            <a id="ejecutor" href="./scriptDB/insertar_scrpts.php">Ejecucion de los Scripts</a>
            <table id="extras">
                <h2>Recursos Extras</h2>
                <thead>
                    <tr>
                        <th>Archivo</th>
                        <th>Desarrollo</th>
                        <th>Explotacion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Script de creacion</th>
                        <td><a href="./scriptDB/verCreaDAW202DBDepartamentos.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                        <td><a href="./scriptDB/verCreaDAW202DBDepartamentosExplotacion.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                    </tr>
                    <tr>
                        <th>Script de carga inicial</th>
                        <td><a href="./scriptDB/verCargaInicialDAW202DBDepartamentos.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                        <td><a href="./scriptDB/verCargaInicialDAW202DBDepartamentosExplotacion.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                    </tr>
                    <tr>
                        <th>Script de borrado</th>
                        <td><a href="./scriptDB/verBorraDAW202DBDepartamentos.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                        <td><a href="./scriptDB/verBorraDAW202DBDepartamentosExplotacion.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                    </tr>
                    <tr>
                        <th>Configuracion de la base de datos</th>
                        <td><a href="./config/verconfigDesarrollo.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                        <td><a href="./config/verconfigExplotacion.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                    </tr>
                    <tr>
                        <th>Libreria de validacion</th>
                        <td colspan="2"><a href="./core/mostrarValidacion.php"><img src="./doc/hoja_Papel.png" alt="Archivos"></a></td>
                    </tr>
                </tbody>
            </table>
            <h2>Ejericicios Tema 4</h2>
            <table>
                <tr>
                    <td></td>
                    <th colspan="2">PDO</th>
                    <th colspan="2">Mysqli</th>
                </tr>
                <tr>
                    <td>1.Conexión a la base de datos con la cuenta usuario y tratamiento de errores.</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO01.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO01.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli01.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli01.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>2. Mostrar el contenido de la tabla Departamento y el número de registros.</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO02.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO02.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli02.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli02.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>3. Formulario para añadir un departamento a la tabla Departamento con validación de entrada y
                        control de errores.</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO03.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO03.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli03.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli03.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>4. Formulario de búsqueda de departamentos por descripción (por una parte del campo
                        DescDepartamento, si el usuario no pone nada deben aparecer todos los departamentos).</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO04.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO04.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli04.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli04.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>5. Pagina web que añade tres registros a nuestra tabla Departamento utilizando tres instrucciones
                        insert y una transacción, de tal forma que se añadan los tres registros o no se añada ninguno.</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO05.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO05.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli05.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli05.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>6. Pagina web que cargue registros en la tabla Departamento desde un array departamentosnuevos
                        utilizando una consulta preparada. </td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO06.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO06.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli06.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli06.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>7. Página web que toma datos (código y descripción) de un fichero xml y los añade a la tabla
                        Departamento de nuestra base de datos. (IMPORTAR). El fichero importado se encuentra en el
                        directorio .../tmp/ del servidor.</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO07.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO07.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli07.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli07.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
                <tr>
                    <td>8. Página web que toma datos (código y descripción) de la tabla Departamento y guarda en un
                        fichero departamento.xml. (COPIA DE SEGURIDAD / EXPORTAR). El fichero exportado se
                        encuentra en el directorio .../tmp/ del servidor.
                        Si el alumno dispone de tiempo probar distintos formatos de importación - exportación: XML,
                        JSON, CSV, TXT,...
                        Si el alumno dispone de tiempo probar a exportar e importar a o desde un directorio (a elegir) en
                        el equipo cliente.</td>
                    <td class="PDO"><a href="./codigoPHP/ejercicioPDO08.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="PDO"><a href="./mostrarcodigo/muestraEjercicioPDO08.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                    <td class="Mysqli"><a href="./codigoPHP/ejercicioMysqli08.php"><img src="./doc/play.png" alt="Ejecutar"></a></td>
                    <td class="Mysqli"><a href="./mostrarcodigo/muestraEjercicioMysqli08.php"><img src="./doc/mostrar_codigo.png" alt="Mostrar"></a></td>
                </tr>
            </table>
        </article>
    </section>
    <footer>
            <p>Creado por Luis Pérez Astorga | Licencia GPL</p>
            <a href="../../index.html"><img src="../../doc/logo_Casa.png" alt="Pagina creador"></a>
    </footer>
</body>
</html>