<?php

declare(strict_types=1);

require_once ('B.php');
require_once ('C.php');

final class A
{
    use B,C;

    public function done(): void
    {
        $this->run(); // call from C
        $this->gone('string'); // call from B
        echo 'done';
    }

    public function run(): void // you can overwrite it
    {
        echo 'blap';
    }

    public function gone(): void // also you can overwrite signature
    {
        echo 'some';
    }
}
