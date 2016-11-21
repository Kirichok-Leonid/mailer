<?php

/**
 * Class ConfigModel
 */
class ConfigModel
{

    /**
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

    /**
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

    /**
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

    /**
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

}