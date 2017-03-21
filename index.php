<?php

include __DIR__ . '/autoload.php';

$event = new \app\Controller\Event();

$actionName = $_GET['act'] ?? 'Index';

$event->action($actionName);