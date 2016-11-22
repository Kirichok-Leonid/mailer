<?php

/**
 * Class MainController
 */
class MainController
{
    /**
     * @return bool
     */
    public function actionIndex()
    {
        $userID = UserModel::checkLogged();             // перевірка авторизації користувача

        require_once (ROOT. '/views/main/index.php');
        return true;
    }

    /**
     * @return bool
     */
    public function actionDistribution()
    {
        $userID = UserModel::checkLogged();             // перевірка авторизації користувача

        $data = new DataModel();

        $letters = $data->getLetters();
        $managers = $data->getManagers();

        $group = '';
        $sender = '';
        $letter = '';
        $subject = '';

        if(isset($_POST['submit']))
        {
            $group = $_POST['group'];
            $sender = $_POST['sender'];
            $letter = $_POST['letter'];
            $subject = $_POST['subject'];

            $errors = ConfigModel::checkConfigForm($letter, $sender, $group, $subject);

            if( $errors == false)
            {
                // запис в БД нової задачі
                $task_id = $data->setNewTask($letter, $subject, $sender);

                // запис в БД емейлів для поточної відправки
                $emails = new MailsModel();
                $data->addToCurrent($emails->getGroupEmails($group), $task_id);
            }
        }

        require_once (ROOT. '/views/main/distribution.php');
        return true;
    }
}
