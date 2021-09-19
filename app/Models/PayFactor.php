<?php

namespace App\Models;

class PayFactor
{
    public function __construct($setCount, $payFactor)
    {
        $this->Factor = $payFactor ;
        $this->SetCount = $setCount ;
    }

    public int $SetCount = 0 ;
    public float $Factor = 0 ;

}
