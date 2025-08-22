<?php

namespace GiacomoMasseroni\PHPCleanArchitecture;

use GiacomoMasseroni\PHPCleanArchitecture\Contracts\UseCaseExecutorInterface;
use GiacomoMasseroni\PHPCleanArchitecture\Contracts\UseCaseInterface;
use GiacomoMasseroni\PHPCleanArchitecture\Exceptions\PHPCleanArchitectureException;

abstract class BaseUseCase implements UseCaseInterface
{
    public ?UseCaseExecutorInterface $executor = null;

    /**
     * @var list<mixed>
     */
    protected array $data = [];

    /**
     * Array of rollbacks to perform on rollback.
     *
     * @note The rollback callbacks will be executed after <code>performCallback()</code> method.
     * @var array<int, callable>
     */
    private array $rollbackCallbacks = [];

    /**
     * Array of rollbacks to perform before use case execution.
     *
     * @note The rollback callbacks will be executed after <code>performCallback()</code> method.
     * @var array<int, callable>
     */
    private array $beforeExecuteCallbacks = [];

    /**
     * Array of rollbacks to perform after use case execution.
     *
     * @note The rollback callbacks will be executed after <code>performCallback()</code> method.
     * @var array<int, callable>
     */
    private array $afterExecuteCallbacks = [];

    final public function __construct() {}

    /**
     * Set the user who is executing the use case
     */
    public function actingAs(?UseCaseExecutorInterface $user): static
    {
        $this->executor = $user;

        return $this;
    }

    /**
     * @throws PHPCleanArchitectureException
     */
    public function __invoke(mixed ...$arguments): mixed
    {
        try {
            $this->beforeExecute();

            $result = $this->handle(...$arguments);

            $this->afterExecute($result);
        } catch (PHPCleanArchitectureException $exception) {
            $this->rollback();

            throw $exception;
        }

        return $result;
    }

    private function beforeExecute(): void
    {
        foreach ($this->beforeExecuteCallbacks as $callback) {
            $callback();
        }
    }

    private function afterExecute(mixed $result): void
    {
        foreach ($this->afterExecuteCallbacks as $callback) {
            $callback($result);
        }
    }

    final public function rollback(): void
    {
        foreach ($this->rollbackCallbacks as $callback) {
            $callback();
        }
    }

    /**
     * @throws PHPCleanArchitectureException
     */
    final public static function run(mixed ...$arguments): mixed
    {
        return (new static())->__invoke(...$arguments);
    }
}
