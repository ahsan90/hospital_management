<?php

require './vendor/autoload.php';

require ('./app/config/database.php');
//require_once ('./seedDb.php');

DbSeed::loadSeed();

//php -S localhost:3000;