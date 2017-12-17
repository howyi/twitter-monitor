<?php

namespace ServiceMonitor\Twitter;

use ServiceMonitor\EventInterface;

class SampleEvent extends TwitterEvent
{
    public function isExecutable(array $value): bool
    {
        return (isset($value['text']) and ('hello' === $value['text']));
    }

    public function execute(array $value): void
    {
        echo("User:{$value['user']['name']} greeted :)" . PHP_EOL);
    }
}
