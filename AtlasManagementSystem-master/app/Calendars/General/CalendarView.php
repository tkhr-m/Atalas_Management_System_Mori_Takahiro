<?php
namespace App\Calendars\General;

use Carbon\Carbon;
use Auth;

class CalendarView{

  private $carbon;
  function __construct($date){
    $this->carbon = new Carbon($date);
  }

  public function getTitle(){
    return $this->carbon->format('Y年n月');
  }

  function render(){
    $html = [];
    $html[] = '<div class="calendar text-center">';
    $html[] = '<table class="table">';
    $html[] = '<thead>';
    $html[] = '<tr>';
    $html[] = '<th>月</th>';
    $html[] = '<th>火</th>';
    $html[] = '<th>水</th>';
    $html[] = '<th>木</th>';
    $html[] = '<th>金</th>';
    $html[] = '<th>土</th>';
    $html[] = '<th>日</th>';
    $html[] = '</tr>';
    $html[] = '</thead>';
    $html[] = '<tbody>';
    $weeks = $this->getWeeks(); //CalendarWeekの配列
    foreach($weeks as $week){
      $html[] = '<tr class="'.$week->getClassName().'">';
      $days = $week->getDays();
      foreach($days as $day){
        $startDay = $this->carbon->copy()->format("Y-m-01");
        $toDay = $this->carbon->copy()->format("Y-m-d");

        if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){//過去の日付かどうか
          $html[] = '<td class="past-day calendar-td">';
        }else{
          $html[] = '<td class="calendar-td '.$day->getClassName().'">';
        }
        $html[] = $day->render();
        if(in_array($day->everyDay(), $day->authReserveDay())){//予約している日かどうか
          $reservePart = $day->authReserveDate($day->everyDay())->first()->setting_part;
          if($reservePart == 1){
            $reservePart = "リモ1部";
          }else if($reservePart == 2){
            $reservePart = "リモ2部";
          }else if($reservePart == 3){
            $reservePart = "リモ3部";
          }
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
            $html[] = '<p class="m-auto p-0 w-75" style="font-size:12px">'.$reservePart.'参加</p>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }else{
            $html[] = '<button class="btn btn-danger p-0 w-75 modal_cancel" data-date="'. $day->authReserveDate($day->everyDay())->first()->setting_reserve .'" data-number="'.$reservePart.'"  data-part="'.$day->authReserveDate($day->everyDay())->first()->setting_part.'" style="font-size:12px">'. $reservePart .'</button>';
            $html[] = '<input type="hidden" name="getPart[]" value="" form="reserveParts">';
          }
        }else{
          if($startDay <= $day->everyDay() && $toDay >= $day->everyDay()){
             $html[] = '<p>受付終了</p>';
             $html[] = '</td>';
             continue;
          }else{
          $html[] = $day->selectPart($day->everyDay());
          }
        }
        $html[] = $day->getDate();
        $html[] = '</td>';
      }
      $html[] = '</tr>';
    }
    $html[] = '</tbody>';
    $html[] = '</table>';
    $html[] = '</div>';
    $html[] = '<form action="/reserve/calendar" method="post" id="reserveParts">'.csrf_field().'</form>';
    $html[] = '<form action="/delete/calendar" method="post" id="deleteParts">'.csrf_field().'</form>';
    $html[] = '<div class="modal">';
    $html[] = '<div class="overlay modal_close"></div>';
    $html[] = '<div class="modal__content">';
    $html[] = '<p>予約日：<input type="text" id="reserveDay" name="getData[]" value="" form="deleteParts" readonly></p>';
    $html[] = '<p id="reservePartNumber"></p><input type="hidden" id="reservePart" name="getPart[]" value="" form="deleteParts" readonly>';
    $html[] = '<p>上記の内容をキャンセルしてもよろしいですか？</p>';
    $html[] = '<div id="cancelBtn">';
    $html[] = '<button class="btn btn-danger modal_close">閉じる</button>';
    $html[] = '<button type="submit" class="btn btn-primary" form="deleteParts">キャンセル</button>';
    $html[] = '</div>';
    $html[] = '</div>';
    return implode('', $html);
  }

  protected function getWeeks(){
    $weeks = [];
    $firstDay = $this->carbon->copy()->firstOfMonth();
    $lastDay = $this->carbon->copy()->lastOfMonth();
    $week = new CalendarWeek($firstDay->copy());
    $weeks[] = $week;
    $tmpDay = $firstDay->copy()->addDay(7)->startOfWeek();
    while($tmpDay->lte($lastDay)){
      $week = new CalendarWeek($tmpDay, count($weeks));
      $weeks[] = $week;
      $tmpDay->addDay(7);
    }
    return $weeks;
  }
}
