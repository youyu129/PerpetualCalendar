<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <title>Calendar</title>
    <style>
    /*請在這裹撰寫你的CSS*/
    body {
        background-image: url('https://cdn.pixabay.com/photo/2015/12/03/08/50/paper-1074131_1280.jpg');
        background-size: cover;
        background-position: center;
    }

    /* 用偽元素調淡背景 */
    body::after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.1);
        /* 半透明白色覆蓋層，調整透明度 */
        z-index: -1;
        /* 保證覆蓋層在背景下 */
    }

    .title {
        width: 680px;
        margin: auto;
    }

    h1,
    h2 {
        text-align: center;
        color: rgb(104, 22, 22);
    }

    h3 {
        text-align: left;
        color: rgb(104, 22, 22);
    }

    table {
        width: 595px;
        height: 60vh;
        border-collapse: collapse;
    }

    .table-box {
        width: 595px;
        padding: 20px;
        margin: 10px auto 10px;
        background-color: rgba(255, 255, 255, 0.45);
        border-radius: 20px;
    }

    tr,
    td {
        color: rgb(83, 11, 11);
        border: 2px solid rgb(212, 155, 155);
        font-size: 1.2em;
        text-align: right;
    }

    td {
        width: 85px;
        height: 50px;
        padding: 8px;
        text-align: right;
        /* 水平對齊到右邊 */
        vertical-align: top;
        /* 垂直對齊到上邊 */
    }

    .week {
        color: rgb(83, 11, 11);
        font-size: 24px;
        height: 40px;
        text-align: center;
        padding-bottom: 3px;
        border: 0;
    }

    /* 週末樣式 */
    .weekend {
        color: rgb(221, 5, 5);
    }

    /* 今日樣式 */
    .today {
        background-color: rgba(248, 177, 97, 0.5);
    }

    /* 非當月樣式 */
    .gray-text {
        color: gray;
    }

    /* 國定假日樣式 */
    .holiday {
        color: red;
    }

    /* 導覽區塊樣式 */
    .nav {
        width: 680px;
        text-align: center;
        margin: auto;
        display: flex;
        justify-content: space-between;
    }

    /* nav按鈕靠左靠右 */
    .left,
    .right {
        display: flex;
        gap: 10px;
        /* 元素之間間隔 10px */
    }

    /* 導覽按鈕樣式 */
    .nav-button {
        font-weight: bold;
        display: inline-block;
        padding: 10px 15px;
        margin: 5px;
        background-color: rgba(230, 222, 230, 0.6);
        color: rgb(139, 23, 23);
        text-decoration: none;
        /* 去掉下底線 */
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: background-color 0.3s, transform 0.3s;
        /* 動畫效果 */
        cursor: pointer;
        /*手型指標*/
    }

    /* 導覽按鈕懸停樣式 */
    .nav-button:hover {
        background-color: rgba(233, 225, 233, 0.7);
        transform: scale(1.1);
    }

    /* 導覽按鈕點擊縮小效果 */
    .nav-button:active {
        transform: scale(0.95);
    }

    .festival {
        color: rgb(231, 14, 14);
        font-size: 14px;
        /* 讓節日名稱在日期下方顯示 */
        position: relative;
        /* 將定位方式設為絕對定位 */
        bottom: 0px;
        /* 與底部間隔 2px */
        left: 0px;
        /* 與左側間隔 2px */
        display: block;
        text-align: left;
    }

    /* 佳句樣式 */
    .sentences {
        font-size: 24px;
        text-align: center;
        font-style: italic;
        color: rgb(139, 23, 23);
        margin: 0 auto;
        font-family: Calibri, Tahoma, Verdana, Geneva, sans-serif;
    }

    /* Today按鈕樣式 */
    .fixed-button {
        position: fixed;
        right: 50px;
        top: 50px;
        padding: 10px 15px;
        background-color: #f6d1bd;
        color: rgb(139, 23, 23);
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        /* 陰影 */
        transition: background-color 0.3s;
        /* 漸變效果 */
        text-decoration: none;
    }

    /* Today按鈕hover */
    .fixed-button:hover {
        background-color: #b86b3b;
        /* 懸停效果 */
        color: rgba(255, 255, 255, 0.5);
    }

    /* 中央當前年月樣式 */
    .current {
        color: rgb(104, 22, 22);
        font-size: 28px;
        text-align: center;
        text-shadow: 1px 1px 2px rgba(52, 4, 4, 0.7);
        display: inline;
    }
    </style>
</head>

<body>
    <div class="title">
        <h1>Calendar</h1>
        <h3><span><?=date("Y-m-d");?>&nbsp;&nbsp;</span><span id="time"></span></h3>
        <?php
/*請在這裹撰寫你的萬年曆程式碼*/

// 設定時區為台灣
date_default_timezone_set("Asia/Taipei");
?>
        <!-- 顯示當前日期時間 -->
    </div>
    <?php

// 當前的年、月、日
$year = date("Y");
$month = date("m");
$day = date("d");

$todayYear = date("Y");
$todayMonth = date("m");

// 定義去年、明年、上月、下月
$lastYear = $year - 1 ;
$nextYear = $year + 1 ;
$prevMonth = ($month - 1 < 1)?'12':$month - 1;
$nextMonth = ($month + 1 > 1)?'1':$month + 1 ;
$prevYear = ($month - 1 < 1) ? $lastYear : $year;
$nextYearForNextMonth = ($month + 1 > 12) ? $nextYear : $year;

// 國定假日
$holidays = [
  "01-01" => "元旦",
  "02-28" => "228紀念日",
  "04-04" => "兒童節",
  "04-05" => "清明節", 
  "05-01" => "勞動節",
  "10-10" => "國慶日"
];

// GET month 和 year
if(isset($_GET['month'])){
  $month=$_GET['month'];
}else{
  $month=date("m");
}
if(isset($_GET['year'])){
  $year=$_GET['year'];
}else{
  $year=date("Y");
}

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
    <!-- 月曆顯示的月份 -->
    <div>

    </div>
    <!-- 導覽按鈕 -->
    <div class='nav'>
        <div class="left">
            <a class="nav-button" href="index.php?year=<?=$year-1;?>&month=<?=$month;?>">Last Year</a>
            <a class="nav-button" href="index.php?year=<?=$prevYear;?>&month=<?=$prevMonth;?>">Last Month</a>
        </div>
        <!-- 月曆當前顯示的年月 -->
        <div class="current">
            <?=date("Y-F",strtotime("$year-$month"));?>
        </div>
        <div class="right">
            <a class="nav-button" href="index.php?year=<?=$nextYear;?>&month=<?=$nextMonth;?>">Next Month</a>
            <a class="nav-button" href="index.php?year=<?=$year+1;?>&month=<?=$month;?>">Next Year</a>
        </div>

    </div>

    <!-- 月曆表格 -->
    <div class="table-box">
        <table>
            <tr class="week">
                <td class="week weekend">Sun</td>
                <td class="week">Mon</td>
                <td class="week">Tue</td>
                <td class="week">Wed</td>
                <td class="week">Thu</td>
                <td class="week">Fri</td>
                <td class="week weekend">Sat</td>
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

      // 國定假日樣式
      $holidayKey = date("m-d", $theDayTime); 
      $isHoliday = array_key_exists($holidayKey, $holidays) ? 'holiday' : '';

      // 顯示日期
      echo "<td class='$theMonth $isToday $weekend $isHoliday'>";
      echo date("d",$theDayTime);

      // 顯示國定假日
      $holidayKey = date("m-d", $theDayTime);  // 取得 "mm-dd" 格式的日期
      if (array_key_exists($holidayKey, $holidays)) {
          echo "<br><span class='festival'>" . $holidays[$holidayKey] . "</span>";
      }
      echo "</td>";
    }
    echo "</tr>";
  }
  ?>
        </table>
    </div>

    <a class="fixed-button" href="index.php?year=<?=$todayYear;?>&month=<?=$todayMonth;?>">Today</a>

    <div class="sentences">
        <?php
    $sentences = [
      "Believe you can and you're halfway there.",
      "Success is not the key to happiness.",
      "The only way to do great work is to love what you do.",
      "Your limitation—it's only your imagination.",
      "Push yourself, because no one else will.",
      "Great things never come from comfort zones.",
      "Dream it. Wish it. Do it.",
      "Success doesn’t just find you. Go get it.",
      "The harder you work, the greater you'll feel.",
      "Dream bigger. Do bigger.",
      "Don't stop when you're tired. Stop when done.",
      "Wake up with determination. Go to bed satisfied.",
      "Do something today your future self will thank you for.",
      "Little things make big days.",
      "It's going to be hard, but hard does not mean impossible.",
      "Don’t wait for opportunity. Create it.",
      "Sometimes we’re tested to discover our strengths.",
      "The key to success is to focus on goals.",
      "Your life does not get better by chance.",
      "You don’t have to be great to start.",
      "Act as if what you do makes a difference.",
      "If you can dream it, you can do it.",
      "Opportunities don't happen. You create them.",
      "The secret of getting ahead is getting started.",
      "Keep your face toward the sunshine.",
      "You are never too old to set a new goal.",
      "What lies behind us are tiny matters compared to what lies within.",
      "Believe in yourself and all that you are.",
      "Don't watch the clock; do what it does.",
      "Failure will never overtake me if my determination is strong.",
      "We may encounter many defeats but we must not be defeated.",
      "Success comes to those who are busy.",
      "The future belongs to those who believe.",
      "Don't limit your challenges. Challenge your limits.",
      "Keep your eyes on the stars, and your feet on the ground.",
      "The way to get started is to quit talking.",
      "Your passion is waiting for your courage to catch up.",
      "If you want to achieve greatness, stop asking for permission.",
      "Everything you’ve ever wanted is on the other side of fear.",
      "Success is not how high you have climbed.",
      "The harder you work, the luckier you get.",
      "Don't be pushed around by the fears in your mind.",
      "It does not matter how slowly you go.",
      "Everything you can imagine is real.",
      "What you get by achieving your goals is important.",
      "Success is walking from failure to failure.",
      "You are braver than you believe.",
      "You miss 100% of the shots you don't take.",
      "The only person you are destined to become is you.",
      "Start where you are. Use what you have.",
      "The best way to predict the future is to create it.",
      "Success is not just about what you accomplish.",
      "In the end, we only regret the chances we didn't take.",
      "The biggest risk is not taking any risk.",
      "Every day may not be good, but there's something good in every day.",
      "Stay positive, work hard, make it happen.",
      "The journey of a thousand miles begins with one step.",
      "Your only limit is you.",
      "Success is a series of small wins.",
      "The best view comes after the hardest climb.",
      "Your attitude, not your aptitude, will determine your altitude.",
      "You have the power to create change.",
      "Happiness is not by chance, but by choice.",
      "Life is what happens when you're busy making other plans.",
      "If you're going through hell, keep going.",
      "What you get by achieving your goals is not as important as what you become.",
      "Hardships often prepare ordinary people for an extraordinary destiny.",
      "Believe you can and you're halfway there.",
      "Don't be pushed by your problems. Be led by your dreams.",
      "You have to expect things of yourself before you can do them.",
      "If you can dream it, you can achieve it.",
      "Opportunities are usually disguised as hard work.",
      "Success is the sum of small efforts, repeated day in and day out.",
      "Don't wait. The time will never be just right.",
      "Life isn't about finding yourself. Life is about creating yourself.",
      "Dream big and dare to fail.",
      "You are enough just as you are.",
      "Every moment is a fresh beginning.",
      "The future depends on what you do today.",
      "Doubt kills more dreams than failure ever will.",
      "You are capable of amazing things.",
      "It's not whether you get knocked down; it's whether you get up.",
      "The only limit to our realization of tomorrow is our doubts of today.",
      "Success usually comes to those who are too busy to be looking for it.",
      "Believe in the magic within you.",
      "You are stronger than you think.",
      "Be the change that you wish to see in the world.",
      "If you want something you've never had, you must be willing to do something you've never done."
  ];
  echo $sentences[rand(0, count($sentences) - 1)];
  ?>
    </div>

    <script>
    function updateTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('time').textContent = timeString;
    }

    // 每秒更新一次時間
    setInterval(updateTime, 1000);

    // 初始化顯示時間
    updateTime();
    </script>
</body>

</html>