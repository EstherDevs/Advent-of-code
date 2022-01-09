<?php

namespace App\Http\Helpers;

class DayNine
{
    public function getAnswer(string $input)
    {
        $input = trim($input);
        $input = explode(PHP_EOL, $input);
        $heatmapArray = $this->getHeatmapArray($input);

        $answerPartOne = $this->getDepthPointsSum($heatmapArray);

        return 'Answer part one is: ' . $answerPartOne;
    }

    private function getHeatmapArray(array $input)
    {
        $heatmapArray = $input;

        foreach($heatmapArray as $key => $value) {
            $heatmapArray[$key] = array_map('intval', str_split($value));
        }

        return $heatmapArray;
    }

    private function getDepthPointsSum(array $heatmap)
    {
        $depthPointSum = 0;

        foreach($heatmap as $pointsRow => $points) {
            foreach ($points as $key => $point) {
                $previousRow = $pointsRow - 1;
                $nextRow = $pointsRow + 1;
                $previousPoint = $key - 1;
                $nextPoint = $key + 1;

                if(isset($heatmap[$previousRow][$key])) {
                    $upDepth = $heatmap[$previousRow][$key];
                } else {
                    $upDepth = 10;
                }

                if(isset($heatmap[$nextRow][$key])) {
                    $downDepth = $heatmap[$nextRow][$key];
                } else {
                    $downDepth = 10;
                }

                if(isset($points[$previousPoint])) {
                    $leftDepth = $points[$previousPoint];
                } else {
                    $leftDepth = 10;
                }

                if(isset($points[$nextPoint])) {
                    $rightDepth = $points[$nextPoint];
                } else {
                    $rightDepth = 10;
                }

                if($point < $upDepth && $point < $downDepth && $point < $leftDepth && $point < $rightDepth) {
                    $depthPointSum += $point + 1;
                }
            }
        }

        return $depthPointSum;
    }
}
