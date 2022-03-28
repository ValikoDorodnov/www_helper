<?php

declare(strict_types=1);

trait B
{
    public function gone(string $string): void
    {
        echo $string;
    }
}
