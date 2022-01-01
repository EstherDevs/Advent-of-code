<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DayOne;
use App\Http\Helpers\DayThree;
use App\Http\Helpers\DayTwo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Utils;

class AnswerController extends Controller
{
    public function getDayInputFile($day)
    {
        return Storage::disk('local')->get('puzzle-inputs/' . $day);
    }

    public function getDayInputAsArray($input)
    {
        return explode(PHP_EOL, $input);
    }

    public function getAnswerDayOne()
    {
        $input = $this->getDayInputFile('day-1.php');
        $inputArray = array_map('intval', $this->getDayInputAsArray($input));

        $helper = new DayOne();
        $answer = $helper->getAnswer($inputArray);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwo()
    {
        $input = $this->getDayInputFile('day-2.php');
        $inputArray = $this->getDayInputAsArray($input);

        $helper = new DayTwo();
        $answer = $helper->getAnswer($inputArray);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayThree()
    {
        $input = $this->getDayInputFile('day-3.php');
        $inputArray = $this->getDayInputAsArray($input);

        $helper = new DayThree();
        $answer = $helper->getAnswer($inputArray);

        return 'Today\'s answer: ' . $answer;
    }
}
