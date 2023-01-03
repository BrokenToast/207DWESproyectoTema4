<?php
    class IOException extends Exception{
        public function __construct(String $mensaje){
            parent::__construct($mensaje);
        }

    }
?>