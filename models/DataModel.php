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
        $query = "INSERT INTO task(letter_id, subject, manager,) VALUES (:letter_id, :subject, :manager)";

        $result = Db::getConnection()->prepare($query);

        $result->bindParam(':letter_id', $letter_id, PDO::PARAM_INT);
        $result->bindParam(':subject', $subject, PDO::PARAM_STR);
        $result->bindParam(':manager', $manager, PDO::PARAM_STR);
        //$result->bindParam(':name', $name, PDO::PARAM_STR);

        return $result->execute();
    }

}