<?php


namespace Seerbit\Service;


interface IService
{
    function getClient();

    function requiresToken();

    function setRequiresToken($val);


}