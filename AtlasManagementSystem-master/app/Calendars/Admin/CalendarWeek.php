<?php
namespace App\Calendars\Admin;

use Carbon\Carbon;

class CalendarWeek{
  protected $carbon;
  protected $index = 0;

  function __construct($date, $index = 0){
    $this->carbon = new Carbon($date);
    $this->index = $index;
  }

  function getClassName(){
    return "week-" . $this->index;
  }

  function getDays(){ //CalendarWeekDayの配列を作る
    $days = [];
    $startDay = $this->carbon->copy()->startOfWeek(); //週の初めの日付
    $lastDay = $this->carbon->copy()->endOfWeek(); //週の終わりの日付
    $tmpDay = $startDay->copy();

    while($tmpDay->lte($lastDay)){
      if($tmpDay->month != $this->carbon->month){
        $day = new CalendarWeekBlankDay($tmpDay->copy());
        $days[] = $day;
        $tmpDay->addDay(1);
        continue;
       }
       $day = new CalendarWeekDay($tmpDay->copy());
       $days[] = $day;
       $tmpDay->addDay(1);
    }
    return $days;
  }
}
