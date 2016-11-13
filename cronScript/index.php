<?php

require_once ('../components/DB.php');

$db = Db::getConnection();


$query = "SELECT c.email, t.subject, l.body FROM current c INNER JOIN task t ON c.task_id = t.id INNER JOIN letter l ON t.letter_id = l.id";
$result = $db->query($query);

$dataArray = $result->fetchAll(PDO::FETCH_ASSOC);

var_dump($dataArray);

// тут додати умову "якщо масив пустий - припинити виконання скрипта";

//============================================================

foreach ($dataArray as $data)
{


    // перевірка email на валідність

    // відправка повідомлення

    // запис в лог

    // видалення запису з таблиці


}
