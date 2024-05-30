<?php
if (!function_exists('time2str'))
{
    function time2str($date, $timeRelative = true): string
    {
        if(!ctype_digit($date))
            $date = strtotime($date);

        $diff = time() - $date;
        if($diff == 0)
            return 'الان';
        elseif($diff > 0)
        {
            $day_diff = floor($diff / 86400);
            if($day_diff == 0 && $timeRelative)
            {
                if($diff < 60) return 'همین الان';
                if($diff < 120) return '۱ دقیقه قبل';
                if($diff < 3600) return digitConverter(floor($diff / 60)) . ' دقیقه قبل';
                if($diff < 7200) return '۱ ساعت قبل';
                if($diff < 86400) return digitConverter(floor($diff / 3600)) . " ساعت قبل" ;
            }
            elseif($day_diff == 0 && !$timeRelative)
            {
                return 'امروز';
            }

            if($day_diff == 1) return 'دیروز';
            if($day_diff < 7) return digitConverter($day_diff) . ' روز قبل';
            if($day_diff < 31) return digitConverter(ceil($day_diff / 7)) . ' هفته قبل';
            if($day_diff < 60) return 'ماه قبل ';
            if($day_diff > 60) return digitConverter(ceil($day_diff / 30)) . ' ماه قبل';
            return digitConverter(ceil($day_diff / 30)) . ' ماه قبل';
        }
        else
        {
            $diff = abs($diff);
            $day_diff = floor($diff / 86400);
            if($day_diff == 0)
            {
                if($diff < 120) return 'چند لحظه قبل';
                if($diff < 3600) return 'در  ' .  digitConverter(floor($diff / 60)) . ' دقیقه';
                if($diff < 7200) return 'یک ساعت قبل';
                if($diff < 86400) return 'در ' . digitConverter(floor($diff / 3600)) . ' ساعت';
            }
            if($day_diff == 1) return 'فردا';
            if($day_diff < 4) return date('l', $date);
            if($day_diff < 7 + (7 - date('w'))) return 'هفته  بعد';
            if(ceil($day_diff / 7) < 4) return 'در ' . ceil($day_diff / 7) . ' هفته';
            if(date('n', $date) == date('n') + 1) return 'ماه بعد';
            return date('F Y', $date);
        }
    }
}
if (!function_exists('digitConverter'))
{
    function digitConverter($str, $convert_to = 'fa'): array|string
    {
        $fa = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
        $ar = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];

        $str = str_replace($ar, $en, $str);

        if ($convert_to == 'fa')
        {
            return str_replace($en, $fa, $str);
        }
        elseif ($convert_to == 'en')
        {
            return str_replace($fa, $en, $str);
        }
        return $str;
    }
}
