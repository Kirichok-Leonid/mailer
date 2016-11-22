<?php

//require_once (ROOT . '/models/APIModel.php');

/** Клас призначений для виборки емейлів з АРІ та БД
 *
 * Class MailsModel
 */
class MailsModel
{
    private $web = 'Клиент WEB студии и Дизайна';   //параметр для виборки з АРІ
    private $kanctovar = 'Клиент канцтовары';       //параметр для виборки з АРІ
    private $book = 'Клиент книг';                  //параметр для виборки з АРІ
    private $book_club = 'Клиент книжного клуба';   //параметр для виборки з АРІ
    private $periodika = 'Клиент периодики';        //параметр для виборки з АРІ
    private $poligraph = 'Клиент полиграфии';       //параметр для виборки з АРІ
    private $ratp = 'Клиент РА и ТП';               //параметр для виборки з АРІ
    private $reklama = 'Клиент рекламный';          //параметр для виборки з АРІ
    private $typograph = 'Клиент типографии';       //параметр для виборки з АРІ
    private $photobook = 'Клиент фотокниг';         //параметр для виборки з АРІ

    private $APIModel = null;                       //об'єкт APIModel

    /**Доступ до АРІ,
     * підключення класу APIModel для роботи
     *
     * @return APIModel|null
     */
    private function getAPIModel()
    {
        if ($this->APIModel == null)
        {
            $this->APIModel = new APIModel();
        }
        return $this->APIModel;
    }

    /**Метод, що повертає масив емейлів в залежності від
     * вхідного параметру$group
     *
     * @param $group
     * @return mixed
     */
    public function getGroupEmails($group)
    {
        switch ($group)
        {
            case '1':
                $emails = $this->getAllGroupList();
                break;
            case '2':
                $emails = $this->getWebList();
                break;
            case '3':
                $emails = $this->getKanctovarList();
                break;
            case '4':
                $emails = $this->getBookList();
                break;
            case '5':
                $emails = $this->getBookClubList();
                break;
            case '6':
                $emails = $this->getPeriodikaList();
                break;
            case '7':
                $emails = $this->getPoligraphList();
                break;
            case '8':
                $emails = $this->getRatpList();
                break;
            case '9':
                $emails = $this->getReklamaList();
                break;
            case '10':
                $emails = $this->getTypographList();
                break;
            case '11':
                $emails = $this->getPhotobookList();
                break;
            case '12':
                $emails = $this->getUACompanyList();
                break;
        }
        return $emails;

    }

    /**Метод, що повертає масив емейлів
     * з бази даних з таблиці UACompany
     *
     * @return PDOStatement
     */
    public function getUACompanyList()
    {
        $sql = "SELECT * FROM `UACompany`";
        return Db::getConnection()->query($sql)->fetchAll(PDO::FETCH_COLUMN, 1);
    }

    /**Метод, що повертає масив усіх емейлів з бази Мегаплана
     *
     * @return mixed
     */
    public function getAllGroupList()      //вcя база Мегаплана
    {
        return $this->getAPIModel()->getEmails();
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент WEB студии и Дизайна"
     *
     * @return mixed
     */
    public function getWebList()           //Клиент WEB студии и Дизайна
    {
        return $this->getAPIModel()->getEmails($this->web);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент канцтовары"
     *
     * @return mixed
     */
    public function getKanctovarList()     //Клиент канцтовары
    {
        return $this->getAPIModel()->getEmails($this->kanctovar);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент книг"
     *
     * @return mixed
     */
    public function getBookList()          //Клиент книг
    {
        return $this->getAPIModel()->getEmails($this->book);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент книжного клуба"
     *
     * @return mixed
     */
    public function getBookClubList()     //Клиент книжного клуба
    {
        return $this->getAPIModel()->getEmails($this->book_club);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент периодики"
     *
     * @return mixed
     */
    public function getPeriodikaList()     //Клиент периодики
    {
        return $this->getAPIModel()->getEmails($this->periodika);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент полиграфии"
     *
     * @return mixed
     */
    public function getPoligraphList()     //Клиент полиграфии
    {
        return $this->getAPIModel()->getEmails($this->poligraph);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент РА и ТП"
     *
     * @return mixed
     */
    public function getRatpList()          //Клиент РА и ТП
    {
        return $this->getAPIModel()->getEmails($this->ratp);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент рекламный"
     *
     * @return mixed
     */
    public function getReklamaList()       //Клиент рекламный
    {
        return $this->getAPIModel()->getEmails($this->reklama);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент типографии"
     *
     * @return mixed
     */
    public function getTypographList()     //Клиент типографии
    {
        return $this->getAPIModel()->getEmails($this->typograph);
    }

    /**Метод, що повертає масив емейлів з бази Мегаплана
     * за виборкою "Клиент фотокниг"
     *
     * @return mixed
     */
    public function getPhotobookList()     //Клиент фотокниг
    {
        return $this->getAPIModel()->getEmails($this->photobook);
    }

}

