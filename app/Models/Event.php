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
    protected $dateTimeClass = null;
    protected $eventDay = [];

    public function __construct($time = null, $timezone = null)
    {
        date_default_timezone_set('UTC');

        $this->timezone = (int)$timezone * 60 ?? (int)date('Z');

        $this->time = $time ?? date('H:i', time() + $this->timezone);

        $this->dateTimeClass = new \DateTime();
        $this->dateTimeClass->modify($this->timezone . ' second');
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

                $this->eventDay[$day]['date'] = new \DateTime($day . ' ' . $this->time);

                if ($this->dateTimeClass >= new \DateTime($day . ' ' . $this->time)) {
                    $this->eventDay[$day]['date'] = new \DateTime('next ' . $day . ' ' . $this->time);
                }

                $this->eventDay[$day]['interval'] = $this->dateTimeClass->diff($this->eventDay[$day]['date']);

            }
        }

    }

    public function dateTime()
    {
        $data = [];

        foreach ($this->eventDay as $day => $values) {
            $data[$day]['date'] = $values['date']->format('Y-m-d H:i');
            $data[$day]['interval'] = $values['interval']->format('%r%a д., %H:%I%');
        }

        asort($data);

        return $data;
    }
}