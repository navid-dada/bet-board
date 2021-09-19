<?php


namespace App\Models\Interfaces;

use App\Models\PayFactor;
interface IBoardCalculator
{
    /**
     * Calculate payOutFactor for data of given row ;
     *
     * @param array $row
     * @return PayFactor
     */
    function getPayFactor(array $row) : PayFactor;
}
