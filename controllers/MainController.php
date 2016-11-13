<?php

class MainController
{
    public function actionIndex()
    {
        $userID = UserModel::checkLogged();


        require_once (ROOT. '/views/main/index.php');

        return true;
    }
}
