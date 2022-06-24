<?php

namespace App\Http\Helpers;

class DayOne
{
    public function __construct()
    {

    }

    public function getAnswer($inputArray)
    {
        $answerPartOne = $this->getIncreaseAmount($inputArray);
        $answerPartTwo = $this->getSumIncreaseAmount($inputArray);
        return 'Answer part one is: ' . $answerPartOne . ' and answer part two is: ' . $answerPartTwo;
    }

    private function getIncreaseAmount($inputArray)
    {
        $increases = 0;
        $previousInput = null;

        foreach($inputArray as $input) {
            if($previousInput && $previousInput < $input) {
                $increases += 1;
            }

            $previousInput = $input;
        }

        return $increases;
    }

    private function getSumIncreaseAmount($inputArray)
    {
        $compoundedNumbers = [];

        foreach($inputArray as $key => $value) {
            if(isset($inputArray[$key + 2])) {
                $compoundedNumbers[] = $value + $inputArray[$key + 1] + $inputArray[$key + 2];
            }
        }

        return $this->getIncreaseAmount($compoundedNumbers);
    }
}
