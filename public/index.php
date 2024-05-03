<?php

use App\Kernel;

$_ENV['datesCongres']=['2024-09-07','2024-09-08'];
$_ENV['typesRepas']=['déjeuner', 'dîner'];
$_ENV['optionsRestauration'][$_ENV['datesCongres'][0]]=$_ENV['typesRepas'];
$_ENV['optionsRestauration'][$_ENV['datesCongres'][1]]= [$_ENV['typesRepas'][0]];

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';


return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};


