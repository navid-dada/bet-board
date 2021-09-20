<?php


use PHPUnit\Framework\TestCase;
use \App\Models\Interfaces\IGame;
use \App\Models\PayFactor;
use \App\Models\WinningPayLine;
use \App\Models\BetSession;

class BetSessionTest extends TestCase
{
    /** @test*/
    public function GetWinningPayLines_Should_Return_Correct_Result(){
        // arrange
        $expected = array(
            new WinningPayLine(array(0 ,3 ,6, 9, 12) ,3, .2 ),
            new WinningPayLine(array(0 ,4 ,8, 10, 12) ,3, .2 )
        );

        $gameStub = $this->createMock(IGame::class);


        $gameStub->method("getPayLines")->willReturn(
            array(
                array(0, 3, 6, 9, 12),
                array(1, 4, 7, 10, 13),
                array(2, 5, 8, 11, 14),
                array(0, 4, 8, 10, 12),
                array(2, 4, 6, 10, 14)
            ));

        $gameStub->method("calculatePayFactor")->will($this->returnCallback(array($this, 'resultGen')));


        $sut = new BetSession($gameStub, 100);

        //act
        $actual = $sut->getWinningPayLines();

        //assert
        $this->assertEquals($expected,$actual);


    }

    function resultGen($param):PayFactor{
        if ($param === array(0, 3, 6, 9, 12) || $param === array(0, 4, 8, 10, 12))
            return new PayFactor(3, .2);
        return new PayFactor(0, 0);
    }
}
