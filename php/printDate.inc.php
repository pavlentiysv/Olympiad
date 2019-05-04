<?php
function printMonthsList() {
    for ($i=1; $i<=12; $i++) {
        $monthName = '';
        switch($i) {
            case 1: $monthName='Январь'; break;
            case 2: $monthName='Февраль'; break;
            case 3: $monthName='Март'; break;
            case 4: $monthName='Апрель'; break;
            case 5: $monthName='Май'; break;
            case 6: $monthName='Июнь'; break;
            case 7: $monthName='Июль'; break;
            case 8: $monthName='Август'; break;
            case 9: $monthName='Сентябрь'; break;
            case 10: $monthName='Октябрь'; break;
            case 11: $monthName='Ноябрь'; break;
            case 12: $monthName='Декабрь'; break;
        }
        echo '<option value="'.$i.'">'.$monthName.'</option>';
    }
}

function printDaysList() {
    for ($i=1; $i<=31; $i++) {
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
}

function printYearList() {
    for ($i=date("Y", time())-20; $i<=date("Y", time())-15; $i++) {
        echo '<option value="'.$i.'">'.$i.'</option>';
    }
}
?>