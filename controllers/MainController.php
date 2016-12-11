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

        $data = new DataModel();
        $tasks = $data->getTasks();

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

    /**
     * @return bool
     */
    public function actionNewmanager()
    {
        $userID = UserModel::checkLogged();             // перевірка авторизації користувача

        $data = new DataModel();

        $managers = $data->getManagers();
        $name = '';
        $email = '';
        $access = false;

        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];

            $errors = ConfigModel::checkNewmanagerForm($name, $email);


            if($errors == false)
            {
                //запис в БД
                $data->addManager($name, $email);
                $access = true;
            }
        }

        require_once (ROOT. '/views/main/newmanager.php');
        return true;
    }

    //======================================================================
    /**
     * @return bool
     */
    public function actionMore($task_id)
    {
        $userID = UserModel::checkLogged();             // перевірка авторизації користувача


        var_dump($task_id);

        //require_once (ROOT. '/views/main/more.php');
        return true;
    }
}
