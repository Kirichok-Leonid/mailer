<?php

/**
 * Таблиця роутів
 */

return array(
    'newmanager' => 'main/newmanager',
//    'registration' => 'user/registration',  // actionRegistration в UserController
    'login' => 'user/login',                // actionLogin в UserController
    'logout' => 'user/logout',              // actionLogout в UserController
    'more/([0-9]+)' => 'main/more/$1',         // actionMore в MainController
    'main' => 'main/index',                 // actionIndex в MainController
    'distribution' => 'main/distribution',  // actionDistribution в MainController
    '' => 'site/index',                     // actionIndex в SiteController
);


