<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="width: 800px; margin: 0 auto;">
<?php $event = array_shift($this->days); ?>
<p>До ближайшего мероприятия осталось <?php echo $event['interval'] ?><br/>
    Оно начнётся <?php echo $event['date'] ?></p>
</body>
</html>