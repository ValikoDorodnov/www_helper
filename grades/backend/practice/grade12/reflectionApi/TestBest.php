<?php

declare(strict_types=1);

final class TestBest
{
    private string $myPrivateStr = 'some';

    /**
     * @throws Exception
     * Some comment
     */
    public function getRandomInt(): int
    {
        return random_int(0, 9);
    }

    private function changeStr(): void
    {
        $this->myPrivateStr = 'new some';
    }

    public function getMyStr(): string
    {
        return $this->myPrivateStr;
    }
}
