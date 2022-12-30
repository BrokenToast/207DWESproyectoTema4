<?php
require_once('io.php');
require_once('ioexception.php');
/**
* IOXML
* Clase para la lectura y escritura de archivos XML
* @author: Luis Pérez Astorga
* @version: 1.0
* @size: 29-12-2022
*/
class IOXML implements IO{
    /**
    * writeDocument
    * Nos permite crear un fichero XML a partir de una Array con un patrón en especifico:
    * [ElementName,[Elementos] o ElementValue,[AttributeName=>AttributeValue] ]
    *
    * Ejemplo:
    * ["persona",
    *     [
    *         ["nombre","pepe"],
    *         ["apellidos","aaa bbb"],
    *         ["coche",
    *             [
    *                 ["marca","renault"],
    *                 ["modelo","kadjack"],
    *                 ["matricula","45345gfd"]
    *             ]
    *         ]
    *     ],
    *     ["dni"=>"12345678Z"]
    * ]
    * <?xml version="1.0" encoding="utf-8"?>
    * <persona id="root" dni="12345678Z">
    * 	<nombre>pepe</nombre>
    * 	<apellidos>aaa bbb</apellidos>
    * 	<coche>
    * 		<marca>renault</marca>
    * 		<modelo>kadjack</modelo>
    * 		<matricula>45345gfd</matricula>
    * 	</coche>
    * </persona>
    *
    * @param string $path: Difercion y nombre.xml del fichero donde se va a guardar.
    * @param array $document: Array con la información que se va a guardar(Debe seguir el patrón)
    * @return void
    * @exception IOException: Se lanza cuando  la array no sigue el patrón.
    */
    public static function writeDocument(string $path, array $document){
        // Comprueba si el patron es correcto
        if((!is_string($document[0]) && !isset($document[0]))||!(!is_array($document[1]) || !is_string(($document[1])) || !is_null(($document[1]))) || (isset($document[2])&&!is_array($document[2]))){
            $error= new IOException("hola");
        }else{
            // Crea el doucmento XML
            $documentoXML = new DOMDocument("1.0", "utf-8");
            // Crea el elemento principal
            $rootElement = $documentoXML->createElement($document[0]);
            //Añadimos el valor del elemento pincipal
            //Si es una array se llama a xmlElement y tomamos los elementos hijos, nuetos...
            //Y si no es una array se añadi el valr al elemento.
            if(is_array($document[1])){
                foreach($document[1] as $element){
                    $childElement = IOXML::xmlElement($element,$documentoXML);
                    $rootElement->appendChild($childElement);
                }
            }else{
                $rootElement->nodeValue = $document[1];
            }
            // Se añade un atributo que identifica que es el elemento root
            $rootElement->setAttribute("id","root");
            // Si en el $docuemento esta declarado la array de atributos se secan los atributos y se añaden en el elemento.
            if(isset($document[2])) {
                foreach ($document[2] as $nameAttribute => $valueAttribute) {
                    $rootElement->setAttribute($nameAttribute, $valueAttribute);
                }
            }
            // Se añade el elemento $rootElement al documento XML
            $documentoXML->appendChild($rootElement);
            // Se guarda el fichero en la dirección indicada por parametros.
            $documentoXML->save($path,LIBXML_NOEMPTYTAG);
        }
    }
    /**
    * readDocument
    * Nos permite leer un fichero XML.
    * @param string $path: Dirección del fichero xml.
    * @return DOMDocument.
    */
    public static function readDocument(string $path){
        $documentoXML = new DOMDocument();
        $documentoXML->load($path);
        return $documentoXML;
    }
    private static function xmlElement(Array $aElement,DOMDocument $xml){
        // Comprueba si el patron es correcto
        if((!is_string($aElement[0]) && !isset($aElement[0]))||!(!is_array($aElement[1]) || !is_string(($aElement[1])) || !is_null(($aElement[1]))) || (isset($aElement[2])&&!is_array($aElement[2]))){
            $error= new IOException("hola");
        } else {
            $xmlElement = $xml->createElement($aElement[0]);

            if (is_array($aElement[1])) {
                foreach ($aElement[1] as $element) {
                    $xmlElement->appendChild(IOXML::xmlElement($element, $xml));
                }
            } else {
                $xmlElement->nodeValue = $aElement[1];
            }
            if (isset($aElement[2])) {
                foreach ($aElement[2] as $nameAttribute => $valueAttribute) {
                    $xmlElement->setAttribute($nameAttribute, $valueAttribute);
                }
            }
            return $xmlElement;
        }
    } 
}
?>