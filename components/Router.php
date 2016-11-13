<?php

class Router
{
    private  $routes;
    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * Returns request string
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function Run()
    {
        // отримати рядок запиту
        $uri = $this->getURI();

        // перевірка присутності запиту в routes.php
        foreach ($this->routes as $uriPattern => $path)
        {
            if (preg_match("~$uriPattern~", $uri))
            {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //визначити контроллер і екшн, що оброблюють запит + параметри
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';  //бере перший елемент масиву
                $controllerName = ucfirst("$controllerName");           //перший символ аперкейс

                $actionName = 'action'.ucfirst(array_shift($segments)); //action


                $parameters = $segments;        //массив з параметрами
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile))   //підключення файл класа контролера
                {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;    //створити об'єкт контроллеру

                $result = call_user_func_array(array($controllerObject , $actionName), $parameters);
                //  *** function actionView($par_1, $par_2)

                //$result = $controllerObject->$actionName($parameters);

                if($result != null)
                {
                    break;
                }
            }
        }
    }
}