<?php

namespace App\Http\Controllers;

use App\Http\Helpers\DayEight;
use App\Http\Helpers\DayFive;
use App\Http\Helpers\DayFour;
use App\Http\Helpers\DayNine;
use App\Http\Helpers\DayOne;
use App\Http\Helpers\DaySeven;
use App\Http\Helpers\DaySix;
use App\Http\Helpers\DayTen;
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

    public function getAnswerDayFour()
    {
        $input = $this->getDayInputFile('day-4.php');

        $helper = new DayFour();
        $answer = $helper->getAnswer($input);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayFive()
    {
        $input = $this->getDayInputFile('day-5.php');

        $helper = new DayFive();
        $answer = $helper->getAnswer($input);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDaySix()
    {
        $input = $this->getDayInputFile('day-6.php');

        $helper = new DaySix();
        $answer = $helper->getAnswer($input);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDaySeven()
    {
//        $input = $this->getDayInputFile('day-7.php');
//
//        $helper = new DaySeven();
//        $answer = $helper->getAnswer($input);

        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayEight()
    {
        $input = $this->getDayInputFile('day-8.php');
        $input = trim($input);
        $inputArray = $this->getDayInputAsArray($input);

        $helper = new DayEight();
        $answer = $helper->getAnswer($inputArray);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayNine()
    {
        $input = $this->getDayInputFile('day-9.php');

        $helper = new DayNine();
        $answer = $helper->getAnswer($input);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTen()
    {
        $input = trim($this->getDayInputFile('day-10.php'));
        $inputArray = $this->getDayInputAsArray($input);

        $helper = new DayTen();
        $answer = $helper->getAnswer($inputArray);

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayEleven()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwelve()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayThirteen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayFourteen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayFifteen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDaySixteen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDaySeventeen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayEighteen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayNineteen()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwenty()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwentyone()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwentytwo()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwentythree()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwentyfour()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }

    public function getAnswerDayTwentyfive()
    {
        $answer = '';

        return 'Today\'s answer: ' . $answer;
    }
}
