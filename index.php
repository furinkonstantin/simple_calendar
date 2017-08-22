<?php

    include_once(__DIR__ . "/classes/calendar.php");
    
    $calendar = new Calendar;
    
?>
    <div class="sort">
        <a href="?sort=years">Сортировка по годам</a>
        <a href="?sort=months">Сортировка по месяцам</a>
    </div>
<?
    
    $years = $calendar->years;
    
    if (isset($_GET["sort"]) && $_GET["sort"] == "years") {
        rsort($years);
    }
    
    $months = $calendar->months;
    
    if (isset($_GET["sort"]) && $_GET["sort"] == "months") {
        krsort($months);
    }

    foreach ($years as $year) :
        foreach ($months as $indexMonth => $month): ?>
            <div class="b-calendar b-calendar--many">
                <div class="b-calendar__title">
                    <span class="b-calendar__month"><?=$month?></span> 
                    <span class="b-calendar__year"><?=$year?></span>
                </div>
                <?
                    echo $calendar->DrawHtml($indexMonth, $year);
                ?>
            </div>
<? 
        endforeach;
    endforeach;
?>