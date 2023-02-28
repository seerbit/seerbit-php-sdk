<?php

namespace Seerbit\Service;

trait Transformable {
    public function toArray(){
        return $this->result;
    }

    public function toJson(){
        return json_encode($this->result);
    }
}