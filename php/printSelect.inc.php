<?php
function printMonthsList($month)
{
    if ($month == null) {
        for ($i = 1; $i <= 12; $i++) { 
            echo "<option value='$i'>".getMonthName($i)."</option>";
        }
    } else {
        for ($i = 1; $i < $month; $i++) { 
            echo "<option value='$i'>".getMonthName($i)."</option>";
        }
        echo "<option selected value='$i'>".getMonthName($i)."</option>";
        for ($i = $month+1; $i <= 12; $i++) { 
            echo "<option value='$i'>".getMonthName($i)."</option>";
        }
    }
}

function getMonthName($i) {
    switch ($i) {
        case 1:
            return 'Январь';
            break;
        case 2:
            return 'Февраль';
            break;
        case 3:
            return 'Март';
            break;
        case 4:
            return 'Апрель';
            break;
        case 5:
            return 'Май';
            break;
        case 6:
            return 'Июнь';
            break;
        case 7:
            return 'Июль';
            break;
        case 8:
            return 'Август';
            break;
        case 9:
            return 'Сентябрь';
            break;
        case 10:
            return 'Октябрь';
            break;
        case 11:
            return 'Ноябрь';
            break;
        case 12:
            return 'Декабрь';
            break;
        default:
            return 'error';
    }
}

function printDaysList($day)
{
    if ($day == null) {
        for ($i = 1; $i <= 31; $i++) {
            echo "<option value='$i'>$i</option>";
        }
    } else {
        for ($i = 1; $i < $day; $i++) {
            echo "<option value='$i'>$i</option>";
        } 
        echo "<option selected value=$day>$day</option>";
        for ($i = $day+1; $i<=31; $i++) {
            echo "<option value='$i'>$i</option>";
        }
    }
}

function printYearList($year)
{
    if ($year == null) {
        for ($i = date("Y", time()) - 20; $i <= date("Y", time()) - 15; $i++) {
            echo "<option value='$i'>$i</option>";
        }
    } else {
        for ($i = date("Y", time()) - 20; $i < $year; $i++) {
            echo "<option value='$i'>$i</option>";
        }
        echo "<option selected value=$year>$year</option>";
        for ($i = $year+1; $i <= date("Y", time()) - 15; $i++) {
            echo "<option value='$i'>$i</option>";
        }
    }
}

function printGradeList($grade)
{
    if ($grade == null) {
        for ($i = 11; $i >= 7; $i--) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
    } else {
        for ($i = 11; $i > $grade; $i--) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
        echo "<option selected value=$grade>$grade</option>";
        for ($i = $grade-1; $i >= 7; $i--) {
            echo '<option value="' . $i . '">' . $i . '</option>';
        }
    }
}
