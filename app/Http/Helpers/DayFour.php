<?php

namespace App\Http\Helpers;

class DayFour
{
    public function __construct()
    {

    }

    public function getAnswer($input)
    {
        // dd(gettype($input));

        $bingoNumbers = $this->getBingoNumbers($input);
        $bingoCards = $this->getBingoCards($input, $bingoNumbers);

        $bingoCardsArrays = $this->getBingoCardsAsMultidimensionalArray($bingoCards);

        dd($bingoNumbers, $bingoCardsArrays);

        $answerPartOne = 'Unknown';
        $answerPartTwo = 'Unknown';

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
            if($i % 5 !== 0) {
                array_push($fiveCardRows, preg_split('/\s+/', $cardRowsArray[$i]));
            } elseif ($i % 5 === 0) {
                $singleBingoCard = ['singleBingoCard' => $fiveCardRows];
                array_push($bingoCardsArray, $singleBingoCard);
                $singleBingoCard = null;
                $fiveCardRows = [];

                if($i !== count($cardRowsArray)) {
                    array_push($fiveCardRows, preg_split('/\s+/', $cardRowsArray[$i]));
                }
            }
        }

        dd($bingoCardsArray);

        foreach($cardsArray as $card) {
            $bingoCardsArray[] = preg_split('/\s+/', $card);
        }

        return $singleBingoCardArray;
    }
}
