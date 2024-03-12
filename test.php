<?php

use Hindbiswas\QueBee\SanitizeWord;

include __DIR__ . '/vendor/autoload.php';


echo SanitizeWord::run('hello.rank') . PHP_EOL;