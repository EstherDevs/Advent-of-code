<?php

namespace App\Http\Helpers;

class DayTwo
{
    public function __construct()
    {

    }

    public function getAnswer($inputArray)
    {
        $answerPartOne = $this->getAnswerPartOne($inputArray);
        $answerPartTwo = $this->getAnswerPartTwo($inputArray);

        return 'Answer part one is: ' . $answerPartOne . ' Answer part two is: ' . $answerPartTwo;
    }

    private function getAnswerPartOne($inputArray)
    {
        $depthPos = 0;
        $horizontalPos = 0;

        foreach($inputArray as $input)
        {
            $positionValue = (int) filter_var($input,FILTER_SANITIZE_NUMBER_INT);

            if(strpos($input, 'forward') !== false) {
                $horizontalPos += $positionValue;
            } elseif(strpos($input, 'up') !== false) {
                $depthPos -= $positionValue;
            } elseif(strpos($input, 'down') !== false) {
                $depthPos += $positionValue;
            }
        }

        return $depthPos * $horizontalPos;
    }

    private function getAnswerPartTwo($inputArray)
    {
        $aim = 0;
        $depthPos = 0;
        $horizontalPos = 0;

        foreach($inputArray as $input)
        {
            $positionValue = (int) filter_var($input,FILTER_SANITIZE_NUMBER_INT);

            if(strpos($input, 'forward') !== false) {
                $horizontalPos += $positionValue;
                $depthPos += $aim * $positionValue;
            } elseif(strpos($input, 'up') !== false) {
                $aim -= $positionValue;
            } elseif(strpos($input, 'down') !== false) {
                $aim += $positionValue;
            }
        }

        return $horizontalPos * $depthPos;
    }
}
