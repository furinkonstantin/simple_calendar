<?php

    class Calendar {
    
        public $headings = array('Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс');
        
        public $years = array(2016, 2017);
        
        public $months = Array(
            0 => 'Январь',
            1 => 'Февраль',
            2 => 'Март',
            3 => 'Апрель',
            4 => 'Май',
            5 => 'Июнь',
            6 => 'Июль',
            7 => 'Август',
            8 => 'Сентябрь',
            9 => 'Октябрь',
            10 => 'Ноябрь',
            11 => 'Декабрь'
        );

        public function DrawHtml($month, $year) {
            $month = $month + 1;
            $res = '<table cellpadding="0" cellspacing="0" class="b-calendar__tb">';
            $headings = $this->headings;
            $res .= '<tr class="b-calendar__row">';
            for ($head_day = 0; $head_day <= 6; $head_day++) {
                $res .= '<th class="b-calendar__head';
                if ($head_day != 0) {
                    if (($head_day % 5 == 0) || ($head_day % 6 == 0)) {
                        $res .= ' b-calendar__weekend';
                    }
                }
                $res .= '">';
                $res .= '<div class="b-calendar__number">'.$headings[$head_day].'</div>';
                $res .= '</th>';
            }
            $res .= '</tr>';

            $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
            $running_day = $running_day - 1;
            if ($running_day == -1) {
                $running_day = 6;
            }
            
            $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
            $day_counter = 0;
            $days_in_this_week = 1;
            
            $res .= '<tr class="b-calendar__row">';
            
            for ($x = 0; $x < $running_day; $x++) {
                $res.= '<td class="b-calendar__np"></td>';
                $days_in_this_week++;
            }
            
            for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
                $res .= '<td class="b-calendar__day';

                if ($running_day != 0) {
                    if (($running_day % 5 == 0) || ($running_day % 6 == 0)) {
                        $res .= ' b-calendar__weekend';
                    }
                }
                $res .= '">';

                $res .= '<div class="b-calendar__number">'.$list_day.'</div>';
                $res .= '</td>';

                if ($running_day == 6) {
                    $res .= '</tr>';
                    if (($day_counter + 1) != $days_in_month) {
                        $res.= '<tr class="b-calendar__row">';
                    }
                    $running_day = -1;
                    $days_in_this_week = 0;
                }

                $days_in_this_week++; 
                $running_day++; 
                $day_counter++;
            }

            if ($days_in_this_week < 8) {
                for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
                    $res .= '<td class="b-calendar__np"> </td>';
                }
            }
            $res .= '</tr>';
            $res .= '</table>';

            return $res;
        }
        
    }