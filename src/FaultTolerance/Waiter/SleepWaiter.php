<?php

/*
 * This file is part of the Tolerance package.
 *
 * (c) Samuel ROZE <samuel.roze@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FaultTolerance\Waiter;

use FaultTolerance\Waiter;

class SleepWaiter implements Waiter
{
    /**
     * {@inheritdoc}
     */
    public function wait($milliSeconds)
    {
        usleep($milliSeconds * 1000);
    }
}
