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
    public $dateTime = [];
    public $eventDay = [];

    public function __construct($time = null, $timezone = null)
    {
        date_default_timezone_set('UTC');

        $this->timezone = (int)$timezone * 60 ?? (int)date('Z');

        $this->time = $time ?? date('H:i', time() + $this->timezone);

        $this->dateTime = new \DateTime();


    }

    public function eventDays($days)
    {
        $allDays = [
            'monday' => self::MONDAY,
            'tuesday' => self::TUESDAY,
            'wednesday' => self::WEDNESDAY,
            'thursday' => self::THURSDAY,
            'friday' => self::FRIDAY,
            'saturday' => self::SATURDAY,
            'sunday' => self::SUNDAY,
        ];

        foreach ($allDays as $day => $mask) {
            if ($days & $mask) {
                $this->eventDay[$day] = new \DateTime('next ' . $day . ' ' . $this->time);
            }
        }

        return $this->eventDay;
    }

    public function dateTime()
    {
        $data = [];

        foreach ($this->eventDay as $key => $value) {
            $data[$key] = $value->format('Y-m-d H:i');
        }

        return $data;

//        if (!isset($this->time)) {
//            $this->time = date('H:i', time() + $this->timezone);
//        }
//
//        $this->date = date('Y-m-d', time() + $this->timezone);
    }
}