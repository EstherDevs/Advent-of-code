<?php

namespace App\Http\Helpers;

class DayTwo
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
        $answerPartOne = $this->getAnswerPartOne($inputArray);
        $answerPartTwo = $this->getAnswerPartTwo($inputArray);

        return 'Answer part one is: ' . $answerPartOne . ' Answer part two is: ' . $answerPartTwo;
    }

    /**
     * @param array $inputArray
     * @return int
     */
    private function getAnswerPartOne(array $inputArray) : int
    {
        $depthPos = 0;
        $horizontalPos = 0;

        foreach ($inputArray as $input) {
            $positionValue = (int) filter_var($input,FILTER_SANITIZE_NUMBER_INT);

            if (strpos($input, 'forward') !== false) {
                $horizontalPos += $positionValue;
            } elseif (strpos($input, 'up') !== false) {
                $depthPos -= $positionValue;
            } elseif (strpos($input, 'down') !== false) {
                $depthPos += $positionValue;
            }
        }

        return $depthPos * $horizontalPos;
    }

    /**
     * @param array $inputArray
     * @return int
     */
    private function getAnswerPartTwo(array $inputArray) : int
    {
        $aim = 0;
        $depthPos = 0;
        $horizontalPos = 0;

        foreach ($inputArray as $input) {
            $positionValue = (int) filter_var($input,FILTER_SANITIZE_NUMBER_INT);

            if (strpos($input, 'forward') !== false) {
                $horizontalPos += $positionValue;
                $depthPos += $aim * $positionValue;
            } elseif (strpos($input, 'up') !== false) {
                $aim -= $positionValue;
            } elseif (strpos($input, 'down') !== false) {
                $aim += $positionValue;
            }
        }

        return $horizontalPos * $depthPos;
    }
}
