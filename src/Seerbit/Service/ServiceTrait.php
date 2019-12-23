<?php


namespace Seerbit\Service\Traits;


trait ServiceTraits
{

    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }

}