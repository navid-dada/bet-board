<?php

namespace App\Models;

use App\Models\Interfaces\IBoardCalculator;
use App\Models\Interfaces\IGame;


class SimpleSlotGame implements IGame
{


    private array $cards = array("9", "10", "J", "Q", "K", "A", "cat", "dog", "monkey", "bird");
    private IBoardCalculator $calculator;
    private array $cells = array(
        // row #1
        0 => "", 3 => "", 6 => "", 9 => "", 12 => "",
        // row #2
        1 => "", 4 => "", 7 => "", 10 => "", 13 => "",
        // row #3
        2 => "", 5 => "", 8 => "", 11 => "", 14 => ""
    );

    public function __construct(IBoardCalculator $calculator)
    {
        $this->calculator = $calculator;
    }



    public function init(): void
    {
        foreach ($this->cells as $key => $value) {
            $this->cells[$key] = $this->cards[rand(0, 9)];
        }
    }

    public function getBoard(): array
    {
        return $this->cells;
    }

    public function getPayLines(): array
    {
        return array(array(0, 3, 6, 9, 12), array(1, 4, 7, 10, 13), array(2, 5, 8, 11, 14), array(0, 4, 8, 10, 12), array(2, 4, 6, 10, 14));
    }


    function calculatePayFactor(array $payLine): PayFactor
    {
        $row = array();
        foreach ($payLine as $p)
        {
            array_push($row, $this->cells[$p]);
        }
        return $this->calculator->getPayFactor($row);
    }
}
