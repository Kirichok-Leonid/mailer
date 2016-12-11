<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>ABCMailer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="stylesheet" type="text/css" href="../../template/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../../template/css/style.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>

</head>
<body>

<p><a href="/distribution">Конфигурация новой рассылки </a>/////<a href="/newmanager"> Добавить нового менеджера</a></p>

<p>Ви знаходитесь в розділі управління розсилками</p>
<p>тут різні данні по розсилкам</p>

<?php if($tasks): ?>
<table>
    <tr>
        <td>Тема рассылки</td>
        <td>Дата начала</td>
        <td>Количество адресатов</td>
        <td>Отправитель</td>
    </tr>
    <?php foreach ($tasks as $row): ?>

        <tr>
            <td><?php echo $row['subject'];?></td>
            <td><?php echo $row['start'];?></td>
            <td><?php echo $row['amount'];?></td>
            <td><?php echo $row['manager'];?></td>
            <td><a href="<?php echo '/more/' . $row['id'] ; ?>">Детально</a></td>
        </tr>

        <?php var_dump($row['id']); ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>



</body>
</html>



