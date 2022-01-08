<?php

namespace App\Http\Helpers;

class DayEight
{
    public function getAnswer(array $input)
    {
        $answerPartOne = $this->getOutputDigetsCount($input);

        return 'The answer to part one is: ' . $answerPartOne;
    }
    private function getOutputDigetsCount(array $input)
    {
        $outputArray = [];

        foreach($input as $value) {
            $values = explode('|', $value);
            array_push($outputArray, $values);
        }

        foreach($outputArray as $key => $value ) {
            unset($outputArray[$key][0]);
            $outputString = trim($outputArray[$key][1]);
            $outputs = preg_split('/\s+/', $outputString);
            $outputArray[$key][1] = $outputs;
            $outputArray[$key] = array_values($outputArray[$key]);
        }

        $counter = 0;

        foreach($outputArray as $outputs) {
            foreach($outputs[0] as $output) {
                if(strlen($output) == 2 || strlen($output) == 3 || strlen($output) == 4 || strlen($output) == 7)
                {
                    $counter++;
                }
            }
        }

        return $counter;
    }
}
