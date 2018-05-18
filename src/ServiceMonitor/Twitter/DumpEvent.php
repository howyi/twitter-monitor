<?php

namespace ServiceMonitor\Twitter;

use ServiceMonitor\EventInterface;

class DumpEvent extends TwitterEvent
{
    public function isExecutable(array $value): bool
    {
        return $value;
    }

    public function execute(array $value): void
    {
        dump($value);
    }
}
