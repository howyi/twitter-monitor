<?php

namespace ServiceMonitor;

interface Monitorable
{
    public function execute(array $value): void;

    public function setEvent(EventInterface $event): self;

    public function start(): void;
}
