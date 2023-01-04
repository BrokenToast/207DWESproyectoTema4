<?php
require_once('DBexception.php');
class processDB{
    /**
     * Clase que nos permite gestionar una base de datos.
     * @var PDO $oconexionDB Conexion a la base de datos
     */
    private PDO $oconexionDB;
    /**
     * 
     * @param PDO $conexionDB Conexion a la base de datos
     */
    public function __construct(PDO $conexionDB){
        $this->oconexionDB = $conexionDB;
    }
    /**
     * Nos permite cambiar la conexion a la base de datos.
     * @param PDO $conexionDB Conexio a la base de datos
     */
    public function setConexionDB(PDO $conexionDB){
        $this->oconexionDB = $conexionDB;
    }
    /**
     * Metodo que no permite lanzar un quiery y nos devuelve la información en una array
     * @param string $query Query que se va a ejecutar.
     * @throws DBexception Se lanza cuando hay un error con el query
     * @return array devuelve una array con la información del Quer(Formato: [[tupla1],[tupla..],[tupla..]])
     */
    public function executeQuery(string $query){
        $aresultado = [];
        try{
            $oresultado=$this->oconexionDB->query($query);
            $oresultado->fetchObject();
            foreach($oresultado as $value){
                array_push($aresultado,$value);
            }
        }catch(PDOException $error){
            throw new DBexception($error);
        }finally{
            unset($oPrepareSQL);
        }
        return $aresultado;
    }
    /**
     * executeIUD
     * Nos permite ejecutar insert, update y delete.
     * @param string $query insert, update y delete(SQL).
     * @throws DBexception Se lanza cuando a ocurrido un error.
     * @return bool|int, nos devuelve flase si a ocurrido un error y si se a ejecutado bien devuelve el numero de tuplas afectadas.
     */
    public function executeIUD(string $query){
        try{
            $ok=$this->oconexionDB->exec($query);
        }catch(PDOException $error){
            throw new DBexception($error);
        }finally{
            unset($oPrepareSQL);
        }
        return $ok;
    }
}