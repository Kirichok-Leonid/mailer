<?php

class UserController
{
    /**
     * @return bool
     */
    public function actionRegistration()
    {
        $name = '';
        $email = '';
        $password = '';

        if(isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = UserModel::checkRegistrationForm($name, $email, $password);

            if ($errors == false)
            {
                $result = UserModel::registration($name, $email, $password);
            }
        }

        require_once (ROOT . '/views/user/registration.php');

        return true;
    }

    /**
     * @return bool
     */
    public function actionLogin()
    {
        $name = '';
        $password = '';

        if (isset($_POST['submit']))
        {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $errors = UserModel::checkLoginForm($name, $password);
        }

        require_once (ROOT . '/views/user/login.php');

        return true;
    }

    /**
     *
     */
    public function actionLogout()
    {
        session_start();
        unset($_SESSION['user']);
        header("Location: /");
    }

}