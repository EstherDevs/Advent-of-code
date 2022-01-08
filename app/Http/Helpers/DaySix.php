<?php

namespace App\Http\Helpers;

class DaySix
{
    public function getAnswer(string $input)
    {
        $input = trim($input);
        $fishArray = $this->getFishArray($input);
        $fishGrowth = $this->getFishGrowth($fishArray);

        $answerPartOne = count($fishGrowth);

        return 'The answer part one is: ' . $answerPartOne;
    }

    private function getFishArray($input)
    {
        return explode(',', $input);
    }

    private function getFishGrowth(array $fishArray)
    {
        $fishGrowth = $fishArray;

        for($i = 1; $i <= 80; $i++) {
            foreach($fishGrowth as $key => $fish) {
                if($fish <= 0) {
                    array_push($fishGrowth, 8);
                    $fishGrowth[$key] = 6;
                } elseif($fish >= 1) {
                    $fishGrowth[$key] -= 1;
                }
            }
        }

        return $fishGrowth;
    }
}
