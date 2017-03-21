<?php

namespace app\Models;


class Event
{
    public const MONDAY = 1 << 6;
    public const TUESDAY = 1 << 5;
    public const WEDNESDAY = 1 << 4;
    public const THURSDAY = 1 << 3;
    public const FRIDAY = 1 << 2;
    public const SATURDAY = 1 << 1;
    public const SUNDAY = 1 << 0;

    protected $timezone = null;
    protected $time = null;
    protected $date = null;

    public function __construct($time = null, $timezone = null)
    {
        date_default_timezone_set('UTC');

        if (isset($time)) {
            $this->time = $time;
        }

        if (isset($timezone)) {
            $this->timezone = abs($timezone * 60);
        } else {
            $this->timezone = abs(date('Z'));
        }

    }

    public function eventDays($days)
    {
        $allDays = [
            'mondey' => self::MONDAY,
            'tuesday' => self::TUESDAY,
            'wednesday' => self::WEDNESDAY,
            'thursday' => self::THURSDAY,
            'friday' => self::FRIDAY,
            'saturday' => self::SATURDAY,
            'sunday' => self::SUNDAY,
        ];

        $eventDay = [];

        foreach ($allDays as $day => $mask) {
            if ($days & $mask) {
                $eventDay[] = $day;
            }
        }

        return $eventDay;
    }

    public function event()
    {

    }

    protected function dateTime()
    {
        if (!isset($this->time)) {
            $this->time = date('H:i', time() + $this->timezone);
        }

        $this->date = date('Y-m-d', time() + $this->timezone);
    }
}