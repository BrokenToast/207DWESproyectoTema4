<?php
    /**
     * IO
     * Interfaz que nos permite crear clases para escribir y leer archivos.
     * @author Luis Pérez Astorga
     * @version 1.0
     * @since 29-12-2022
     */
    interface IO{
        /**
         * writeDocument
         * Nos permite escribir un archivo a partir de una Array.
         * @param string $path Dirección donde se va a almacenar el archivo;
         * @param array $document Array que contiene la información.
         * @return void
         */
        public static function writeDocument(String $path, Array $document);
        /**
         * readDocument
         * Nos permite leer un archivo.
         * @param string $path Dirección del archivo que se va a leer.
         * Devuelve el documento en diferentes tipos de formatos.
         */
        public static function readDocument(string $path);
    }
?>
