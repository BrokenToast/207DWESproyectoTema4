<?php
require_once('io.php');
require_once('ioexception.php');
class IOJSON implements IO{
    /**
     * writeDocument
     * Guarda un archivo JSON a partir de una Array con el siguiente formato
     * [name=>value]
     * 
     * Ejemplos:
     * [
     * "persona" => [
     *     "nombre" => "pepe",
     *     "apellidos" => "aaa bbb",
     *     "coche" => [
     *         "marca" => "renault",
     *         "modelo" => "kadjack",
     *         "matricula" => "45345gfd"
     *     ]
     *     ]
     * ];
     * 
     * Resultado:
     * {
     * "persona":{
     * 	"nombre":"pepe",
     * 	"apellidos":"aaa bbb",
     * 	"coche":{
     * 		"marca":"renault",
     * 		"modelo":"kadjack",
     * 		"matricula":"45345gfd"
     * 		}
     *     }
     * }
     * 
     * @param string $path Dirección del archivo a escribir
     * @param array $document Array que contiene el patron mas la información que se va a escribir.
     * @return void
     * @exception IOException en caso de que no se puede escribir.
     */
    public static function writeDocument(string $path, array $document){
        $json = json_encode($document);
        if(!$json){
            throw new IOException("Error en la escritura");
        }else{
            $socket = fopen($path,"w");
            fwrite($socket,$json);
        }
        fclose($socket);
    }
    /**
     * readDocument
     * Lee un archivo JSon y devuelve.
     * @param string $path Dirección del archivo.
     * @return array Devuelve una array con la informacion del JSON
     * @exception IOException en caso de que no se puede escribir.
     */
    public static function readDocument(string $path){
        $socket = fopen($path,"r");
        $json=json_decode(fread($socket,400000));
        fclose($socket);
        if(!$json){
            throw new IOException("Error en la lectura del fichero");
        }else{
            return $json;
        }
    }
}