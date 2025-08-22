<?php

namespace GiacomoMasseroni\PHPCleanArchitecture\Contracts;

interface UseCaseInterface
{
    public function handle(mixed ...$arguments): mixed;
}
