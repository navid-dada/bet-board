<?php


use PHPUnit\Framework\TestCase;

class BetSessionTest extends TestCase
{
    /** @test*/
    public function GetWinningPayLines_Should_Return_Correct_Result(){
        // arrange
        $expected = array(
            new \App\Models\WinningPayLine(array(0 ,3 ,6, 9, 12) ,3, .2 ),
            new \App\Models\WinningPayLine(array(0 ,4 ,8, 10, 12) ,3, .2 )
        );

        $gameStub = $this->createMock(\App\Models\Interfaces\IGame::class);


        $gameStub->method("GetPayLines")->willReturn(
            array(
                array(0, 3, 6, 9, 12),
                array(1, 4, 7, 10, 13),
                array(2, 5, 8, 11, 14),
                array(0, 4, 8, 10, 12),
                array(2, 4, 6, 10, 14)
            ));

        $gameStub->method("CalculatePayLine")->will($this->returnCallback(array($this, 'resultGen')));


        $sut = new \App\Models\BetSession($gameStub, 100);

        //act
        $actual = $sut->getWinningPayLines();

        //assert
        $this->assertEquals($expected,$actual);


    }

    function resultGen($param):\App\Models\PayFactor{
        if ($param === array(0, 3, 6, 9, 12) || $param === array(0, 4, 8, 10, 12))
            return new \App\Models\PayFactor(3, .2);
        return new \App\Models\PayFactor(0, 0);
    }
}
