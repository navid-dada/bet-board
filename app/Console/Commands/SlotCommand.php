<?php

namespace App\Console\Commands;

use App\Models\BetSession;
use App\Models\SimpleBoardGame;
use App\Models\SimpleGameCalculator;
use App\Models\WinningPayLine;
use Illuminate\Console\Command;

class SlotCommand extends Command
{
    protected $signature = "slot";
    protected $description = "Bet on board game";

    public function handle(){
        $boardCalculator = new SimpleGameCalculator() ;
        $boardGame = new SimpleBoardGame($boardCalculator);
        $betSession = new BetSession($boardGame, 100);

        $board = $betSession->PrintBoard();
        $payLines = $betSession->GetWinningPayLines();
        $betAmount = $betSession->GetBetAmount();
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
