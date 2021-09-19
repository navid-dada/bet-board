<?php

namespace App\Console\Commands;

use App\Models\BetSession;
use App\Models\SimpleSlotGame;
use App\Models\SimpleSlotCalculator;
use App\Models\WinningPayLine;
use Illuminate\Console\Command;

class SlotCommand extends Command
{
    protected $signature = "slot";
    protected $description = "Bet on board game";

    public function handle(){
        $boardCalculator = new SimpleSlotCalculator() ;
        $boardGame = new SimpleSlotGame($boardCalculator);
        $betSession = new BetSession($boardGame, 100);

        $board = $betSession->printBoard();
        $payLines = $betSession->getWinningPayLines();
        $betAmount = $betSession->getBetAmount();

        $totalWin = array_reduce($payLines, function ($sum, WinningPayLine $payLine) use ($betAmount){
           $sum += ($payLine->PayFactor * $betAmount);
           return $sum;
        }, 0);

        $output =array(
            "board"=> $board,
            "paylines" => array_map(function (WinningPayLine $item){
                return array(implode(" ", $item->PayLine)=> $item->SetCount);
            },$payLines),
            "bet_amount"=> $betAmount,
            "total_win" => $totalWin
        );

        echo json_encode($output, JSON_PRETTY_PRINT).PHP_EOL;
    }

}
