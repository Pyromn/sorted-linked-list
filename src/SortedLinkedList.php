<?php

declare(strict_types=1);

namespace App;

use App\models\Node;
use InvalidArgumentException;

class SortedLinkedList
{
    const string INTEGER = 'integer';
    const string STRING = 'string';

    private ?Node $firstNode = null;
    private ?string $dataType = null;

    public function add(int|string $value): void
    {
        $this->checkType($value);

        $newNode = new Node($value);
        $firstNode = $this->getFirstNode();

        if ($firstNode === null || $value < $firstNode->getValue()) {
            $newNode->setNext($firstNode);
            $this->setFirstNode($newNode);

            return;
        }

        $current = $this->getFirstNode();

        while ($current->getNext() !== null && $current->getNext()->getValue() < $value) {
            $current = $current->getNext();
        }

        $newNode->setNext($current->getNext());
        $current->setNext($newNode);
    }

    public function remove(int|string $value): bool
    {
        if (! $this->contains($value)) {
            return false;
        }

        $firstNode = $this->getFirstNode();

        if ($firstNode === null) {
            return false;
        }

        if ($firstNode->getValue() === $value) {
            $this->setFirstNode($firstNode->getNext());

            return true;
        }

        $current = $this->getFirstNode();
        $nextNode = $current->getNext();

        while ($nextNode !== null && $nextNode->getValue() !== $value) {
            $current = $nextNode;
        }

        if ($current->getNext() === null) {
            return false;
        }

        $nextNode = $current->getNext();

        $current->setNext($nextNode->getNext());

        return true;
    }

    public function contains(int|string $value): bool
    {
        if ($this->getDataType() !== gettype($value)) {
            return false;
        }

        $current = $this->getFirstNode();

        while ($current !== null) {
            if ($current->getValue() === $value) {
                return true;
            }

            $current = $current->getNext();
        }

        return false;
    }

    public function getSize(): int
    {
        $count = 0;
        $current = $this->getFirstNode();

        while ($current !== null) {
            $current = $current->getNext();
            $count++;
        }

        return $count;
    }

    public function clearList(): void
    {
        $this->setFirstNode();
        $this->setDataType();
    }

    public function toArray(): array
    {
        $result = [];
        $current = $this->getFirstNode();

        while ($current !== null) {
            $result[] = $current->getValue();
            $current = $current->getNext();
        }

        return $result;
    }

    public function __toString(): string
    {
        return implode(' -> ', $this->toArray());
    }

    public function getInvalidDataTypeMessage(): string
    {
        switch ($this->getDataType()) {
            case self::STRING:
                return 'Only strings are supported.';
            case self::INTEGER:
                return 'Only integers are supported.';
            default:

        }

        return 'Only integers or strings are supported.';
    }

    private function checkType(int|string $value): void
    {
        $listDataType = $this->getDataType();
        $inputType = gettype($value);

        if ($listDataType === null) {
            $this->setDataType($inputType);
        } elseif ($listDataType !== $inputType) {
            throw new InvalidArgumentException('All values must have the same $listDataType type.');
        }
    }

    private function getFirstNode(): ?Node
    {
        return $this->firstNode;
    }

    private function setFirstNode(?Node $node = null): void
    {
        $this->firstNode = $node;
    }

    private function getDataType(): ?string
    {
        return $this->dataType;
    }

    private function setDataType(?string $type = null): void
    {
        $this->dataType = $type;
    }
}
