<?php

namespace ServiceMonitor\Twitter;

use ServiceMonitor\EventInterface;

class DumpEvent extends TwitterEvent
{
    public function isExecutable(array $value): bool
    {
        return true;
    }

    public function execute(array $value): void
    {
        dump($value);
    }
}
