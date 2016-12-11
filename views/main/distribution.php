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

<p><a href="/main"> <- статистика </a>/////<a href="/newmanager"> Добавить нового менеджера</a></p>

<?php if (isset($errors) && is_array($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li> - <?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="Config__form">
    <h2>Форма установки параметров рассылки</h2>
    <form action="#" method="post">

        <p>Выбор письма
            <select name="letter" size="1">

                <?php foreach ($letters as $row): ?>
                    <option value="<?=$row['id']?>"><?php echo $row['name']; ?></option>
                <?php endforeach; ?>

            </select></p>
        <p>Выбор отправителя
            <select name="sender" size="1">

                <?php foreach ($managers as $manager): ?>
                    <option value="<?=$manager['email']?>"><?php echo  $manager['name'] . " < "  . $manager['email'] . " > "; ?></option>
                <?php endforeach; ?>

            </select></p>
        <p>Выбор группы получателей
            <select name="group" size="1">
                <option value="1">Вся база Мегаплана</option>
                <option value="2">Клиенты WEB студии и Дизайна</option>
                <option value="3">Клиенты канцтоваров</option>
                <option value="4">Клиенты книг</option>
                <option value="5">Клиенты книжного клуба</option>
                <option value="6">Клиенты периодики</option>
                <option value="7">Клиенты полиграфии</option>
                <option value="8">Клиенты РА и ТП</option>
                <option value="9">Рекламные клиенты</option>
                <option value="10">Клиенты типографии</option>
                <option value="11">Клиенты фотокниг</option>
                <option value="12">База предприятий</option>
            </select></p>
        <p>Тема рассылки
            <input type="text" name="subject" placeholder="тема рассылки" value="<?php echo $subject; ?>"/></p>
        <button type="submit" name="submit" class="btn-default">Установить</button>

    </form>
</div>

</body>
</html>



