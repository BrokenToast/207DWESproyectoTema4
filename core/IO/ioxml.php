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
    * @throws IOException: Se lanza cuando  la array no sigue el patrón.
    */
    public static function writeDocument(string $path, array $document){
        // Comprueba si el patron es correcto
        if((!is_string($document[0]) && !isset($document[0]))||!(!is_array($document[1]) || !is_string(($document[1])) || !is_null(($document[1]))) || (isset($document[2])&&!is_array($document[2]))){
            throw new IOException("Error de formato");
        }else{
            // Crea el doucmento XML
            $odocumentoXML = new DOMDocument("1.0", "utf-8");
            // Crea el elemento principal
            $orootElement = $odocumentoXML->createElement($document[0]);
            //Añadimos el valor del elemento pincipal
            //Si es una array se llama a xmlElement y tomamos los elementos hijos, nuetos...
            //Y si no es una array se añadi el valr al elemento.
            if(is_array($document[1])){
                foreach($document[1] as $element){
                    $ochildElement = IOXML::xmlElement($element,$odocumentoXML);
                    $orootElement->appendChild($ochildElement);
                }
            }else{
                $orootElement->nodeValue = $document[1];
            }
            // Si en el $docuemento esta declarado la array de atributos se secan los atributos y se añaden en el elemento.
            if(isset($document[2])) {
                foreach ($document[2] as $nameAttribute => $valueAttribute) {
                    $orootElement->setAttribute($nameAttribute, $valueAttribute);
                }
            }
            // Se añade el elemento $rootElement al documento XML
            $odocumentoXML->appendChild($orootElement);
            // Se guarda el fichero en la dirección indicada por parametros.
            $odocumentoXML->save($path,LIBXML_NOXMLDECL);
        }
    }
    /**
    * readDocument
    * Nos permite leer un fichero XML.
    * @param string $path: Dirección del fichero xml.
    * @return Array|bool Devuelve false cuando a ocurrido un error, devuelve una array con el siguiente patron:
    * [ElementName,[Elementos] o ElementValue,[AttributeName=>AttributeValue] ]
    * Ejemplo
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
    *
    * @throws IOException Se lanza cuando a ocurrido un error a la hora de leer el fichero.
    */
    public static function readDocument(string $path){
        try{
            $odocumentoXML = new DOMDocument();
            $odocumentoXML->load($path);
            return IOXML::toElementArray($odocumentoXML->childNodes->item(0));
        }catch(DOMException $error){
            throw new IOException($error);
        }
    }

    private static function xmlElement(array $aElement,DOMDocument $xml){
        // Comprueba si el patron es correcto
        if((!is_string($aElement[0]) && !isset($aElement[0]))||!(!is_array($aElement[1]) || !is_string(($aElement[1])) || !is_null(($aElement[1]))) || (isset($aElement[2])&&!is_array($aElement[2]))){
            $error= new IOException("Error de formato");
        }else{
            //Creamos el elemento XML
            $xmlElement = $xml->createElement($aElement[0]);

            // En caso de que el elemento cotenga mas elementos
            if (is_array($aElement[1])) {
                //Recorre los elementos hijos y los añade
                foreach ($aElement[1] as $element) {
                    $xmlElement->appendChild(IOXML::xmlElement($element, $xml));
                }
            } else {
                //En caso de que no tenga elementos hijos añade el valor
                $xmlElement->nodeValue = $aElement[1];
            }

            // En caso de que de que haya atributos
            if (isset($aElement[2])) {
                // Recorre los atributos y los añade al elemento;
                foreach ($aElement[2] as $nameAttribute => $valueAttribute) {
                    $xmlElement->setAttribute($nameAttribute, $valueAttribute);
                }
            }
            return $xmlElement;
        }
    } 
    private static function toElementArray(DOMNode $oElement){
        //llamamos a la función clearDOMList para limpiar la lista
        $oListChild = IOXML::clearDOMList($oElement->childNodes);
        // Inicacilizamos el acumulador de los elementos Hijos.
        $aAcuElements = [];

        if(count($oListChild)==0){
            //En caso de que no tenga hijos, hacemos un elemento simple [name,value,[attribute]]
            return[$oElement->nodeName, $oElement->nodeValue, IOXML::AttributetoArray($oElement)];
        }else{
            //En caso de que tenga hijos llama es toElementArray y los acumula en $aAcuElements
            foreach($oListChild as $oChildElement){
                    array_push($aAcuElements,IOXML::toElementArray($oChildElement));
            }
        }
        return [$oElement->nodeName, $aAcuElements, IOXML::AttributetoArray($oElement)];
    }
    private static function AttributetoArray(DOMNode $oElement){
        //Inicializamos  $oListAttribute con la lista de atributos de $oElement
        $oListAttribute=$oElement->attributes;

        //Contendra Una array con una lista clave-valor con los atributos nameAttribute=>valueAttribute
        $aListAttrbitue=[];
        // Recorremos la lista de atributos y los vamos guardando en una array
        foreach($oListAttribute as $oAttribute){
            $aListAttrbitue+=[$oAttribute->nodeName=>$oAttribute->nodeValue];
        }
        return $aListAttrbitue;
    }
    /**
     * Sirve para eleminar los DOMText y devoelver una Array
     * @param DOMNodeList $olist Lista en la que vamos a quitar los DOMText
     * @return array Contiene una array con los DOMElement.
     */
    private Static function clearDOMList(DOMNodeList $olist){
        //VVVV va a contener los DOMElement
        $aClearList = [];
        //Saca los elementos de las lista y si son DOMElement los mete en $aClearList
        for ($i=0; $i<$olist->count() ; $i++) {
            $oElementList = $olist->item($i);
            if($oElementList instanceof DOMElement){
                array_push($aClearList,$oElementList);
            }
        }
        return $aClearList;
    }
}
?>