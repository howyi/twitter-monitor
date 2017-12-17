<?php

namespace ServiceMonitor;

abstract class Monitor implements Monitorable
{
  /**
   * @var EventInterface[]
   */
    protected $events = [];

    /**
     * @param array $value
     */
    public function execute(array $value): void
    {
        foreach ($this->events as $event) {
            if ($event->isExecutable($value)) {
                $event->execute($value);
            }
        }
    }

    /**
     * @return Monitorable
     */
    public function setEvent(EventInterface $event): Monitorable
    {
        $this->events[] = $event;
        return $this;
    }

    abstract public function start(): void;
}
