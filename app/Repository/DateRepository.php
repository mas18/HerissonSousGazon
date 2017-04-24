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
}