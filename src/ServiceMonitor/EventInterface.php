<?php

namespace ServiceMonitor;

interface EventInterface
{
    public function isExecutable(array $value): bool;

    public function execute(array $value): void;
}
