<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenTime extends Model {
    const ARRAY = true;
    const JSON = false;
    const STRING = null;
    protected $fillable = ['date_from', 'date_to', 'days', 'times', 'time_info', 'active'];

    public function MackDays($days, $return=false) {
        $_days = [];
        foreach($days as $day => $val) $_days[] = $day;
        $this->days = json_encode($_days);
        if($return) return $this->days;
        return $this;
    }

    public function MackTimes($from, $to, $period, $return=false) {
        $_times = [];
        $this->time_info = json_encode(['from'=>$from, 'to'=>$to, 'period'=>$period]);

        while($from < $to) {
            $time = $this->MackTime($from);
            $from += $period;
            if($from <= $to) {
                $time .= ' - ' . $this->MackTime($from);
                $_times[] = $time;
            }
        }

        $this->times = json_encode($_times);
        if($return) return $this->times;
        return $this;
    }
    private function MackTime($hour) {
        $when = 'AM';
        if($hour > 12) {$hour -= 12; $when = 'PM';}
        if($hour < 10) {
            if(strlen($hour) < 2) {
                $hour = '0' . $hour;
            }
        }
        return $hour . ' ' . $when;
    }

    public function mackDaysList($type=self::STRING, $return=true) {
        if($type === self::JSON) {
            $days = json_decode($this->days);
        } else {
            $days = json_decode($this->days, true);
            if($type === self::STRING) {
                $days = implode(', ', $days);
            }
        }
        if($return)
            return $days;
        else
            $this->days = $days;
        return $this;
    }

    public function mackTimesList($type=self::ARRAY, $return=true) {
        if($type === self::JSON) {
            $times = json_decode($this->times);
        } else {
            $times = json_decode($this->times, true);
            if($type === self::STRING) {
                $times = implode(', ', $times);
            }
        }
        if($return)
            return $times;
        else
            $this->times = $times;
        return $this;
    }

    public static function getFreeTimes() {
        $lastTimes = self::orderBy('id', 'DESC')->first();
        $lastTimes->mackTimesList(self::JSON,  false);
        $lastTimes->mackDaysList(self::JSON,  false);

        $times = $lastTimes;


        return $times;
    }
}
