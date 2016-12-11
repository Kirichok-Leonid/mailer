<?php

require_once ('../components/DB.php');

$db = Db::getConnection();


$query = "SELECT c.id, c.email, c.task_id, t.subject, t.manager, l.body FROM current c INNER JOIN task t ON c.task_id = t.id INNER JOIN letter l ON t.letter_id = l.id";
$result = $db->query($query);

$dataArray = $result->fetchAll(PDO::FETCH_ASSOC);


// якщо масив пустий - припинити виконання скрипта
if (!$dataArray)
    die();

// лічильник відправлених повідомлень
$count = 0;

// цикл відправки повідомлень
foreach ($dataArray as $data)
{
    // змінна статусу відправки повідомлення
    $status = "sent";

    // email адреса сайту-відправника
    $sender = $data['manager'];

    // формування header блоку повідомлення
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type: text/html; charset=charset=utf-8" . "\r\n";
    $headers .= "From: $sender " . "\r\n";
    $headers .= "X-Mailer: PHP/". phpversion();


    // перевірка email на валідність
    if (filter_var($data['email'], FILTER_VALIDATE_EMAIL))
    {
        // відправка повідомлення
        if(!mail($data['email'], $data['subject'], $data['body'], $headers))
        {
            $status = "not sent";               // статус відправки
        }

        $count ++;
    } else {
        $status = "incorrect email";            // статус відправки

    }

    // запис в лог ($status, $data['task_id'], $data['email'])
    $query = "INSERT INTO log(task_id, email, status, time) VALUES (:task_id, :email, :status, :time)";
    $result = $db->prepare($query);

    $time = date("Y:m:d H:i:s");

    $result->bindParam(':task_id', $data['task_id'], PDO::PARAM_INT );
    $result->bindParam(':email', $data['email'], PDO::PARAM_STR);
    $result->bindParam(':status', $status, PDO::PARAM_STR);
    $result->bindParam(':time', $time, PDO::PARAM_STR);

    $result->execute();


    // видалення запису з таблиці current (id = $data['id'])
    $query = "DELETE FROM `current` WHERE id = " . $data['id'] ;
    $db->query($query);

    unset($headers);

    // умова виходу з циклу
    // 16 повідомлень - через обмеження провайдера
    // цей cron scriрt має запускатись кожні 10 хвилин
    if ($count == 16)
        break;

}
