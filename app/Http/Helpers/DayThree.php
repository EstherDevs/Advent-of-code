<?php

namespace App\Http\Helpers;

class DayThree
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

        return 'The first part is: ' . $answerPartOne . ' The second part is: ' . $answerPartTwo;
    }

    /**
     * @param array $inputArray
     * @return int
     */
    private function getAnswerPartOne(array $inputArray) : int
    {
        $oneBinaries = array_fill(0, 12, 0);
        $zeroBinaries = array_fill(0, 12, 0);

        foreach ($inputArray as $input) {
            $binaryArray = str_split($input);

            foreach ($binaryArray as $key => $value) {
                if ($value == 1) {
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

    /**
     * @param array $oneBinaries
     * @param array $zeroBinaries
     * @return array
     */
    private function getMostEntriesBinary(array $oneBinaries, array $zeroBinaries) : array
    {
        $mostEntriesBinary = [];

        for ($i=0; $i <= 11; $i++) {
            if (isset($oneBinaries[$i], $zeroBinaries[$i])) {
                if ($oneBinaries[$i] > $zeroBinaries[$i]) {
                    $mostEntriesBinary[$i] = 1;
                } elseif ($zeroBinaries[$i] > $oneBinaries [$i]) {
                    $mostEntriesBinary[$i] = 0;
                }
            }
        }

        return $mostEntriesBinary;
    }

    /**
     * @param array $oneBinaries
     * @param array $zeroBinaries
     * @return array
     */
    private function getLeastEntriesBinary(array $oneBinaries, array $zeroBinaries) : array
    {
        $leastEntriesBinary = [];

        for ($i=0; $i <= 11; $i++) {
            if (isset($oneBinaries[$i], $zeroBinaries[$i])) {
                if ($oneBinaries[$i] < $zeroBinaries[$i]) {
                    $leastEntriesBinary[$i] = 1;
                } elseif ($zeroBinaries [$i] < $oneBinaries[$i]) {
                    $leastEntriesBinary[$i] = 0;
                }
            }
        }

        return $leastEntriesBinary;
    }

    /**
     * @param array $inputArray
     * @return int
     */
    private function getAnswerPartTwo(array $inputArray) : int
    {
        $mostCommonBinary = implode('', $this->getCommonBinary($inputArray));
        $leastCommonBinary = implode('', $this->getCommonBinary($inputArray, true));

        return bindec($mostCommonBinary) * bindec($leastCommonBinary);
    }

    /**
     * @param array $inputArray
     * @param bool $leastCommon
     * @return array
     */
    private function getCommonBinary(array $inputArray, bool $leastCommon = false) : array
    {
        $commonBinary = array_filter($inputArray);

        $zeros = 0;
        $ones = 0;

        for ($i = 0; $i <= 11; $i++) {
            if (count($commonBinary) > 1) {
                foreach ($commonBinary as $input) {
                    $binaryArray = str_split($input);

                    if (isset($binaryArray[$i]) && $binaryArray[$i] == 1) {
                        $ones += 1;
                    } elseif (isset($binaryArray[$i]) && $binaryArray[$i] == 0) {
                        $zeros += 1;
                    }
                }

                if ($zeros === $ones || $zeros < $ones) {
                    $commonBinary = $this->removeArrayPosition($commonBinary, $i, $leastCommon ? 1 : 0);
                } elseif ($zeros > $ones) {
                    $commonBinary = $this->removeArrayPosition($commonBinary, $i, $leastCommon ? 0 : 1);
                }

                $zeros = 0;
                $ones = 0;
            }
        }

        return $commonBinary;
    }

    /**
     * @param array $inputArray
     * @param int $key
     * @param int $removeValue
     * @return array
     */
    private function removeArrayPosition(array $inputArray, int $key, int $removeValue) : array
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
