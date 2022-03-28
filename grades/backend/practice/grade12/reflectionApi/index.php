<?php

declare(strict_types=1);

require_once ('TestBest.php');

/**
 * Reflection API - отражение или рефлексия (холоним интроспекции, англ. reflection) означает процесс,
 * во время которого программа может отслеживать и модифицировать
 * собственную структуру и поведение во время выполнения.
 *
 * ReflectionClass выступает аналитиком для класса, и в этом состоит главная идея Reflection API
 *
 * ReflectionClass: сообщает информацию о классе.
 * ReflectionFunction: сообщает информацию о функции.
 * ReflectionParameter: извлекает информацию о параметрах функции или метода.
 * ReflectionClassConstant: сообщает информацию о константе класса.
 */

/**
 * Рефлексия для получения doc comment
 */
$reflection = new ReflectionClass('TestBest');
$method = $reflection->getMethod('getRandomInt');
echo $method->getDocComment();

$obj = new TestBest();
echo "\n";
/**
 * Рефлексия для модификаторов доступа (private, protected)
 * Полезно, если нужно престировать закрытые методы класса
 */
$privateMethod = new ReflectionMethod('TestBest', 'changeStr');
$privateMethod->setAccessible(true);
$privateMethod->invoke($obj);

echo $obj->getMyStr();