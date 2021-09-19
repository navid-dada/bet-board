<?php

namespace App\Models;

class WinningPayLine
{
    public function __construct(array $payLine, $setCount, $factor)
    {
        $this->PayLine = $payLine;
        $this->SetCount = $setCount ;
        $this->PayFactor = $factor ;
    }

    public array $PayLine;
    public int $SetCount;
    public float $PayFactor ;
}
