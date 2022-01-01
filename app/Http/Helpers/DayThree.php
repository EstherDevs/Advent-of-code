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
        $mostCommonBinary = implode('', $this->getMostCommonBinary($inputArray));
        $leastCommonBinary = implode('', $this->getLeastCommonBinary($inputArray));

        return bindec($mostCommonBinary) * bindec($leastCommonBinary);
    }

    private function getMostCommonBinary(array $inputArray)
    {
        $mostCommonBinary = array_filter($inputArray);

        $zeros = 0;
        $ones = 0;

        for($i = 0; $i <= 11; $i++) {
            if(count($mostCommonBinary) > 1) {
                foreach($mostCommonBinary as $input) {
                    $binaryArray = str_split($input);

                    if(isset($binaryArray[$i]) && $binaryArray[$i] == 1) {
                        $ones += 1;
                    } elseif(isset($binaryArray[$i]) && $binaryArray[$i] == 0) {
                        $zeros += 1;
                    }
                }

                if($zeros === $ones || $zeros < $ones) {
                    $mostCommonBinary = $this->removeArrayPosition($mostCommonBinary, $i, 0);
                } elseif($zeros > $ones) {
                    $mostCommonBinary = $this->removeArrayPosition($mostCommonBinary, $i, 1);
                }

                $zeros = 0;
                $ones = 0;
            }
        }

        return $mostCommonBinary;
    }

    private function getLeastCommonBinary(array $inputArray)
    {
        $leastCommonBinary = array_filter($inputArray);

        $zeros = 0;
        $ones = 0;

        for($i = 0; $i <= 11; $i++) {

            if(count($leastCommonBinary) > 1) {
                foreach($leastCommonBinary as $input) {
                    $binaryArray = str_split($input);

                    if(isset($binaryArray[$i]) && $binaryArray[$i] == 1) {
                        $ones += 1;
                    } elseif(isset($binaryArray[$i]) && $binaryArray[$i] == 0) {
                        $zeros += 1;
                    }
                }

                if($zeros === $ones || $zeros < $ones) {
                    $leastCommonBinary = $this->removeArrayPosition($leastCommonBinary, $i, 1);
                } elseif($zeros > $ones) {
                    $leastCommonBinary = $this->removeArrayPosition($leastCommonBinary, $i, 0);
                }

                $zeros = 0;
                $ones = 0;
            }
        }

        return $leastCommonBinary;
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
