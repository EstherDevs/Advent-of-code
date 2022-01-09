<?php

namespace App\Http\Helpers;

class DayTen
{
    protected $legalPairs = ['()', '[]', '{}', '<>'];
    protected $legalPairOpening = ['(', '[', '{', '<'];
    protected $legalPairClosing = [')', ']', '}', '>'];

    protected $illegalCharacterScores = [
                ')' => 3,
                ']' => 57,
                '}' => 1197,
                '>' => 25137,
                ];

    public function getAnswer(array $input)
    {
        $illegalSetsCount = $this->findIllegalSets($input);

        $answerPartOne = $this->getIllegalCharacterScore($illegalSetsCount);

        return 'The answer to part one is: ' . $answerPartOne;
    }

    private function findIllegalSets(array $inputArray): array
    {
        $illegalSetsCount = [
            ')' => 0,
            ']' => 0,
            '}' => 0,
            '>' => 0,
        ];

        foreach ($inputArray as $line => $input) {
            $characters = str_split($input);
            $stack = [];

            foreach ($characters as $character) {
                if (in_array($character, $this->legalPairOpening)) {
                    $stack[] = $character;
                    continue;
                }
                $pair = end($stack) . $character;
                if (in_array($pair, $this->legalPairs)) {
                    array_pop($stack);
                    continue;
                }

                $illegalSetsCount[$character] += 1;
                unset($inputArray[$line]);
                break;
            }
            unset($stack);
        }

        return $illegalSetsCount;
    }

    private function getIllegalCharacterScore(array $illegalSetsCount)
    {
        $illegalCharacterScore = 0;

        foreach($this->illegalCharacterScores as $character => $value) {
            $illegalCharacterScore += ($illegalSetsCount[$character] * $value);
        }

        return $illegalCharacterScore;
    }
}
