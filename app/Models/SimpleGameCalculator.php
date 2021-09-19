<?php

namespace App\Models;


class SimpleGameCalculator implements Interfaces\IBoardCalculator
{

    private array $payFactors = array(3 => 0.2, 4 => 2, 5 => 10);

    function GetPayFactor(array $row): PayFactor
    {
        $count = 1 ;
        $first = $row[0];
        foreach (array_slice($row,1, count($row)) as $item)
        {
            if ($item == $first){
                $count ++;
            }
            else{
                break;
            }
        }
        if(array_key_exists( $count, $this->payFactors)){
            return new PayFactor($count , $this->payFactors[$count]);
        }
        return new PayFactor(0 , 0);
    }


}
