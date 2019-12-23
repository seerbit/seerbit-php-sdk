<?php


namespace Seerbit\Service;


interface ITransformable
{
    public function toArray();

    public function toJson();
}