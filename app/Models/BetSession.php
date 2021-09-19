<?php

namespace App\Models;

use App\Models\Interfaces\IGame;

class BetSession
{
    private IGame $game;
    private int $betAmount = 100;

    public function __construct(IGame $game, int $betAmount = 100)
    {
        $this->game = $game;
        $this->game->init();
    }


    /**
     * generate raw board content
     * @return array
     */
    public function printBoard(): array
    {
        $board = $this->game->getBoard();
        return array_values($board);
    }

    /**
     * return the amount of bet
     * @return int
     */
    public function getBetAmount(): int
    {
        return $this->betAmount ;
    }

    /**
     * get all the winning pay lines(cell indexes).
     * including payout ratio and number of card chain (matchCount)
     *
     * @return array
     */
    public function getWinningPayLines(): array{
        $winingLines = array();
        $allPayLines = $this->game->getPayLines();
        foreach ($allPayLines as $payLine){
            $payFactor = $this->game->calculatePayFactor($payLine);
            if ($payFactor->MatchCount >= 3){
                array_push($winingLines, new WinningPayLine($payLine, $payFactor->MatchCount, $payFactor->PayOutRatio));
            }
        }
        return $winingLines;
    }





}
