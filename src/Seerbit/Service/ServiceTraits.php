<?php


namespace Seerbit\Service;


trait ServiceTraits
{

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}