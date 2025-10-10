<?php

declare(strict_types=1);

namespace GiacomoMasseroni\PHPCleanArchitecture\Exceptions;

class UseCaseUnimplementedException extends PHPCleanArchitectureException
{
    public function __construct(string $useCase)
    {
        parent::__construct('The use case ' . $useCase . ' does not implements handle function', 400, );
    }
}
