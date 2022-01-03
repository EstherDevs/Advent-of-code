<?php

namespace App\Http\Helpers;

use phpDocumentor\Reflection\Utils;

class DayFour
{
    public function __construct()
    {

    }

    public function getAnswer($input)
    {
        $bingoNumbers = $this->getBingoNumbers($input);
        $bingoCards = $this->getBingoCards($input, $bingoNumbers);

        $bingoCardsArrays = $this->getBingoCardsAsMultidimensionalArray($bingoCards);

        $answerPartOne = $this->playBingo($bingoNumbers, $bingoCardsArrays, false);
        $answerPartTwo = $this->playBingo($bingoNumbers, $bingoCardsArrays, true);

        return 'The first part is: ' . $answerPartOne . ' The second part is: ' . $answerPartTwo;
    }

    private function getBingoNumbers(string $input)
    {
        return substr($input, 0, strpos($input, PHP_EOL));
    }

    private function getBingoCards(string $input, string $bingoNumbers)
    {
        return str_replace($bingoNumbers, ' ', $input);
    }

    private function getBingoCardsAsMultidimensionalArray(string $bingoCards)
    {
        $bingoCards = str_replace(PHP_EOL, ',', $bingoCards);

        $cardRowsArray = array_filter(array_map('trim', explode(',', $bingoCards)));
        $cardRowsArray = array_values($cardRowsArray);

        $bingoCardsArray = [];
        $fiveCardRows = [];

        for($i = 0; $i < count($cardRowsArray); $i++) {
            if($i % 5 !== 0 || $i === 0) {
                array_push($fiveCardRows, preg_split('/\s+/', $cardRowsArray[$i]));
            } elseif ($i % 5 === 0 && $i > 0) {
                $singleBingoCard = ['singleBingoCard' => $fiveCardRows, 'hasWon' => false];
                array_push($bingoCardsArray, $singleBingoCard);
                $singleBingoCard = null;
                $fiveCardRows = [];

                if($i !== count($cardRowsArray)) {
                    array_push($fiveCardRows, preg_split('/\s+/', $cardRowsArray[$i]));
                }
            }
        }

        return $bingoCardsArray;
    }

    private function playBingo(string $bingoNumbers, array $bingoCardsArrays, bool $isPartTwo)
    {
        $bingoNumbers = explode(',', $bingoNumbers);

        $winner = $this->getWinner($bingoNumbers, $bingoCardsArrays, $isPartTwo);

        return $winner;
    }

    private function getWinner(array $bingoNumbers, array $bingoCards, bool $isPartTwo)
    {
        $checkedCards = $bingoCards;
        $lastWinner = false;

        foreach ($bingoNumbers as $number) {
            foreach($checkedCards as $key => $singleCard) {
                for($row = 0; $row < 5; $row++) {
                    for($col = 0; $col < 5; $col++) {
                        if(isset($checkedCards[$key]['singleBingoCard'][$row][$col]) && $checkedCards[$key]['singleBingoCard'][$row][$col] == $number) {
                            $checkedCards[$key]['singleBingoCard'][$row][$col] = 'X';
                        }
                    }
                }

                $winner = $this->checkWinCondition($bingoCards, $checkedCards, $number);

                if($isPartTwo && $winner) {
                    $checkedCards[$key]['hasWon'] = true;
                    $lastWinner = $this->checkLastWinCondition($checkedCards);
                }

                if(!$isPartTwo && $winner || isset($lastWinner) && $isPartTwo && $lastWinner && $winner) {
                    return $winner;
                }
            }
        }

        return 'and the winner iiiissss';
    }

    private function checkWinCondition(array $bingoCards, array $checkedCards, int $currentNumber)
    {
        foreach($checkedCards as $singleCard) {
            for($i = 0; $i < 5; $i++) {
                if(isset($singleCard['singleBingoCard'][$i]) &&
                    $singleCard['singleBingoCard'][$i][0] === 'X' &&
                    $singleCard['singleBingoCard'][$i][1] === 'X' &&
                    $singleCard['singleBingoCard'][$i][2] === 'X' &&
                    $singleCard['singleBingoCard'][$i][3] === 'X' &&
                    $singleCard['singleBingoCard'][$i][4] === 'X' ) {
                    $winningAnswer = $this->getAnswerSum($currentNumber, $singleCard['singleBingoCard']);

                    return 'we have a winner horizontally! The winning number is: ' . $winningAnswer;
                } elseif($singleCard['singleBingoCard'][0][$i] === 'X' &&
                    $singleCard['singleBingoCard'][1][$i] === 'X' &&
                    $singleCard['singleBingoCard'][2][$i] === 'X' &&
                    $singleCard['singleBingoCard'][3][$i] === 'X' &&
                    $singleCard['singleBingoCard'][4][$i] === 'X') {
                    $winningAnswer = $this->getAnswerSum($currentNumber, $singleCard['singleBingoCard']);

                    return 'we have a winner vertically! The winning number is: ' . $winningAnswer;
                }
            }
        }

        return '';
    }

    private function checkLastWinCondition(array $checkedCards): bool
    {
        foreach($checkedCards as $singleCard) {
            if(isset($singleCard['hasWon']) && $singleCard['hasWon'] === false) {
                return false;
            }
        }
        return true;
    }

    private function getAnswerSum(int $currentNumber, array $winningCard)
    {
        $remainingNumberSum = 0;

        for($row = 0; $row < 5; $row++) {
            for($col = 0; $col < 5; $col++) {
                if(isset($winningCard[$row][$col]) && $winningCard[$row][$col] !== 'X') {
                    $remainingNumberSum += $winningCard[$row][$col];
                }
            }
        }

        return $currentNumber * $remainingNumberSum;
    }
}
