<?php

namespace GiacomoMasseroni\PHPCleanArchitecture\Exceptions;

class UseCaseUnimplementedException extends PHPCleanArchitectureException
{
    public function __construct(string $useCase)
    {
        parent::__construct('The use case ' . $useCase . ' does not implements invoke function', 400, );
    }
}
