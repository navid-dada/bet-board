<?php

namespace App\Models;


class SimpleGameCalculator implements Interfaces\IBoardCalculator
{

    private array $payOutRatioMap = array(3 => 0.2, 4 => 2, 5 => 10);


    /**
     * Calculate payOutFactor for data of given row ;
     *
     * @param array $row
     * @return PayFactor
     */
    function getPayFactor(array $row): PayFactor
    {
        $count = 1 ;
        $first = $row[0];

        //Todo: replace with for
        foreach (array_slice($row,1, count($row)) as $item)
        {
            if ($item == $first){
                $count++;
            }
            else{
                break;
            }
        }

        if(array_key_exists( $count, $this->payOutRatioMap)){
            return new PayFactor($count , $this->payOutRatioMap[$count]);
        }
        return new PayFactor(0 , 0);
    }


}
