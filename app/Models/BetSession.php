<?php

namespace App\Models;

use App\Models\Interfaces\IGame;

class BetSession
{
    private $game;
    private $betAmount = 100;

    public function __construct(IGame $game, int $betAmount = 100)
    {
        $this->game = $game;
        $this->game->Init();
    }

    public function PrintBoard(): string
    {
        $board = $this->game->GetBoard();
        $text = implode(",", array_values($board));
        return '[' . $text . ']';
    }

    public function GetBetAmount(): int
    {
        return $this->betAmount ;
    }

    public function GetWinningPayLines(): array{
        $winingLines = array();
        $allPayLines = $this->GetPayLines();
        foreach ($allPayLines as $payLine){
            $payfactor = $this->game->CalculatePayLine($payLine);
            if ($payfactor->SetCount >= 3){
                array_push($winingLines, new WinningPayLine($payLine, $payfactor->SetCount, $payfactor->Factor));
            }
        }
        return $winingLines;
    }





}
