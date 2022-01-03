<?php

namespace App\Http\Helpers;

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

        $bingoWinner = $this->playBingo($bingoNumbers, $bingoCardsArrays);


//        dd($bingoNumbers, $bingoCardsArrays);

        $answerPartOne = $bingoWinner;
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
            if($i % 5 !== 0 || $i === 0) {
                array_push($fiveCardRows, preg_split('/\s+/', $cardRowsArray[$i]));
            } elseif ($i % 5 === 0 && $i > 0) {
                $singleBingoCard = ['singleBingoCard' => $fiveCardRows];
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

    private function playBingo(string $bingoNumbers, array $bingoCardsArrays)
    {
        $bingoNumbers = explode(',', $bingoNumbers);
        $checkedCards = $bingoCardsArrays;

//        dd($checkedCards);

//        foreach ($bingoNumbers as $number) {
//            foreach($checkedCards as $singleCard) {
//                dd($singleCard);
//            }
//        }


        return 'the squid wins!';
    }
}
