<?php

/**Клас для роботи з БД
 * Class DataModel
 */
class DataModel
{
    /**Метод, що повертає виборку збережених листів.
     *
     * @return PDOStatement
     */
    public function getLetters()
    {
        $query = "SELECT * FROM letter";
        return Db::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**Метод, що повертає виборку усіх менеджерів
     *
     * @return PDOStatement
     */
    public function getManagers()
    {
        $query = "SELECT * FROM manager";
        return Db::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return array
     */
    public function getTasks()
    {
        $query = "SELECT * FROM task";
        return Db::getConnection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**Метод для запису даних нової задачі в БД
     *
     * @param $name
     * @param $letter_id
     * @param $subject
     * @param $manager
     * @return bool
     */
    public function setNewTask($letter_id, $subject, $manager)
    {
        $start = date("Y-m-d H:i:s");

        $db = Db::getConnection();
        $query = "INSERT INTO task(letter_id, subject, start ,manager) VALUES (:letter_id, :subject, :start, :manager)";
        $result = $db->prepare($query);

        $result->bindParam(':letter_id', $letter_id, PDO::PARAM_INT);
        $result->bindParam(':subject', $subject, PDO::PARAM_STR);
        $result->bindParam(':start', $start, PDO::PARAM_STR);
        $result->bindParam(':manager', $manager, PDO::PARAM_STR);
        //$result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->execute();

        return $db->lastInsertId();
    }

    /**Метод для додавання масиву емейлів для розсилки в БД
     * (додавання до черги)
     *
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

    /**Метод для запису емейлу для розсилки в БД
     * (додавання до черги)
     *
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

    /**Метод для запису нового менеджера в БД
     * @param $name
     * @param $email
     * @return bool
     */
    public function addManager($name, $email)
    {
        $query = "INSERT INTO manager(name ,email) VALUES (:name, :email)";

        $result = Db::getConnection()->prepare($query);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);

        return $result->execute();
    }

    //===================================================================================
    /**
     * @param $id
     * @return bool
     */
    public function countLogsByTaskId($id)
    {
        $query = "SELECT COUNT(*) FROM log WHERE task_id = :id";

        $result = Db::getConnection()->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * @param $status
     * @param $id
     * @return bool
     */
    public function getLogsByStatusAndTaskId($status, $id)
    {
        $query = "SELECT COUNT(*) FROM log WHERE task_id = :id AND status = :status";

        $result = Db::getConnection()->prepare($query);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        return $result->execute();
    }

}