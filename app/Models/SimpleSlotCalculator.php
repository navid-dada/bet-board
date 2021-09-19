<?php

namespace App\Models;


class SimpleSlotCalculator implements Interfaces\IBoardCalculator
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

        $first = $row[0];

        $i=1;
        for ( ; $i < count($row); )
        {
            if ($row[$i] == $first){
                $i++;
            }
            else{
                break;
            }
        }

        if(array_key_exists( $i, $this->payOutRatioMap)){
            return new PayFactor($i , $this->payOutRatioMap[$i]);
        }
        return new PayFactor(0 , 0);
    }


}
