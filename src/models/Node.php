<?php

namespace App\models;

class Node
{
    public int|string $value;
    public ?Node $next = null;

    public function __construct(int|string $value)
    {
        $this->setValue($value);
    }

    public function getValue(): int|string
    {
        return $this->value;
    }

    public function setValue(int|string $value): void
    {
        $this->value = $value;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function setNext(?Node $next): void
    {
        $this->next = $next;
    }
}
