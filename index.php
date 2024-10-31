<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="#">
  <title>Calendar</title>
  <style>
   /*請在這裹撰寫你的CSS*/
   body {
    background-image :url('https://cdn.pixabay.com/photo/2015/12/03/08/50/paper-1074131_1280.jpg');
    background-size: cover;
    background-position: center; 
  }
  h1,h2 {
    text-align:center;
   }
  table {
    width: 600px;
    height: 60vh;
    border-collapse:collapse;
    
  }
  tr,td {
    font-size:1.2em;
    text-align: center;
  }
  .weekend {
    color: red;
  }
  .today {
    background-color:lightblue;
  }
  .gray-text {
    color:gray;
  }
  .table-box {
    width: 600px;
    padding:20px;
    margin: 30px auto;
    background-color:rgba(255,200,100,0.5);
  }
    
  </style>
</head>
<body>
<h1>Calendar</h1>
<?php
/*請在這裹撰寫你的萬年曆程式碼*/

// 設定時區為台灣
date_default_timezone_set("Asia/Taipei");
?>
<!-- 顯示當前日期時間 -->
<h2><?=date("Y-m-d H:i:s");?></h2>

<?php

// 當前的年、月、日
$year = date("Y");
$month = date("m");
$day = date("d");

// 國定假日
$holidays = [
  "01-01" => "元旦",
  "02-28" => "和平紀念日",
  "04-04" => "兒童節",
  "04-05" => "清明節", 
  "05-01" => "勞動節",
  "10-10" => "國慶日"
];

// 設定月份區間為1至12
if($month-1<1){
  $prevMonth=12;
  $prevYear=$year-1;
}else{
  $prevMonth=$month-1;
  $prevYear=$year;
}

if($month+1>12){
  $nextMonth=1;
  $nextYear=$year+1;
}else{
  $nextMonth=$month+1;
  $nextYear=$year;
}

// 設定每月第一天
$firstDay = "{$year}-{$month}-01";
$firstDatTime = strtotime($firstDay);
// 設定星期w = 0（星期天）到 6（星期六）
$firstDayWeek = date("w",$firstDatTime);
?>
<div class="table-box">
  <table>
    <tr>
      <td class="weekend">Sun</td>
      <td>Mon</td>
      <td>Tue</td>
      <td>Wed</td>
      <td>Thu</td>
      <td>Fri</td>
      <td class="weekend">Sat</td>
    </tr>
  <?php

  // 用for迴圈生成表格日期
  for ($i=0; $i <5 ; $i++) { 
    echo "<tr>";

    for ($j=0; $j <7 ; $j++) {
      $cell=$i*7+$j-$firstDayWeek;
      $theDayTime=strtotime("$cell days".$firstDay); 

      // 非當月顯示為灰色字體
      $theMonth=(date("m",$theDayTime)==date("m",$firstDatTime))?'':'gray-text';

      // 今日樣式
      $isToday=(date("Y-m-d",$theDayTime))==date("Y-m-d")?'today':'';

      // 週末樣式
      $w=date("w",$theDayTime);
      $weekend=($w==0 || $w==6)?'weekend':'';

      // 顯示日期
      echo "<td class='$theMonth $isToday $weekend'>";
      echo date("d",$theDayTime);
      echo "</td>";
    }
    echo "</tr>";
  }

  ?>

  </table>
</div>
</body>
</html>