<?php

namespace App\Models\Interfaces;

use App\Models\PayFactor;

interface IGame
{

    /**
     * Fill all cells with random values
     */
    function init(): void;

    /**
     * Get all cells of board
     * @return array
     */
    function getBoard() : array ;

    /**
     * Get All pay lines are defined in the board
     * @return array
     */
    function getPayLines () :array;

    /**
     * Calculate the payment out factor for given row
     * @param array $payLine
     * @return PayFactor
     */
    function calculatePayFactor(array $payLine): PayFactor;
}
