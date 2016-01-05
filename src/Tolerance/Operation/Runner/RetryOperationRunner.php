<?php

namespace Tolerance\Operation\Runner;

use Tolerance\Operation\Operation;
use Tolerance\Waiter\WaiterException;
use Tolerance\Waiter\Strategy\WaitStrategy;

class RetryOperationRunner implements OperationRunner
{
    /**
     * @var OperationRunner
     */
    private $runner;

    /**
     * @var WaitStrategy
     */
    private $waitStrategy;

    /**
     * @param OperationRunner $runner
     * @param WaitStrategy    $waitStrategy
     */
    public function __construct(OperationRunner $runner, WaitStrategy $waitStrategy)
    {
        $this->runner = $runner;
        $this->waitStrategy = $waitStrategy;
    }

    /**
     * {@inheritdoc}
     */
    public function run(Operation $operation)
    {
        try {
            return $this->runner->run($operation);
        } catch (\Exception $e) {
            try {
                $this->waitStrategy->wait();
            } catch (WaiterException $waiterException) {
                throw $e;
            }

            return $this->run($operation);
        }
    }
}
