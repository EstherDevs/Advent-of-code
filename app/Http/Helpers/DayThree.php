<?php

namespace App\Http\Helpers;

class DayThree
{
    public function __construct()
    {

    }

    public function getAnswer(array $inputArray)
    {
        $answerPartOne = $this->getAnswerPartOne($inputArray);
        $answerPartTwo = $this->getAnswerPartTwo($inputArray);

        return 'The first part is: ' . $answerPartOne . ' The second part is: ' . $answerPartTwo;
    }

    private function getAnswerPartOne(array $inputArray)
    {
        $oneBinaries = array_fill(0, 12, 0);
        $zeroBinaries = array_fill(0, 12, 0);

        foreach($inputArray as $input) {
            $binaryArray = str_split($input);

            foreach($binaryArray as $key => $value) {
                if($value == 1) {
                    $oneBinaries[$key] += 1;
                } elseif ($value == 0) {
                    $zeroBinaries[$key] += 1;
                }
            }
        }

        $mostEntriesBinary = implode('', $this->getMostEntriesBinary($oneBinaries, $zeroBinaries));
        $leastEntriesBinary = implode('', $this->getLeastEntriesBinary($oneBinaries, $zeroBinaries));

        return bindec($mostEntriesBinary) * bindec($leastEntriesBinary);
    }

    private function getMostEntriesBinary(array $oneBinaries, array $zeroBinaries)
    {
        $mostEntriesBinary = [];

        for($i=0; $i <= 11; $i++) {
            if(isset($oneBinaries[$i], $zeroBinaries[$i])) {
                if($oneBinaries[$i] > $zeroBinaries[$i]) {
                    $mostEntriesBinary[$i] = 1;
                } elseif($zeroBinaries[$i] > $oneBinaries [$i]) {
                    $mostEntriesBinary[$i] = 0;
                }
            }
        }

        return $mostEntriesBinary;
    }

    private function getLeastEntriesBinary(array $oneBinaries, array $zeroBinaries)
    {
        $leastEntriesBinary = [];

        for($i=0; $i <= 11; $i++) {
            if(isset($oneBinaries[$i], $zeroBinaries[$i])) {
                if ($oneBinaries[$i] < $zeroBinaries[$i]) {
                    $leastEntriesBinary[$i] = 1;
                } elseif ($zeroBinaries [$i] < $oneBinaries[$i]) {
                    $leastEntriesBinary[$i] = 0;
                }
            }
        }

        return $leastEntriesBinary;
    }

    private function getAnswerPartTwo(array $inputArray)
    {
        $mostCommonBinary = implode('', $this->getCommonBinary($inputArray));
        $leastCommonBinary = implode('', $this->getCommonBinary($inputArray, true));

        return bindec($mostCommonBinary) * bindec($leastCommonBinary);
    }

    private function getCommonBinary(array $inputArray, bool $leastCommon = false)
    {
        $commonBinary = array_filter($inputArray);

        $zeros = 0;
        $ones = 0;

        for($i = 0; $i <= 11; $i++) {
            if(count($commonBinary) > 1) {
                foreach($commonBinary as $input) {
                    $binaryArray = str_split($input);

                    if(isset($binaryArray[$i]) && $binaryArray[$i] == 1) {
                        $ones += 1;
                    } elseif(isset($binaryArray[$i]) && $binaryArray[$i] == 0) {
                        $zeros += 1;
                    }
                }

                if($zeros === $ones || $zeros < $ones) {
                    $commonBinary = $this->removeArrayPosition($commonBinary, $i, $leastCommon ? 1 : 0);
                } elseif($zeros > $ones) {
                    $commonBinary = $this->removeArrayPosition($commonBinary, $i, $leastCommon ? 0 : 1);
                }

                $zeros = 0;
                $ones = 0;
            }
        }

        return $commonBinary;
    }

    private function removeArrayPosition(array $inputArray, int $key, int $removeValue)
    {
        foreach($inputArray as $inputKey => $inputValue) {
            $binaryArray = str_split($inputValue);
            if(isset($binaryArray[$key]) && $binaryArray[$key] == $removeValue) {
                unset($inputArray[$inputKey]);
            }
        }

        return array_values($inputArray);
    }
}
