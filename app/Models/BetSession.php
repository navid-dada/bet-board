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

    public function PrintBoard(): array
    {
        $board = $this->game->getBoard();
        return array_values($board);
    }

    public function GetBetAmount(): int
    {
        return $this->betAmount ;
    }

    public function GetWinningPayLines(): array{
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
