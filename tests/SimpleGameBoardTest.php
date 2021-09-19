<?php

use PHPUnit\Framework\TestCase;

class SimpleGameBoardTest extends TestCase
{
    /** @test */
    public function Init_BoardGame_Should_Fill_AllCells (){
        $stub = $this->createMock(\App\Models\Interfaces\IBoardCalculator::class);
        $sut = new App\Models\SimpleBoardGame($stub) ;
        $sut->Init() ;
        $actual = $sut->GetBoard() ;
        \PHPUnit\Framework\Assert::assertArrayNotHasKey("",array_count_values(array_values($actual)));
    }

    /** @test */
    public function CalculatePayLine_Should_Call_Calculator_GetPayFactor_With_Correct_Argument  (){
        //arrange
        global $incomingParam ;
        $stub = $this->createMock(App\Models\Interfaces\IBoardCalculator::class);
        $stub->method("GetPayFactor")
           ->with($this->callback(function($arg) { global $incomingParam; $incomingParam = $arg; return true;}))->willReturn(new \App\Models\PayFactor(5,10));

        $sut = new App\Models\SimpleBoardGame($stub);
        $sut->Init();

        $actual = array_slice($sut->GetBoard(), 0, 5);
        $keys = $sut->GetPayLines()[0];

        //act
        $result = $sut->CalculatePayLine($keys);

        //assert
        $this->assertEquals($actual, $incomingParam);

    }
}
