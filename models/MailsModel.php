<?php

//require_once (ROOT . '/models/APIModel.php');

/**
 * Class MailsModel
 */
class MailsModel
{
    private $web = 'Клиент WEB студии и Дизайна';
    private $kanctovar = 'Клиент канцтовары';
    private $book = 'Клиент книг';
    private $book_club = 'Клиент книжного клуба';
    private $periodika = 'Клиент периодики';
    private $poligraph = 'Клиент полиграфии';
    private $ratp = 'Клиент РА и ТП';
    private $reklama = 'Клиент рекламный';
    private $typograph = 'Клиент типографии';
    private $photobook = 'Клиент фотокниг';

    private $APIModel = null;

    /**
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

    /**
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

    /**
     * @return PDOStatement
     */
    public function getUACompanyList()
    {
        $sql = "SELECT * FROM `UACompany`";
        return Db::getConnection()->query($sql)->fetchAll(PDO::FETCH_COLUMN, 1);
    }

    /**
     * @return mixed
     */
    public function getAllGroupList()      //вcя база мегаплана
    {
        return $this->getAPIModel()->getEmails();
    }

    /**
     * @return mixed
     */
    public function getWebList()           //Клиент WEB студии и Дизайна
    {
        return $this->getAPIModel()->getEmails($this->web);
    }

    /**
     * @return mixed
     */
    public function getKanctovarList()     //Клиент канцтовары
    {
        return $this->getAPIModel()->getEmails($this->kanctovar);
    }

    /**
     * @return mixed
     */
    public function getBookList()          //Клиент книг
    {
        return $this->getAPIModel()->getEmails($this->book);
    }

    /**
     * @return mixed
     */
    public function getBookClubList()     //Клиент книжного клуба
    {
        return $this->getAPIModel()->getEmails($this->book_club);
    }

    /**
     * @return mixed
     */
    public function getPeriodikaList()     //Клиент периодики
    {
        return $this->getAPIModel()->getEmails($this->periodika);
    }

    /**
     * @return mixed
     */
    public function getPoligraphList()     //Клиент полиграфии
    {
        return $this->getAPIModel()->getEmails($this->poligraph);
    }

    /**
     * @return mixed
     */
    public function getRatpList()          //Клиент РА и ТП
    {
        return $this->getAPIModel()->getEmails($this->ratp);
    }

    /**
     * @return mixed
     */
    public function getReklamaList()       //Клиент рекламный
    {
        return $this->getAPIModel()->getEmails($this->reklama);
    }

    /**
     * @return mixed
     */
    public function getTypographList()     //Клиент типографии
    {
        return $this->getAPIModel()->getEmails($this->typograph);
    }

    /**
     * @return mixed
     */
    public function getPhotobookList()     //Клиент фотокниг
    {
        return $this->getAPIModel()->getEmails($this->photobook);
    }

}

