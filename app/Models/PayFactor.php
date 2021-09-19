<?php

namespace App\Models;

class PayFactor
{
    public int $MatchCount = 0 ;
    public float $PayOutRatio = 0 ;

    public function __construct($setCount, $payFactor)
    {
        $this->PayOutRatio = $payFactor ;
        $this->MatchCount = $setCount ;
    }
}
