<?php

namespace app\Controller;

use app\View;

class Event
{
    public $event;
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function actionIndex()
    {
        $this->view->view(__DIR__ . '/../../tamplate/index.php');
    }

    public function actionCreateEvent()
    {
        $time = null;
        $timezone = null;
        $week = null;

        if (isset($_POST['time']) && isset($_POST['timezone']) && isset($_POST['week'])) {
            $time = $_POST['time'];
            $timezone = $_POST['timezone'];
            $week = array_sum($_POST['week']);
        }

        $this->event = new \app\Models\Event($time, $timezone);
        $this->event->eventDays($week);
        $this->view->days = $this->event->dateTime();
        $this->view->view(__DIR__ . '/../../tamplate/date.php');
    }

    public function action($action)
    {
        $actionName = 'action' . $action;

        if (method_exists($this, $actionName)) {
            return $this->$actionName();
        }
    }

}