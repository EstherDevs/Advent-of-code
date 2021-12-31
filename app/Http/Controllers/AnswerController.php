<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DayOne;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnswerController extends Controller
{
    public function getDayInputFile($day)
    {
        return Storage::disk('local')->get('puzzle-inputs/' . $day);
    }

    public function getDayInputAsArray($input)
    {
        return array_map('intval', explode(PHP_EOL, $input));
    }

    public function getAnswerDayOne()
    {
        $input = $this->getDayInputFile('day-1.php');
        $inputArray = $this->getDayInputAsArray($input);

        $helper = new DayOne();
        $answer = $helper->getAnswer($inputArray);

        return 'Today\'s answer: ' . $answer;
    }
}
