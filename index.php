<?php

require_once 'common.php';

echo \Controller\Main::getInstance()->get();

/*
$iterator = new APCIterator("");

while ($current = $iterator->current()) {

    var_dump($current);

    $iterator->next();
}
*/