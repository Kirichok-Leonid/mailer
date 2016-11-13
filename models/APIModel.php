<?php

require_once (ROOT . '/components/Request.php');

class APIModel
{

    private $host = 'abcs1.megaplan.ru';            // host name
    private $login = 'mailerabc@abc-s.com.ua';      // login
    private $password = '6cF738cF';                 // password


    /**
     * @return SdfApi_Request
     */
    private function APIConnection()
    {
        $request = new SdfApi_Request('', '', $this->host, true);
        $response = json_decode(
            $request->get(
                '/BumsCommonApiV01/User/authorize.api',
                array(
                    'Login' => $this->login,
                    'Password' => md5( $this->password )
                )
            )
        );

        usleep(500000);         // because of Megaplan`s limitation

        return new SdfApi_Request(
            $response->data->AccessId,
            $response->data->SecretKey,
            $this->host,
            true
        );
    }

    /**
     * @return mixed
     */
    public function getAllEmails()
    {
        $connection = $this->APIConnection();
        $iterator = 1;
        $count = 0;

        for($i=0; $i < 20; $i ++)
        {
            usleep(500000);         // because of Megaplan`s limitation

            $query_params = array( 'Limit'=>1000 , 'Offset' => $iterator );
            $raw = $connection->post('/BumsCrmApiV01/Contractor/list.api', $query_params);
            $str = json_decode($raw, true);

            $clients = $str['data']['clients'];

            foreach ($clients as $client)
            {
                if($client['Email'] != "")
                {
                    $emails[$count] = $client['Email'];
                    $count ++;
                }

            }
            $iterator += 1000;
        }

        return $emails;
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getEmails($param=null)
    {
        $connection = $this->APIConnection();
        $iterator = 1;
        $count = 0;

        for($i=0; $i < 7; $i ++)
        {
            usleep(500000);         // because of Megaplan`s limitation

            $query_params = array( 'Limit'=>1000 , 'Offset' => $iterator, 'qs' => $param );
            $raw = $connection->post('/BumsCrmApiV01/Contractor/list.api', $query_params);
            $str = json_decode($raw, true);

            $clients = $str['data']['clients'];

            foreach ($clients as $client)
            {
                if($client['Email'] != "")
                {
                    $emails[$count] = $client['Email'];
                    $count ++;
                }
            }
            $iterator += 1000;
        }

        return $emails;
    }

}

