<?php

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
        }

        require_once (ROOT. '/views/main/distribution.php');
        return true;
    }
}
