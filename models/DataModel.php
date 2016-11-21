<?php

/**
 * Class DataModel
 */
class DataModel
{
    /**
     * @return PDOStatement
     */
    public function getLetters()
    {
        $query = "SELECT * FROM letter";
        return Db::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @return PDOStatement
     */
    public function getManagers()
    {
        $query = "SELECT * FROM manager";
        return Db::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $name
     * @param $letter_id
     * @param $subject
     * @param $manager
     * @return bool
     */
    public function setNewTask($letter_id, $subject, $manager)
    {
        $db = Db::getConnection();
        $query = "INSERT INTO task(letter_id, subject, manager) VALUES (:letter_id, :subject, :manager)";

        $result = $db->prepare($query);

        $result->bindParam(':letter_id', $letter_id, PDO::PARAM_INT);
        $result->bindParam(':subject', $subject, PDO::PARAM_STR);
        $result->bindParam(':manager', $manager, PDO::PARAM_STR);
        //$result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();

        return $db->lastInsertId();
    }


    /**
     * @param $emails
     * @param $task_id
     */
    public function addToCurrent($emails, $task_id)
    {
        foreach ($emails as $email)
        {
            $this->add($email, $task_id);
        }
        return header("Location: main");
    }

    /**
     * @param $email
     * @param $task_id
     * @return bool
     */
    public function add($email, $task_id)
    {
        $query = "INSERT INTO current(email, task_id) VALUES (:email, :task_id)";

        $result = Db::getConnection()->prepare($query);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':task_id', $task_id, PDO::PARAM_INT);

        return $result->execute();
    }


}