<?php

namespace Dynamik\Exceptions;

use Exception;

class FunctionNotFoundException extends Exception 
{
    public function __construct($function) {
        parent::__construct($function . ' not found', null, null);
    }
}