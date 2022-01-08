<?php

namespace App\Http\Helpers;

class DayFive
{
    public function getAnswer(string $input)
    {
        $coordArray = $this->getInputAsCoordArray($input);
        $mapArray = $this->getMapCoordArray($coordArray);
        $mapArrayPartTwo = $this->getMapCoordArrayWithDiagonals($coordArray, $mapArray);

        $answerPartOne = $this->getOverlappingPoints($mapArray);
        $answerPartTwo = $this->getOverlappingPoints($mapArrayPartTwo);

        return 'The answer for part one is: ' . $answerPartOne . ' And for part two is: ' . $answerPartTwo;
    }

    private function getInputAsCoordArray(string $input)
    {
        $input = trim($input);
        $input = str_replace(PHP_EOL, ",", $input);
        $input = str_replace("->", ",", $input);

        $input = preg_replace("!\s+!", "", $input);

        $inputArray = explode(",", $input);

        $coordArray = array_chunk($inputArray, 4);

        return $coordArray;
    }

    private function getMapCoordArray(array $coordArray)
    {
        $mapArray = [];
        $x1 = 0;
        $y1 = 1;
        $x2 = 2;
        $y2 = 3;

        foreach($coordArray as $coord) {
            if($coord[$x1] == $coord[$x2]) {
                // Vertical line
                $range = range($coord[$y1], $coord[$y2]);

                foreach ($range as $point) {
                    if(!isset($mapArray[$coord[$x1]][$point])) {
                        $mapArray[$coord[$x1]][$point] = 0;
                    }

                    $mapArray[$coord[$x1]][$point]++;
                }
            }

            if($coord[$y1] == $coord[$y2]) {
                // Horizontal line
                $range = range($coord[$x1], $coord[$x2]);

                foreach ($range as $point) {
                    if(!isset($mapArray[$point][$coord[$y1]])) {
                        $mapArray[$point][$coord[$y1]] = 0;
                    }

                    $mapArray[$point][$coord[$y1]]++;
                }
            }
        }

        return $mapArray;
    }

    private function getMapCoordArrayWithDiagonals(array $coordArray, array $mapArray)
    {
        $x1 = 0;
        $y1 = 1;
        $x2 = 2;
        $y2 = 3;

        foreach($coordArray as $coord) {
            $rangeX = range($coord[$x1], $coord[$x2]);
            $rangeY = range($coord[$y1], $coord[$y2]);
            $lenX = count($rangeX);
            $lenY = count($rangeY);

            if ($lenX == $lenY) {
                // Diagonal line

                $yCounter = 0;
                foreach ($rangeX as $xPos) {
                    if(!isset($mapArray[$xPos][$rangeY[$yCounter]])) {
                        $mapArray[$xPos][$rangeY[$yCounter]] = 0;
                    }

                    $mapArray[$xPos][$rangeY[$yCounter]] ++;
                    $yCounter ++;
                }
            }
        }

        return $mapArray;
    }

    private function getOverlappingPoints(array $mapArray)
    {
        $counter = 0;

        foreach($mapArray as $map) {
            foreach($map as $point) {
                if($point > 1) {
                    $counter ++;
                }
            }
        }

        return $counter;
    }
}
