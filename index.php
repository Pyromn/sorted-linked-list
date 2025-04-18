<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\SortedLinkedList;

$list = new SortedLinkedList();
$list->add(33);
$list->add(22);
$list->add(777);

echo $list . PHP_EOL;

echo ($list->remove(11) ? 'Node removed' : 'Node not found') . PHP_EOL;
echo ($list->remove(33) ? 'Node removed' : 'Node not found') . PHP_EOL;

echo $list . PHP_EOL;

var_dump($list->contains(777));

try {
    $list->add(7.89);
} catch (\TypeError $e) {
    echo 'Invalid data type.' . $list->getInvalidDataTypeMessage() . PHP_EOL;
}

try {
    $list->add("bike");
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . PHP_EOL;
}

echo 'List size is ' . $list->getSize() . PHP_EOL;

echo implode(', ', $list->toArray()) . PHP_EOL;

$list->clearList();

echo $list->getSize() ?: 'empty' . PHP_EOL;