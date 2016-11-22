<?php

/**Клас для перевірки на валідність даних з форми постановки задачі
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

    /**Метод для перевірки теми на кількість символів (не менше 3х)
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

}