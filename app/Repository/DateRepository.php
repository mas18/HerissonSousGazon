<?php
/**
 * Created by PhpStorm.
 * User: teuft
 * Date: 24.04.2017
 * Time: 09:22
 */

namespace App\Repository;


use Carbon\Carbon;

class DateRepository
{
    //format the date in date format
    public function parseDate_d_m_y($date)
    {
        $carbonDate = new Carbon($date);
        return  Carbon::parse($carbonDate)->format('d-m-Y');
    }

    //reformat the date in original date format
    public function parseDate_y_m_d($date)
    {
        $carbonDate = new Carbon($date);
        return  Carbon::parse($carbonDate)->format('Y-m-d');
    }

    //format the the date in a DateTime format
    public function parseDateTime_d_m_y__h_m($date)
    {
        $carbonDate = new Carbon($date);
        return  Carbon::parse($carbonDate)->format('  d-m-Y  -  H:i');
    }

    //return the only time
    public function parseTime_h_m($date)
    {
        $carbonDate = new Carbon($date);
        return  Carbon::parse($carbonDate)->format('H:i');
    }

    public function difference_day_from_today($date)
    {
        $today=Carbon::today();
        $eventDate=new Carbon($date);
        $day_difference=$eventDate->diffInDays($today);
        return $day_difference;
    }
    public function parse_date_localized_dddd_mmmm_yyyy($date)
    {
        $carbonDate=new Carbon($date);

      // setlocale(LC_TIME, 'French');
       // return $carbonDate->formatLocalized('%A %d %B %Y');

        $carbonDate = new Carbon($date);
        return  Carbon::parse($carbonDate)->format('d-m-Y');

    }
    public function getHourOfDate($date)
    {
        $carbonDate=new Carbon($date);
        return  Carbon::parse($carbonDate)->format('H:i');
    }
}