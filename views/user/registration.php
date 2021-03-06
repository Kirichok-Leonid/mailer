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
<?php if($result): ?>
    <p>Вы зарегистрированы !</p>
<?php else: ?>

<?php if (isset($errors) && is_array($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li> - <?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="signUp__form">
    <h2>Форма регистрации</h2>
    <form action="#" method="post">
        <input type="text" name="name" placeholder="Имя" value="<?php echo $name ?>" />
        <input type="email" name="email" placeholder="E-mail" value="<?php echo $email ?>" />
        <input type="password" name="password" placeholder="пароль" value="<?php echo $password ?>" />
        <button type="submit" name="submit" class="btn-default" >Регистрация</button>
    </form>
</div>

<?php endif; ?>

</body>
</html>