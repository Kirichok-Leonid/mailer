<?php

require_once (ROOT . '/components/Request.php');

/**Клас, що організовує підключення користувача до Мегаплану
 * і робить виборку емейлів
 *
 * Class APIModel
 */
class APIModel
{

    private $host = 'abcs1.megaplan.ru';            // назва хоста
    private $login = 'mailerabc@abc-s.com.ua';      // логін користувача
    private $password = '6cF738cF';                 // пароль користувача


    /**Підключення користувача до АРІ Мегаплан
     *
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

        usleep(500000);         // через обмеження Мегаплану на частоту запитів

        return new SdfApi_Request(
            $response->data->AccessId,
            $response->data->SecretKey,
            $this->host,
            true
        );
    }

    /**Метод, за допомогою якого робиться виборка емейлів за
     * вхідним параметром $param, або абсолютно всіх емейлів з бази
     *
     * @param $param
     * @return mixed
     */
    public function getEmails($param=null)
    {
        $connection = $this->APIConnection();
        $iterator = 1;
        $count = 0;

        do
        {
            usleep(500000);         // через обмеження Мегаплану на частоту запитів

            if($param != null)
            {
                $query_params = array( 'Limit'=>1000 , 'Offset' => $iterator, 'qs' => $param );
            } else {
                $query_params = array( 'Limit'=>1000 , 'Offset' => $iterator);
            }

            // запит до АРІ Мегаплан
            $raw = $connection->post('/BumsCrmApiV01/Contractor/list.api', $query_params);

            //декодування результату запиту
            $str = json_decode($raw, true);

            $clients = $str['data']['clients'];

            //цикл запису емейлів у масив
            foreach ($clients as $client)
            {
                if($client['Email'] != "")
                {
                    $emails[$count] = $client['Email'];
                    $count ++;
                }
            }
            $iterator += 1000;

        } while ($clients);

        return $emails;
    }

}

