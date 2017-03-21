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

    public function actionCreateEvent($time = null, $timezone = null)
    {
        $this->event = new \app\Models\Event($time, $timezone);
    }

    public function action($action)
    {
        $actionName = 'action' . $action;

        if (method_exists($this, $actionName)) {
            return $this->$actionName();
        }
    }

}