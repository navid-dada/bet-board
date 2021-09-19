<?php

namespace App\Models\Interfaces;

use App\Models\PayFactor;

interface IGame
{
    function GetBoard() : array ;
    function Init(): void;
    function GetPayLines () :array;
    function CalculatePayFactor(array $payLine): PayFactor;
}
