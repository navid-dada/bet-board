<?php

namespace App\Models\Interfaces;

use App\Models\PayFactor;

interface IBoardCalculator
{
    function GetPayFactor(array $row) : PayFactor;
}
