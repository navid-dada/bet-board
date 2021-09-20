<?php

use PHPUnit\Framework\TestCase;
use App\Models\Interfaces\IBoardCalculator;
use \App\Models\PayFactor;
use App\Models\SimpleSlotGame;

class SimpleGameBoardTest extends TestCase
{
    /** @test */
    public function Init_BoardGame_Should_Fill_AllCells (){
        $stub = $this->createMock(IBoardCalculator::class);
        $sut = new SimpleSlotGame($stub) ;
        $sut->init() ;
        $actual = $sut->getBoard() ;
        \PHPUnit\Framework\Assert::assertArrayNotHasKey("",array_count_values(array_values($actual)));
    }

    /** @test */
    public function CalculatePayLine_Should_Call_Calculator_GetPayFactor_With_Correct_Argument  (){
        //arrange
        $incomingParam = array() ;
        $stub = $this->createMock(IBoardCalculator::class);
        $stub->method("getPayFactor")
           ->with($this->callback(function($arg ) use(&$incomingParam) { $incomingParam = $arg; return true;}))
            ->willReturn(new PayFactor(5,10));

        $sut = new SimpleSlotGame($stub);
        $sut->init();

        $actual = array_slice($sut->getBoard(), 0, 5);
        $keys = $sut->getPayLines()[0];

        //act
        $result = $sut->calculatePayFactor($keys);

        //assert
        $this->assertEquals( $incomingParam, $actual);

    }
}
