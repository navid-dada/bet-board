<?php


use PHPUnit\Framework\TestCase;
use \App\Models\SimpleSlotCalculator;

class SimpleGameCalculatorTest extends TestCase
{
    /** @test
     * @@dataProvider RowDataProvider
     */
    function GetPayFactor_Should_Return_Correct_Value($row, $expected)
    {

        //arrange
        $sut = new SimpleSlotCalculator();

        //act
        $actual = $sut->getPayFactor($row);

        //assert
        $this->assertEquals($expected, $actual);
    }

    public function RowDataProvider(): array
    {
        return [
            "triple card" => [["dog", "dog", "dog", "Q", "J"], new \App\Models\PayFactor(3, 0.2)],
            "forth card" => [["K", "K", "K", "K", "Q"], new \App\Models\PayFactor(4, 2)],
            "full hand" => [["bird", "bird", "bird", "bird", "bird"], new \App\Models\PayFactor(5 , 10)],
            "Empty 1" => [["9", "Q", "Q", "Q", "bird"], new \App\Models\PayFactor(0,0)],
            "Empty 2" => [["9", "K", "bird", "Q", "bird"], new \App\Models\PayFactor(0,0)],
        ];

    }
}
