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
<p><a href="/main"> <- назад </a>/////<a href="/distribution">Конфигурация новой рассылки </a></p>

<?php if($access): ?>
    <h3>Данные успешно добавлены: </h3>
    <p>Имя менеджера - <?php echo $name; ?>; e-mail менеджера - <?php echo $email; ?></p>
<?php endif; ?>

<div class="managers">
    <h2>Текущие данные о менеджерах</h2>
    <ul>
    <?php foreach ($managers as $manager): ?>
        <li> <?php echo $manager['name'] ?> - < <?php echo $manager['email']; ?> > </li>
    <?php endforeach; ?>
    </ul>
</div>

<?php if (isset($errors) && is_array($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li> - <?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if(!$access): ?>
<div class="Config__form">
    <h2>Форма добавления новых менеджеров</h2>
    <form action="#" method="post">


        <p>Введите имя менеджера
            <input type="text" name="name" placeholder="имя менеджера" value="<?php echo $name; ?>" /></p>

        <p>e-mail менеджера
            <input type="email" name="email" placeholder="e-mail" value="<?php echo $email; ?>"/></p>
        <button type="submit" name="submit" class="btn-default">Установить</button>


    </form>
</div>
<?php endif; ?>



</body>
</html>



