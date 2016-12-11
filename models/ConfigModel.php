<?php

/**Клас для перевірки на валідність даних з форм
 *
 * Class ConfigModel
 */
class ConfigModel
{

    /**Метод для перевірки на валідність даних з форми постановки задачі
     *
     * @param $letter
     * @param $sender
     * @param $group
     * @param $subject
     * @return array|bool
     */
    public static function checkConfigForm($letter, $sender, $group, $subject)
    {
        $errors = false;
        if(self::checkParam($letter))
        {
            $errors[] = "письмо не выбрано !";
        }
        if(self::checkParam($sender))
        {
            $errors[] = "отправитель не выбран !";
        }
        if(self::checkGroup($group))
        {
            $errors[] = "не выбрана группа получателей";
        }
        if(self::checkSubject($subject))
        {
            $errors[] = "тема письма должна быть больше 3-х символов";
        }

        return $errors;
    }

    /**Метод для перевірки на валідність даних з форми додавання нового менеджера
     * @param $name
     * @param $email
     * @return array|bool
     */
    public static function checkNewmanagerForm($name, $email)
    {
        $errors = false;
        if(self::checkEmail($email))
        {
            $errors[] = "неправильный адрес почтового ящика !";
        }
        if(self::checkEmailExists($email))
        {
            $errors[] = "такой адрес почтового ящика уже есть !";
        }
        if(self::checkSubject($name))
        {
            $errors[] = "длина имени должна быть больше 3-х символов";
        }

        return $errors;
    }

    /**Метод для перевірки на кількість символів (не менше 3х)
     *
     * @param $subject
     * @return bool
     */
    public static function checkSubject ($subject)
    {
        if(strlen($subject) <= 3 )
        {
            return true;
        }
        return false;
    }

    /**Метод для перевірки наявності коректниз значень в змінній
     *
     * @param $group
     * @return bool
     */
    public static function checkGroup($group)
    {
        if($group == '' || $group < 1 || $group > 12)
        {
            return true;
        }
        return false;
    }

    /**Метод для перевірки параметру на вміст пустого значення
     *
     * @param $param
     * @return bool
     */
    public static function checkParam($param)
    {
        if($param == '')
        {
            return true;
        }
        return false;
    }

    /**Метод перевірки емейлу на валідність (правильність)
     *
     * @param $email
     * @return bool
     */
    public static function checkEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            return true;
        }
        return false;
    }

    /**Метод перевірки наявності емейлу в БД серед менеджерів
     *
     * @param $email
     * @return bool
     */
    public static function checkEmailExists($email)
    {
        $db = Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM manager WHERE email =:email';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        if($result->fetchColumn())
            return true;

        return false;

    }

}