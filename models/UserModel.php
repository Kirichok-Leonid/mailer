<?php

/**
 * Class UserModel
 */
class UserModel
{

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return bool
     */
    public static function registration($name, $email, $pas)
    {
        $db = Db::getConnection();
        $password = self::preparePass($pas);

        $sql = 'INSERT INTO User (name, email, password) VALUES (:name, :email, :password)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @return array|bool
     */
    public static function checkRegistrationForm($name, $email, $password)
    {
        $errors = false;

        if(!self::checkName($name))
        {
            $errors[] = 'длина имени должна быть короче 3-х символов';
        }

        if(!self::checkEmail($email))
        {
            $errors[] = 'неправильный email';
        }

        if(!self::checkName($password))
        {
            $errors[] = 'длина пароля должна быть не короче 6-х символов';
        }

        if(self::checkEmailExists($email))
        {
            $errors[] = 'такой email уже используется';
        }
        return $errors;
    }

    /**
     * @param $name
     * @param $password
     * @return array|bool
     */
    public static function checkLoginForm($name, $password)
    {
        $errors = false;

        if(!self::checkName($name))
        {
            $errors[] = 'длина имени должна быть короче 3-х символов';
        }

        $userID = self::checkUserData($name, $password);

        if ($userID == false)
        {
            $errors[] = 'неправильные данные для входа на сайт';
        } else {
            self::auth($userID);

            // перенаправляем в закрытую часть - админку
            header("Location: /main/");
        }
        return $errors;
    }

    public static function preparePass($password)
    {
        return md5($password);
    }

    /**
     * @param $name
     * @return bool
     */
    public static function checkName($name)
    {
        if(strlen($name) >= 3)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $password
     * @return bool
     */
    public static function checkPassword($password)
    {
        if(strlen($password) >= 6)
        {
            return true;
        }
        return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }

    /**
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM User WHERE email =:email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;

        return false;

    }

    /**
     * @param $name
     * @param $pass
     * @return bool or int
     */
    public static function checkUserData($name, $pass)
    {
        $db = Db::getConnection();
        $password = self::preparePass($pass);

        $sql = 'SELECT * FROM User WHERE name =:name AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if($user)
        {
            return $user['id'];
        }

        return false;
    }

    /**
     * @param $userID
     */
    public static function auth($userID)
    {
        $_SESSION['user'] = $userID;
    }

    /**
     * @return bool
     */
    public static function isGuest()
    {
        if(isset($_SESSION['user']))
            return true;

        return false;
    }

    /**
     * @return mixed
     */
    public static function checkLogged()
    {
        if (isset($_SESSION['user']))
        {
            return $_SESSION['user'];
        }

        header("Location: login");
    }

}