<?php

namespace App\Http\Helpers;

class DayOne
{
    public function __construct()
    {

    }

    /**
     * @param array $inputArray
     * @return string
     */
    public function getAnswer(array $inputArray) : string
    {
        $answerPartOne = $this->getIncreaseAmount($inputArray);
        $answerPartTwo = $this->getSumIncreaseAmount($inputArray);
        return 'Answer part one is: ' . $answerPartOne . ' and answer part two is: ' . $answerPartTwo;
    }

    /**
     * @param array $inputArray
     * @return int
     */
    private function getIncreaseAmount(array $inputArray) : int
    {
        $increases = 0;
        $previousInput = null;

        foreach ($inputArray as $input) {
            if ($previousInput && $previousInput < $input) {
                $increases += 1;
            }

            $previousInput = $input;
        }

        return $increases;
    }

    /**
     * @param array $inputArray
     * @return int
     */
    private function getSumIncreaseAmount(array $inputArray) : int
    {
        $compoundedNumbers = [];

        foreach ($inputArray as $key => $value) {
            if (isset($inputArray[$key + 2])) {
                $compoundedNumbers[] = $value + $inputArray[$key + 1] + $inputArray[$key + 2];
            }
        }

        return $this->getIncreaseAmount($compoundedNumbers);
    }
}
