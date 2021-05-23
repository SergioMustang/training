<?php

class Method
{

    private $conection_method;

    public function getMethod()
    {
        $this->conection_method = null;
        $this->conection_method = $_SERVER['REQUEST_METHOD'];
        return $this->conection_method;
    }
}

?>